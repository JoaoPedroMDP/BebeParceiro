<?php
declare(strict_types=1);

namespace App\Domains\Service\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Images\CQRS\StoreImageCommand;
use App\Domains\Service\CQRS\StoreServiceCommand;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;

/**
 * Class ServiceLogic
 * @package App\Domains\Service\Logic
 */
class ServiceLogic extends LogicsAndRepositories
{
	/**
	 * @return Service[]|DatabaseCollection
	 */
	public function indexServices()
	{
			return $this->repository('service')->indexRepositories();
	}

	/**
	 * @param StoreServiceCommand $command
	 * @return Service
	 */
	public function storeService(StoreServiceCommand $command): Service
	{
		$storeImageData = [
			"image" => $command->image,
			"description" => $command->description,
			"path" => "service"
		];

		$serviceImage = $this->logic("image")->storeImage(StoreImageCommand::fromArray($storeImageData));
		return $this->repository('service')->storeService($command->toArray());
	}
}