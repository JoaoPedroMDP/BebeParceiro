<?php
declare(strict_types=1);

namespace App\Domains\User\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Domains\User\Repository
 */
class UserRepository extends LogicsAndRepositories
{
	/**
	 * @param string $field
	 * @param $value
	 * @return User|null
	 */
	public function getFirstUserWhere(string $field, $value): ?User
	{
		return User::where($field, '=', $value)->first();
	}
}