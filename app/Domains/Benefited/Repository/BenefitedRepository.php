<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Benefited;

/**
 * Class BenefitedRepository
 * @package App\Domains\Benefited\Repository
 */
class BenefitedRepository extends LogicsAndRepositories
{
	/**
	 * @param array $benefitedParams
	 * @return Benefited
	 */
	public function storeBenefited(array $benefitedParams): Benefited
	{
		$newBenefited = new Benefited;
		$newBenefited->fill($benefitedParams);
		$newBenefited->user()->associate($benefitedParams['user']);
		$newBenefited->approved = false;
		$newBenefited->save();
		return $newBenefited;
	}
}