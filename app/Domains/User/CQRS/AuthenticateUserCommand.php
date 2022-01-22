<?php
declare(strict_types=1);

namespace App\Domains\User\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Webmozart\Assert\Assert;

/**
 * Class AuthenticateUserCommand
 * @package App\Domains\User\CQRS
 */
class AuthenticateUserCommand extends CommandQuery
{
	use Validates;
	const FIELDS = [
		'login' => [
			'rules' => ['required', 'string']
		],
		'password' => [
			'rules' => ['required', 'string']
		]
	];

	/**
	 * @var string
	 */
	public $login;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @param string $login
	 * @param string $password
	 */
	public function __construct(string $login, string $password)
	{
		$this->login = $login;
		$this->password = $password;
	}

	/**
	 * @param array $data
	 * @return AuthenticateUserCommand
	 */
	public static function fromArray(array $data): AuthenticateUserCommand
	{
		self::validate($data, self::FIELDS);

		return new self(
			$data['login'],
			$data['password']
		);
	}
}