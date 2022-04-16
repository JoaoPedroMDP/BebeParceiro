<?php
declare(strict_types=1);

namespace App\Domains\Core;

use App\Domains\Appointment\Exceptions\AppointmentInPast;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\UploadedFile;
use Webmozart\Assert\Assert;

/**
 * Trait Validates
 * @package App\Domains\Core
 */
trait Validates
{
	/**
	 * @param array $data
	 * @param array $keys
	 * @return void
	 */
	public function keysExists(array $data, array $keys){
		foreach($keys as $key){
			self::keyExists($data, $key);
		}
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function keyExists(array $data, string $key){
		Assert::keyExists($data, $key, "Campo '$key' é obrigatório");
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function keyIsNotNull(array $data, string $key){
		Assert::notNull($data[$key], "Campo $key não pode ser vazio");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public function validateArray(array $data, string $field){
		Assert::isArray($data[$field], "Campo '$field' precisa ser um array");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public function validateInteger(array $data, string $field){
		Assert::integer($data[$field], "Campo '$field' precisa ser um inteiro");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public function validateBoolean(array $data, string $field){
		Assert::boolean($data[$field], "Campo '$field' precisa ser um booleano");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public function validateString(array $data, string $field){
		Assert::string($data[$field], "Campo '$field' precisa ser uma string");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public function validateFloat(array $data, string $field){
		Assert::float($data[$field], "Campo '$field' precisa ser decimal");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 * @throws AppointmentInPast
	 */
	public static function validateFutureDatetime(array $data, string $field)
	{
		try {
			$parsed = Carbon::parse($data[$field]);
		}catch(InvalidFormatException $e){
			throw new InvalidFormatException("Formato da data está errado.");
		}

		if(!$parsed->isFuture()){
			throw new AppointmentInPast();
		}
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public static function validateUploadedFile(array $data, string $field){
		Assert::isInstanceOf($data[$field], UploadedFile::class, "Erro ao carregar a imagem na requisição");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public static function validateUser(array $data, string $field){
		Assert::isInstanceOf($data[$field], User::class, "Erro ao carregar o usuário requisitante");
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public static function validateRequired(array $data, string $field){
		self::keyExists($data, $field);
		self::keyIsNotNull($data, $field);
	}

	/**
	 * @param array $data
	 * @param string $field
	 * @return void
	 */
	public static function validateNullable(array $data, string $field){
		return;
	}

	/**
	 * @param array $data
	 * @param array $fields
	 * @return void
	 */
	public function validate(array $data, array $fields){
		foreach($fields as $field => $config){
			// Se o campo existir
			$required = false;
			if(in_array('required', $config['rules'])){
				self::validateRequired($data, $field);
				$required = true;
			}

			if(array_key_exists($field, $data)){
				foreach($config['rules'] as $rule){
					$validation = 'validate' . ucfirst($rule);
					if($required && $data[$field] != null){
						self::$validation($data, $field);
					}
				}
			}
		}
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function isInteger(array $data, string $key){
		Assert::integer($data[$key], "$key precisa ser inteiro");
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function isFloat(array $data, string $key){
		Assert::float($data[$key], "$key precisa ser decimal");
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function isArray(array $data, string $key){
		Assert::isArray($data[$key], "$key precisa ser um array");
	}
}