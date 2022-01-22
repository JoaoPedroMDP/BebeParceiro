<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Child;

/**
 * Class ChildRepository
 * @package App\Domains\Benefited\Repository
 */
class ChildRepository extends LogicsAndRepositories
{
	/**
	 * @param array $data
	 * @return Child
	 */
	public function storeChild(array $data): Child
	{
		$newChild = new Child;
		$newChild->fill($data);
		$newChild->benefited()->associate($data['benefited']);
		$newChild->save();
		return $newChild;
	}
}