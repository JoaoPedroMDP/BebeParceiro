<?php
declare(strict_types=1);

namespace Tests\Feature;

use Exception;
use Tests\Tools;

/**
 * Class TokenTest
 * @package Tests\Feature
 */
class TokenTest extends Tools
{
	/**
	 * Testa se apenas os usuários com permissão de gerar tokens podem fazê-lo
	 * @return void
	 * @throws Exception
	 */
    public function test_token_generation_permissions()
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
}
