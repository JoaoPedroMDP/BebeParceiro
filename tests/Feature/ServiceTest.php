<?php
declare(strict_types=1);

namespace Tests\Feature;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

/**
 * Class ServiceTest
 * @package Tests\Feature
 */
class ServiceTest extends TestCase
{
	/**
	 * Visit the given URI with a POST request.
	 * @param string $uri
	 * @param array $data
	 * @param array $headers
	 * @return TestResponse
	 */
	public function post($uri, array $data = [], array $headers = []): TestResponse{
		$response = parent::post($uri, $data);
		$this->refreshApplication();
		return $response;
	}

	/**
	 * Visit the given URI with a GET request.
	 *
	 * @param  string  $uri
	 * @param  array  $headers
	 * @return TestResponse
	 */
	public function get($uri, array $headers = []): TestResponse
	{
		$response = parent::get($uri, $headers);
		$this->refreshApplication();
		return $response;
	}

	/**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_service()
    {
        $response = $this->get('/service');
		$response->assertOk();
    }

	/**
	 * @return void
	 */
	public function test_store_service()
	{
		$amountOfServicesBefore = count($this->get('/service')->json());

		$response = $this->post('/service',
			[
				"name" => "Serviço 1",
				"description" => "Teste de do serviço 1",
				"image" => new UploadedFile(resource_path('testFiles/image1.jpg'), 'storeService.jpg', null, null, true),
			]);

		$response->assertOk();
		$amountOfServicesAfter = count($this->get('/service')->json());
		$this->assertEquals($amountOfServicesBefore+1, $amountOfServicesAfter);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function test_update_service()
	{
		$serviceToUpdate = random_int(
			0,
			count(
				$this->get('/service')->json()
			)
		);

		$response = $this->post("/service/$serviceToUpdate",
			[
				"name" => "Serviço 1 alterado",
				"description" => "Teste de alteração do serviço 1"
			]);
		$response->assertOk();

		$response = $this->post("/service/$serviceToUpdate",
			[
				"name" => "Serviço 1 alterado com nova imagem",
				"description" => "Teste de alteração do serviço 1",
				"image" => new UploadedFile(resource_path('testFiles/image2.jpg'), 'storeService.jpg', null, null, true),
			]);
		$response->assertOk();
	}
}
