<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Pregnancy;

/**
 * Class PregnancyRepository
 * @package App\Domains\Benefited\Repository
 */
class PregnancyRepository extends LogicsAndRepositories
{
	/**
	 * @param array $data
	 * @return Pregnancy
	 */
	public function storePregnancy(array $data): Pregnancy
	{
		$newPregnancy = new Pregnancy();
		$newPregnancy->fill($data);
		$newPregnancy->child()->associate($data['child']);
		$newPregnancy->save();
		return $newPregnancy;
	}
}