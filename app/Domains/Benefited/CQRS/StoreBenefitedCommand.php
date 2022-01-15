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

	const BENEFITED_FIELDS = [
		'name', 'surname', 'childCount', 'birthday',
		'isPregnant', 'maritalStatus', 'email', 'telephone',
		'familiarIncome', 'socialBenefits', 'hasDisablement'
	];
	const ADDRESS_FIELDS = [
		'street', 'houseNumber', 'cep',
		'city', 'complement', 'referencePoint'
	];
	const CHILD_FIELDS = [
		'childName', 'childSurname', 'childSex',
		'childBirthday', 'measurements'
	];
	const PREGNANCY_FIELDS = [
		'sex', 'riskyPregnancy', 'fetusName',
		'birthdayForecast', 'weightForecast'
	];
	// A declaração das outras variáveis está no final da classe

	/**
	 * @param string $name
	 * @param string $surname
	 * @param int $childCount
	 * @param string $birthday
	 * @param bool $isPregnant
	 * @param string $maritalStatus
	 * @param string $email
	 * @param string $telephone
	 * @param float $familiarIncome
	 * @param array $socialBenefits
	 * @param bool $hasDisablement
	 * @param string $street
	 * @param string $houseNumber
	 * @param int $cep
	 * @param string $city
	 * @param string $complement
	 * @param string $referencePoint
	 * @param string|null $sex
	 * @param bool|null $riskyPregnancy
	 * @param string|null $fetusName
	 * @param string|null $birthdayForecast
	 * @param float|null $weightForecast
	 * @param string|null $childName
	 * @param string|null $childSurname
	 * @param string|null $childSex
	 * @param string|null $childBirthday
	 * @param array|null $measurements
	 * misericórdia é muita coisa
	 */
	public function __construct(
		string $name, string $surname, int $childCount, string $birthday,
		bool $isPregnant, string $maritalStatus, string $email, string $telephone,
		float $familiarIncome, array $socialBenefits, bool $hasDisablement, string $street,
		string $houseNumber, int $cep, string $city, string $complement,
		string $referencePoint, ?string $sex, ?bool $riskyPregnancy, ?string $fetusName,
		?string $birthdayForecast, ?float $weightForecast, ?string $childName, ?string $childSurname,
		?string $childSex, ?string $childBirthday, ?array $measurements)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->childCount = $childCount;
		$this->birthday = $birthday;
		$this->isPregnant = $isPregnant;
		$this->maritalStatus = $maritalStatus;
		$this->email = $email;
		$this->telephone = $telephone;
		$this->familiarIncome = $familiarIncome;
		$this->socialBenefits = $socialBenefits;
		$this->hasDisablement = $hasDisablement;
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->cep = $cep;
		$this->city = $city;
		$this->complement = $complement;
		$this->referencePoint = $referencePoint;
		$this->sex = $sex;
		$this->riskyPregnancy = $riskyPregnancy;
		$this->fetusName = $fetusName;
		$this->birthdayForecast = $birthdayForecast;
		$this->weightForecast = $weightForecast;
		$this->childName = $childName;
		$this->childSurname = $childSurname;
		$this->childSex = $childSex;
		$this->childBirthday = $childBirthday;
		$this->measurements = $measurements;
	}

	/**
	 * @param array $data
	 * @return void
	 */
	public static function fromArray(array $data){
		$mandatoryFields = array_merge(self::BENEFITED_FIELDS,self::ADDRESS_FIELDS);
		$allFields = array_merge($mandatoryFields, self::CHILD_FIELDS, self::PREGNANCY_FIELDS);
		self::validateBenefitedFields($data);
		self::keysExists($data, $mandatoryFields);
	}

	/**
	 * @param array $data
	 * @return void
	 */
	private static function validateBenefitedFields(array $data)
	{
		$stringFields = ['name', 'surname', 'birthday', 'maritalStatus', 'email', 'telephone'];
		foreach($stringFields as $field){
			self::isString($data, $field);
		}
		self::isInteger($data, 'childCount');

		$boolFields = ['isPregnant', 'hasDisablement'];
		foreach($boolFields as $field){
			self::isBool($data, $field);
		}

		self::isFloat($data, 'familiarIncome');
		self::isArray($data, 'socialBenefits');
	}

	/**
	 * @return array
	 */
	public function getBenefitedData(): array
	{
		$fields = [];
		foreach(self::BENEFITED_FIELDS as $field){
			$fields[$field] = $this->$field;
		}

		return $fields;
	}

	/**
	 * @return array
	 */
	public function getAddressData(): array
	{
		$fields = [];
		foreach(self::ADDRESS_FIELDS as $field){
			$fields[$field] = $this->$field;
		}

		return $fields;
	}

	/**
	 * @return array
	 */
	public function getPregnancyData(): array
	{
		$fields = [];
		foreach(self::PREGNANCY_FIELDS as $field){
			$fields[$field] = $this->$field;
		}

		return $fields;
	}

	/**
	 * @return array
	 */
	public function getChildData(): array
	{
		$fields = [];
		foreach(self::CHILD_FIELDS as $field){
			$fields[$field] = $this->$field;
		}

		return $fields;
	}


	// Deixei aqui embaixo pois eram muitas variáveis e estava atrapalhando no desenvolvimento
	// Dados da mãe
	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $surname;

	/**
	 * @var integer
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
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $telephone;

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

	// Dados de endereço

	/**
	 * @var string
	 */
	public $street;

	/**
	 * Precisa ser string pois pode conter letras, como 735A
	 * @var string
	 */
	public $houseNumber;

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
	public $referencePoint;

	// Dados da gestação

	/**
	 * @var string|null
	 */
	public $sex;

	/**
	 * @var bool|null
	 */
	public $riskyPregnancy;

	/**
	 * @var string|null
	 */
	public $fetusName; // Eu sei que é um nome estranho mas é em prol da organização

	/**
	 * @var string|null
	 */
	public $birthdayForecast;

	/**
	 * @var float|null
	 */
	public $weightForecast;

	// Dados do recém nascido

	/**
	 * @var string|null
	 */
	public $childName;

	/**
	 * @var string|null
	 */
	public $childSurname;

	/**
	 * @var string|null
	 */
	public $childSex;

	/**
	 * @var string|null
	 */
	public $childBirthday;

	// Medidas
	/**
	 * @var array|null
	 */
	public $measurements;
}