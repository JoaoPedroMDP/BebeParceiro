<?php
declare(strict_types=1);

namespace App\Domains\Address\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Address;

/**
 * Class AddressRepository
 * @package App\Domains\Address\Repository
 */
class AddressRepository extends LogicsAndRepositories
{
	/**
	 * @param array $data
	 * @return Address
	 */
	public function storeAddress(array $data): Address
	{
		$newAddress = new Address;
		$newAddress->fill($data);
		$newAddress->user()->associate($data['user']);
		$newAddress->save();
		return $newAddress;
	}
}