<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Token;
use Exception;
use Tests\Tools;

/**
 * Class TokenTest
 * @package Tests\Feature
 */
class TokenTest extends Tools
{
	/**
	 * @return void
	 * @throws Exception
	 */
    public function test_token_generation()
    {
		$amount = 5;
		$actor = $this->getActor("Doula");
        $response = $this->actingAs($actor)->get("/token/generate/$amount");
        $response->assertStatus(401);

	    $actor = $this->getActor("Secretario inicial");
	    $response = $this->actingAs($actor)->get("/token/generate/$amount");
	    $response->assertStatus(201);
		$response->assertJsonCount($amount);
    }

	/**
	 * Testa a validação de um token
	 * @return void
	 * @throws Exception
	 */
	public function test_check_token(){
		$actor = $this->getActor("Secretario inicial");
		$token = $this->actingAs($actor)->get("/token/generate/1")->json()[0];

		$actor = $this->getActor("Beneficiada");
		$response = $this->actingAs($actor)->get("/token/check/$token");
		$response->assertOk();
	}

	/**
	 * Testa se apenas pessoas com permissão de tokens podem ver a lista de tokens
	 * Testa se mostra apenas os tokens não usados
	 * @throws Exception
	 */
	public function test_index_tokens(){
		$actor = $this->getActor("Beneficiada");
		$response = $this->actingAs($actor)->get("token");
		$response->assertStatus(401);

		$actor = $this->getActor("Secretario inicial");
		$response = $this->actingAs($actor)->get('token');
		$availableTokensAmountBefore = count($response->json());
		foreach($response->json() as $token){
			$token = Token::where("token",'=',$token['token'])->first();
			$this->assertEquals(
				0,
				$token->used
			);
		}

		// Seto o primeiro como usado, caso exista pelo menos um não usado
		if( count($response->json()) > 0 ){
			$token = Token::where("token",'=',$response->json()[0]['token'])->where('used', '=', false)->first();
			$token->used = true;
			$token->save();
		}

		$response = $this->actingAs($actor)->get('token');
		$availableTokensAmountAfter = count($response->json());
		$this->assertEquals(1, $availableTokensAmountBefore - $availableTokensAmountAfter);
	}
}
