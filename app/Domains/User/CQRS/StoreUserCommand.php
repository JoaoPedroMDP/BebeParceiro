<?php
declare(strict_types=1);

namespace App\Domains\User\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Webmozart\Assert\Assert;

/**
 * Class StoreUserCommand
 * @package App\Domains\User\CQRS
 */
class StoreUserCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'name' => [
			'rules' => ['required', 'string']
		],
		'surname' => [
			'rules' => ['required', 'string']
		],
		'telephone' => [
			'rules' => ['required', 'string']
		],
		'password' => [
			'rules' => ['required', 'string']
		],
	];

	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $surname;
	/**
	 * @var string
	 */
	public $telephone;
	/**
	 * @var string
	 */
	public $password;

	/**
	 * @param string $name
	 * @param string $surname
	 * @param string $telephone
	 * @param string $password
	 */
	public function __construct(string $name, string $surname, string $telephone, string $password)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->telephone = $telephone;
		$this->password = $password;
	}

	/**
	 * @param array $data
	 * @return StoreUserCommand
	 */
	public static function fromArray(array $data): StoreUserCommand
	{
		self::validate($data, self::FIELDS);
		Assert::eq($data['password_confirmation'], $data['password'], "A senha e sua repetição precisam ser iguais!");

		return new self(
			$data['name'],
			$data['surname'],
			$data['telephone'],
			$data['password']
		);
	}
}