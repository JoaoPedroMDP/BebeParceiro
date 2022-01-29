<?php
declare(strict_types=1);

namespace App\Domains\Benefited\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;

/**
 * Class StoreBenefitedCommand
 * @package App\Domains\Benefited\CQRS
 */
class StoreBenefitedCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'token' => [
			'rules' => ['required', 'string']
		],
		'childCount' => [
			'rules' => ['required', 'integer']
		],
		'birthday' => [
			'rules' => ['required', 'string']
		],
		'maritalStatus' => [
			'rules' => ['required', 'string']
		],
		'familiarIncome' => [
			'rules' => ['required', 'float']
		],
		'socialBenefits' => [
			'rules' => ['required', 'array']
		],
		'hasDisablement' => [
			'rules' => ['required', 'boolean']
		],
		'user' => [
			'rules' => ['required', 'array']
		],
		'address' => [
			'rules' => ['required', 'array']
		],
		'child' => [
			'rules' => ['required', 'array']
		],

		'pregnancy' => [
			'rules' => ['nullable', 'array']
		],
	];

	/**
	 * As variáveis estão no final do arquivo, era muita coisa
	 * @param string $token
	 * @param int $childCount
	 * @param string $birthday
	 * @param bool $isPregnant
	 * @param string $maritalStatus
	 * @param float $familiarIncome
	 * @param array $socialBenefits
	 * @param bool $hasDisablement
	 * @param array $user
	 * @param array $address
	 * @param array $child
	 * @param array $pregnancy
	 */
	public function __construct(string $token, int $childCount, string $birthday, bool $isPregnant, string $maritalStatus, float $familiarIncome, array $socialBenefits, bool $hasDisablement,
	                            array  $user, array $address, array $child, array $pregnancy)
	{
		$this->token = $token;
		$this->childCount = $childCount;
		$this->birthday = $birthday;
		$this->isPregnant = $isPregnant;
		$this->maritalStatus = $maritalStatus;
		$this->familiarIncome = $familiarIncome;
		$this->socialBenefits = $socialBenefits;
		$this->hasDisablement = $hasDisablement;
		$this->user = $user;
		$this->address = $address;
		$this->child = $child;
		$this->pregnancy = $pregnancy;
	}


	/**
	 * @param array $data
	 * @return StoreBenefitedCommand
	 */
	public static function fromArray(array $data): StoreBenefitedCommand
	{
		self::formatBenefitedFields($data);
		self::validate($data, self::FIELDS);

		return new self(
			$data['token'],
			$data['childCount'],
			$data['birthday'],
			array_key_exists('pregnancy', $data) ,
			$data['maritalStatus'],
            $data['familiarIncome'],
			$data['socialBenefits'],
			$data['hasDisablement'],
			$data['user'],
			$data['address'],
			$data['child'],
			$data['pregnancy'] ?? []
		);
	}

	/**
	 * @param array $data
	 * @return void
	 */
	private static function formatBenefitedFields(array &$data)
	{
		$data['childCount'] = intval($data['childCount']);
		$data['isPregnant'] = !($data['isPregnant'] == 'false'); // Boolval não funciona, essa porcaria
		$data['familiarIncome'] = floatval($data['familiarIncome']);
		$data['hasDisablement'] = !($data['hasDisablement'] == 'false');
	}

	/**
	 * @return array
	 */
	public function getBenefitedData(): array
	{
		return [
			'child_count' => $this->childCount,
			'birthday' => $this->birthday,
			'is_pregnant' => $this->isPregnant,
			'marital_status' => $this->maritalStatus,
            'familiar_income' => $this->familiarIncome,
			'social_benefits' => $this->socialBenefits,
			'has_disablement' => $this->hasDisablement,
		];
	}

	/**
	 * @var string
	 */
	public $token;

	/**
	 * @var int
	 */
	public $childCount;

	/**
	 * @var string
	 */
	public $birthday;

	/**
	 * @var bool
	 */
	public $isPregnant;

	/**
	 * @var string
	 */
	public $maritalStatus;

	/**
	 * @var float
	 */
	public $familiarIncome;

	/**
	 * @var array
	 */
	public $socialBenefits;

	/**
	 * @var bool
	 */
	public $hasDisablement;

	// USUÁRIO
	/**
	 * @var array
	 */
	public $user;

    // ENDEREÇO
	/**
	 * @var array
	 */
	public $address;

	// CRIANÇA
	/**
	 * @var array
	 */
	public $child;

	// GRAVIDEZ
	/**
	 * @var array
	 */
	public $pregnancy;

}