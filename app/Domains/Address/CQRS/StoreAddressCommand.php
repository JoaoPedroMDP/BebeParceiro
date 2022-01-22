<?php
declare(strict_types=1);

namespace App\Domains\Address\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use App\Models\User;
use Webmozart\Assert\Assert;

/**
 * Class StoreAddressCommand
 * @package App\Domains\Address\CQRS
 */
class StoreAddressCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'street' => [
			'rules' => ['required', 'string']
		],
		'number' => [
			'rules' => ['required', 'string']
		],
		'cep' => [
			'rules' => ['required', 'integer']
		],
		'city' => [
			'rules' => ['required', 'string']
		],
		'complement' => [
			'rules' => ['required', 'string']
		],
		'reference' => [
			'rules' => ['required', 'string']
		],
		'user' => [
			'rules' => ['required', 'user']
		]
	];

	/**
	 * @var string
	 */
	public $street;

	/**
	 * @var string
	 */
	public $number;

	/**
	 * @var integer
	 */
	public $cep;

	/**
	 * @var string
	 */
	public $city;

	/**
	 * @var string
	 */
	public $complement;

	/**
	 * @var string
	 */
	public $reference;

	/**
	 * @var User
	 */
	public $user;

	/**
	 * @param string $street
	 * @param string $number
	 * @param int $cep
	 * @param string $city
	 * @param string $complement
	 * @param string $reference
	 * @param User $user
	 */
	public function __construct(string $street, string $number, int $cep, string $city, string $complement, string $reference, User $user)
	{
		$this->street = $street;
		$this->number = $number;
		$this->cep = $cep;
		$this->city = $city;
		$this->complement = $complement;
		$this->reference = $reference;
		$this->user = $user;
	}

	/**
	 * @param array $data
	 * @return StoreAddressCommand
	 */
	public static function fromArray(array $data): StoreAddressCommand
	{
		Assert::regex($data['cep'], '/\d{8}/');
		Assert::maxLength($data['complement'], 20);
		Assert::maxLength($data['reference'], 50);
		self::formatAddressFields($data);

		return new self(
			$data['street'],
			$data['number'],
			$data['cep'],
			$data['city'],
			$data['complement'],
			$data['reference'],
			$data['user']
		);
	}

	/**
	 * @param array $data
	 * @return void
	 */
	private static function formatAddressFields(array &$data){
		$data['cep'] = intval($data['cep']);
	}
}