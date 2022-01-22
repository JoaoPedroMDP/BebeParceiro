<?php
declare(strict_types=1);

namespace App\Domains\Address\Logic;

use App\Domains\Address\CQRS\StoreAddressCommand;
use App\Domains\Core\LogicsAndRepositories;
use App\Models\Address;

/**
 * Class AddressLogic
 * @package App\Domains\Address\Logic
 */
class AddressLogic extends LogicsAndRepositories
{

	/**
	 * @param StoreAddressCommand $command
	 * @return Address
	 */
	public function storeAddress(StoreAddressCommand $command): Address
	{
		// TODO: validar endereço? Não sei o que validar no momento
		return $this->addressRepository()->storeAddress($command->toArray());
	}
}