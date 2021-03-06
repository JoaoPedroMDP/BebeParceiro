<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Service;
use Exception;
use Illuminate\Http\UploadedFile;
use Tests\Helpers\ServiceHandler;
use Tests\Tools;

/**
 * Class ServiceTest
 * @package Tests\Feature
 */
class ServiceTest extends Tools
{
	/**
	 * @return int
	 */
	public function getValidServiceId(): int
	{
		try {
			$services = Service::all('id');
			return $services[
				random_int( 0, count($services) - 1)
			]->id;
		} catch(Exception $e) {
			error_log($e->getMessage() . "\n Usando 0 como id de serviço");
			return 0;
		}
	}

	/**
	 * A basic test example.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function test_index_service()
    {
        $response = $this->get('/service');
		$response->assertOk();
    }

	/**
	 * @return void
	 * @throws Exception
	 */
	public function test_store_service()
	{
		$actor = $this->getActor("Admin");
		$amountOfServicesBefore = count($this->get('/service')->json());

		$response = $this->actingAs($actor)->post('/service',
			[
				"name" => "Serviço 1",
				"description" => "Teste de do serviço 1",
				"image" => new UploadedFile(resource_path('testFiles/image1.jpg'), 'storeService.jpg', null, null, true),
			]);

		$response->assertOk();
		$this->checkIfServiceNumberIncreased($amountOfServicesBefore);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function test_update_service()
	{
		$actor = $this->getActor("Admin");
		$serviceToUpdate = $this->getValidServiceId();
		$response = $this->actingAs($actor)->post("/service/$serviceToUpdate",
			[
				"name" => "Serviço $serviceToUpdate alterado",
				"description" => "Teste de alteração do serviço $serviceToUpdate"
			]);
		$response->assertOk();

		$name = "Serviço $serviceToUpdate alterado com nova imagem";
		$description = "Teste de alteração do serviço $serviceToUpdate";

		$response = $this->actingAs($actor)->post("/service/$serviceToUpdate",
			[
				"name" => $name,
				"description" => $description,
				"image" => new UploadedFile(resource_path('testFiles/image2.jpg'), 'storeService.jpg', null, null, true),
			]);

		$response->assertJsonFragment([
			"id" => $serviceToUpdate,
			"name" => $name,
			"description" => $description
		]);

		$response->assertOk();
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function test_delete_service()
	{
		$amountOfServicesBefore = count($this->get('/service')->json());

		$serviceToDelete = $this->getValidServiceId();
		// Caso não tenha nenhum serviço, crio um só pra deletar kkkkk
		if($serviceToDelete == 0){
			$serviceHandler = new ServiceHandler();
			$serviceToDelete = $serviceHandler->createDummyService()->id;
			$amountOfServicesBefore = 1;
		}

		$actor = $this->getActor("Admin");

		$response = $this->actingAs($actor)->delete("/service/$serviceToDelete");
		$response->assertOk();
		$this->checkIfServiceNumberDecreased($amountOfServicesBefore);
	}
}
