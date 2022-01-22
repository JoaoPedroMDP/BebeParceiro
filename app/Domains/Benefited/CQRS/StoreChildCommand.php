<?php
declare(strict_types=1);

namespace App\Domains\Benefited\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use App\Models\Benefited;
use Webmozart\Assert\Assert;

/**
 * Class StoreChildCommand
 * @package App\Domains\Benefited\CQRS
 */
class StoreChildCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'name' => [
			'rules' => ['required', 'string']
		],
		'surname' => [
			'rules' => ['required', 'string']
		],
		'sex' => [
			'rules' => ['required', 'string']
		],
		'birthday' => [
			'rules' => ['required', 'string']
		],
		'measurements' => [
			'rules' => ['required', 'array']
		],
		'weight' => [
			'rules' => ['required', 'float']
		],
		'benefited' => [
			'rules' => ['required']
		]
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
	public $sex;

	/**
	 * @var string
	 */
	public $birthday;

	/**
	 * @var array
	 */
	public $measurements;

	/**
	 * @var Benefited
	 */
	public $benefited;

	/**
	 * @var float
	 */
	public $weight;

	/**
	 * @param string $name
	 * @param string $surname
	 * @param string $sex
	 * @param string $birthday
	 * @param array $measurements
	 * @param Benefited $benefited
	 * @param float $weight
	 */
	public function __construct(string $name, string $surname, string $sex, string $birthday, array $measurements, Benefited $benefited, float $weight)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->sex = $sex;
		$this->birthday = $birthday;
		$this->measurements = $measurements;
		$this->benefited = $benefited;
		$this->weight = $weight;
	}

	/**
	 * @param array $data
	 * @return StoreChildCommand
	 */
	public static function fromArray(array $data): StoreChildCommand
	{
		$data['weight'] = floatval($data['weight']);
		self::validate($data, self::FIELDS);
		Assert::isInstanceOf($data['benefited'], Benefited::class, "Erro ao recuperar o beneficiário relacionado");
		return new self(
			$data['name'],
			$data['surname'],
			$data['sex'],
			$data['birthday'],
			$data['measurements'],
			$data['benefited'],
			$data['weight']
		);
	}
}