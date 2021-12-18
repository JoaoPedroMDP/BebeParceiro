<?php
declare(strict_types=1);

namespace App\Domains\Service\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Image\CQRS\StoreImageCommand;
use App\Domains\Service\CQRS\StoreServiceCommand;
use App\Domains\Service\CQRS\UpdateServiceCommand;
use App\Domains\Service\Exceptions\DeletionFailed;
use App\Domains\Service\Exceptions\ServiceNotFound;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
			"path" => "service",
			"fileName" => $command->name
		];

		$image = $this->imageLogic()->storeImage(StoreImageCommand::fromArray($storeImageData));
		$service = $this->repository('service')->storeService($command->toArray());
		$service->image()->save($image);
		$service->save();

		return $service;
	}

	/**
	 * @param UpdateServiceCommand $command
	 * @return void
	 * @throws ServiceNotFound
	 */
	public function updateService(UpdateServiceCommand $command)
	{
		$service = $this->getFirstServiceWhere("id", $command->id);

		$this->serviceRepository()->updateService($service, $command->toArray());

		if(!is_null($command->image))
		{
			$this->updateServiceImage($service, $command->image);
		}

		$service->refresh();
		return $service;
	}

	/**
	 * @param string $field
	 * @param $value
	 * @return void
	 * @throws ServiceNotFound
	 */
	private function getFirstServiceWhere(string $field, $value): Service
	{
		$service = $this->serviceRepository()->getFirstServiceWhere($field, $value);

		if( is_null($service) ){
			throw new ServiceNotFound();
		}

		return $service;
	}

	/**
	 * @param Service $service
	 * @param UploadedFile $image
	 * @return void
	 */
	private function updateServiceImage(Service $service, UploadedFile $image)
	{
		$oldImage = $service->getImage();
		$this->imageRepository()->deleteImage($oldImage);

		$newImage = $this->imageLogic()->storeImage(
			StoreImageCommand::fromArray([
				"image" => $image,
				"description" => $service->getDescription(),
				"path" => "service",
				"fileName" => $service->getName()
			])
		);
		$service->image()->save($newImage);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws ServiceNotFound
	 * @throws DeletionFailed
	 */
	public function deleteService(int $id)
	{
		$service = $this->serviceLogic()->getFirstServiceWhere("id", $id);
		$this->imageLogic()->deleteImage($service->getImage());
		if(!$service->delete()){
			throw new DeletionFailed();
		}
	}
}