<?php
declare(strict_types=1);

namespace App\Domains\Service\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ServiceRepository
 * @package App\Domains\Service\Repositories
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
}