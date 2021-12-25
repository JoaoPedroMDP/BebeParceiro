<?php
declare(strict_types=1);

namespace App\Domains\Token\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Token;

/**
 * Class TokenRepository
 * @package App\Domains\Token\Repository
 */
class TokenRepository extends LogicsAndRepositories
{

	/**
	 * @param array $data
	 * @return Token
	 */
	public function createToken(array $data): Token
	{
		$newToken = new Token;
		$newToken->token = $data['token'];
		$newToken->volunteer()->associate($data['volunteer']);
		$newToken->save();
		return $newToken;
	}
}