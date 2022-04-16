<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Logic;

use App\Domains\Address\CQRS\StoreAddressCommand;
use App\Domains\Benefited\CQRS\IndexNewBeneficiariesQuery;
use App\Domains\Benefited\CQRS\StoreBenefitedCommand;
use App\Domains\Benefited\CQRS\StoreChildCommand;
use App\Domains\Benefited\CQRS\StorePregnancyCommand;
use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Token\CQRS\CheckTokenQuery;
use App\Domains\Token\Exceptions\TokenAlreadyUsed;
use App\Domains\Token\Exceptions\TokenNotFound;
use App\Domains\User\CQRS\StoreUserCommand;
use App\Domains\User\Exceptions\UsernameAlreadyTaken;
use App\Models\Benefited;
use App\Models\Child;
use App\Models\Pregnancy;
use App\Models\User;

/**
 * Class BenefitedLogic
 * @package App\Domains\Benefited\Logic
 */
class BenefitedLogic extends LogicsAndRepositories
{

	/**
	 * @param StoreBenefitedCommand $command
	 * @return Benefited
	 * @throws TokenAlreadyUsed
	 * @throws TokenNotFound
	 * @throws UsernameAlreadyTaken
	 */
	public function storeBenefited(StoreBenefitedCommand $command): Benefited
	{
		$this->tokenLogic()->checkToken(CheckTokenQuery::fromArray(['token' => $command->token]));
		$benefitedUser = $this->userLogic()->storeUser(StoreUserCommand::fromArray($command->user));
		$this->storeAddressForBenefited($command->address, $benefitedUser);

		$benefitedParams = array_merge(
			['user' => $benefitedUser],
			$command->getBenefitedData()
		);
		$benefited = $this->benefitedRepository()->storeBenefited($benefitedParams);

		$child = $this->storeChild($command->child, $benefited);
		if($command->isPregnant){
			$pregnancy = $this->storePregnancy($command->pregnancy, $child);
		}

		$this->tokenLogic()->useToken($command->token);
		return $benefited;
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

	/**
	 * @param array $child
	 * @param Benefited $benefited
	 * @return Child
	 */
	private function storeChild(array $child, Benefited $benefited): Child
	{
		$params = array_merge(
			['benefited' => $benefited],
			$child
		);

		return $this->childRepository()->storeChild(StoreChildCommand::fromArray($params)->toArray());
	}

	/**
	 * @param array $pregnancyData
	 * @param Child $child
	 * @return Pregnancy
	 */
	private function storePregnancy(array $pregnancyData, Child $child): Pregnancy
	{
		$params = array_merge(
			['child' => $child],
			$pregnancyData
		);

		return $this->pregnancyRepository()->storePregnancy(StorePregnancyCommand::fromArray($params)->toArray());
	}

	/**
	 * @param IndexNewBeneficiariesQuery $query
	 * @return array
	 */
	public function indexNewBeneficiaries(IndexNewBeneficiariesQuery $query): array
	{
		$benefitedData = $this->benefitedRepository()->indexNewBeneficiaries($query->page);
		$inArray = [];
		foreach($benefitedData as $item){
			$inArray[] = $item->toArray();
		}

		return $this->tableLogic()->generateTable($inArray, $query->page, $benefitedData->total(), $benefitedData->lastPage());
	}
}