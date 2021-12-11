<?php
declare(strict_types=1);

namespace App\Domains\Service\Repository;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ServiceRepository
 * @package App\Domains\Service\Repository
 */
class ServiceRepository
{

	/**
	 * @return Collection|Service[]
	 */
	public function indexRepositories()
	{
		return Service::all();
	}

	/**
	 * @param array $data
	 * @return Service
	 */
	public function storeService(array $data): Service
	{
		$newService = new Service();
		$newService->setName($data['name']);
		$newService->setDescription($data['description']);
		$newService->setEnabled(true);
		$newService->save();
		return $newService;
	}

	/**
	 * @param string $field
	 * @param $value
	 * @return Service|null
	 */
	public function getFirstServiceWhere(string $field, $value): ?Service
	{
//		dd($field, $value);
		return Service::where($field, '=', $value)->first();
	}

	/**
	 * @param Service $service
	 * @param array $newData
	 * @return void
	 */
	public function updateService(Service $service, array $newData)
	{
		$service->update($newData);
	}
}