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
			Assert::keyExists($data, $key, "$key é obrigatório");
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
	public function isString(array $data, string $key){
		Assert::string($data[$key], "Campo '$key' precisa ser string");
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function isBool(array $data, string $key){
		Assert::boolean($data[$key], "Campo '$key' precisa ser booleano");
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
		Assert::isArray($data[$field], "Campo '$field' precisa ser um array");
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
	 * @param array $fields
	 * @return void
	 */
	public function validate(array $data, array $fields){
		foreach($fields as $field => $config){

			// Se o campo for obrigatório
			if(!in_array('nullable', $config['rules'])){
				self::keyExists($data, $field);
			}else{
				// Se tiver a regra nullable, não obrigo a existência e removo essa regra da lista dando unset no seu index
				unset(
					$config['rules'][
						array_search(
							'nullable',
							$config['rules']
						)
					]
				);
			}

			// Se o campo existir
			if(array_key_exists($field, $data)){
				foreach($config['rules'] as $rule){
					$validation = 'validate' . ucfirst($rule);
					self::$validation($data, $field);
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