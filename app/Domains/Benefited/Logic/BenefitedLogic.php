<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Logic;

use App\Domains\Address\CQRS\StoreAddressCommand;
use App\Domains\Benefited\CQRS\StoreBenefitedCommand;
use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Token\CQRS\CheckTokenQuery;
use App\Domains\Token\Exceptions\TokenAlreadyUsed;
use App\Domains\Token\Exceptions\TokenNotFound;
use App\Domains\User\CQRS\StoreUserCommand;
use App\Domains\User\Exceptions\LoginAlreadyTaken;
use App\Models\User;

/**
 * Class BenefitedLogic
 * @package App\Domains\Benefited\Logic
 */
class BenefitedLogic extends LogicsAndRepositories
{

	/**
	 * @param StoreBenefitedCommand $command
	 * @return void
	 * @throws TokenAlreadyUsed
	 * @throws TokenNotFound
	 * @throws LoginAlreadyTaken
	 */
	public function storeBenefited(StoreBenefitedCommand $command)
	{
		$this->tokenLogic()->checkToken(CheckTokenQuery::fromArray(['token' => $command->token]));
		$benefitedUser = $this->userLogic()->storeUser(StoreUserCommand::fromArray($command->user));
		$this->storeAddressForBenefited($command->address, $benefitedUser);

		$benefitedParams = array_merge(
			['user' => $benefitedUser],
			$command->getBenefitedData()
		);
		$this->benefitedRepository()->storeBenefited($benefitedParams);
		//TODO: Verificar casos especiais: criança ou gravidez
		//TODO: Invalidar o token usado
//		$this->tokenLogic()->useToken($command->token);
		dd("chegou aqui amém");
	}

	/**
	 * @param array $addressData
	 * @param User $benefitedUser
	 * @return void
	 */
	private function storeAddressForBenefited(array $addressData, User $benefitedUser)
	{
		$addressParams = array_merge(
			['user' => $benefitedUser],
			$addressData
		);
		$this->addressLogic()->storeAddress(StoreAddressCommand::fromArray($addressParams), $benefitedUser);
	}
}