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
		'username' => [
			'rules' => ['string']
		],
		'password' => [
			'rules' => ['string']
		]
	];

	/**
	 * @var string
	 */
	public $username;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @param string $username
	 * @param string $password
	 * @param array $fields
	 */
	public function __construct(string $username, string $password, array $fields)
	{
		$this->username = $username;
		$this->password = $password;
		$this->fields = $fields;
	}

	/**
	 * @param array $data
	 * @return AuthenticateUserCommand
	 */
	public static function fromArray(array $data): AuthenticateUserCommand
	{
		self::validate($data, self::FIELDS);

		return new self(
			$data['username'],
			$data['password'],
			array_keys(self::FIELDS)
		);
	}
}