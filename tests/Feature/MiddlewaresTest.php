<?php
declare(strict_types=1);

namespace Tests\Feature;

use Exception;
use Tests\Tools;

/**
 * Class MiddlewaresTest
 * @package Tests\Feature
 */
class MiddlewaresTest extends Tools
{
	/**
	 * @return void
	 * @throws Exception
	 */
	public function test_basic_auth()
	{
		$response = $this->get('appointment');
		$response->assertStatus(302); // Pois será redirecionado para o login, por isso o 302

		$actor = $this->getActor("Admin");
		$response = $this->actingAs($actor)->get('appointment');
		$response->assertOk();
	}

	// Meio complicado testar os outros pois uma falha da rota em si pode afetar o resultado
	// do teste do middleware ...... não sei como fazer isso
}