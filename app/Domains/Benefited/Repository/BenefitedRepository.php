<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Benefited;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class BenefitedRepository
 * @package App\Domains\Benefited\Repository
 */
class BenefitedRepository extends LogicsAndRepositories
{
	const PER_PAGE = 15;

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

	/**
	 * Pega todas as mães, o nome delas na tabela User e,
	 * caso seja gravidez, se é gravidez de risco
	 * @param int $page
	 * @param array $columns
	 * @return LengthAwarePaginator
	 */
	public function indexNewBeneficiaries(int $page, array $columns = ['*']): LengthAwarePaginator
	{
		return Benefited::where('approved', '=', '0')
			->leftJoin('children', 'beneficiaries.id', '=', 'children.benefited_id')
			->leftJoin('pregnancies', 'children.id', '=', 'pregnancies.child_id')
			->join('users', 'beneficiaries.user_id', '=', 'users.id')
			->select('beneficiaries.id', 'users.name', 'pregnancies.risky_pregnancy')
		->paginate(self::PER_PAGE, $columns, 'page', $page);
	}
}