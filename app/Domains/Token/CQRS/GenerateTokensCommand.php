<?php
declare(strict_types=1);

namespace App\Domains\Token\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use App\Models\User;
use Exception;

/**
 * Class GenerateTokensCommand
 * @package App\Domains\Token\CQRS
 */
class GenerateTokensCommand extends CommandQuery
{
	use Validates;

	/**
	 * @var int
	 */
	public $amount;

	/**
	 * @var User
	 */
	public $user;

	/**
	 * @param int $amount
	 * @param User $user
	 * @param array $fields
	 */
	public function __construct(int $amount, User $user, array $fields)
	{
		$this->amount = $amount;
		$this->user = $user;
		$this->fields = $fields;
	}

	/**
	 * @throws Exception
	 */
	public static function fromArray(User $user, $amount): GenerateTokensCommand
	{
		$fields = ['user', 'amount'];

		$amount = intval($amount);
		if($amount == 0){
			throw new Exception("Não é posível gerar $amount tokens");
		}

		return new self(
			$amount,
			$user,
			$fields
		);
	}
}