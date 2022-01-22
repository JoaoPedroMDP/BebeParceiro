<?php
declare(strict_types=1);

namespace Tests\Helpers;

use App\Domains\Service\CQRS\StoreServiceCommand;
use App\Domains\Service\Logic\ServiceLogic;
use App\Models\Service;
use Illuminate\Http\UploadedFile;

/**
 * Class ServiceHandler
 * @package Tests\Helpers
 */
class ServiceTestHelper
{
	/**
	 * @return Service
	 */
	public function createDummyService(): Service
	{
		$serviceLogic = new ServiceLogic();
		return $serviceLogic->storeService(
			StoreServiceCommand::fromArray([
				'name' => "Serviço teste",
				'image'=> new UploadedFile(resource_path('testFiles/image2.jpg'), 'dummyService.jpg', null, null, true),
				'description' => "Descrição teste"
			])
		);
	}
}