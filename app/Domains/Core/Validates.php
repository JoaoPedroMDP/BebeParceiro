<?php
declare(strict_types=1);

namespace App\Domains\Core;

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
	public function isString(array $data, string $key){
		Assert::string($data[$key], "$key precisa ser string");
	}

	/**
	 * @param array $data
	 * @param string $key
	 * @return void
	 */
	public function isBool(array $data, string $key){
		Assert::boolean($data[$key], "$key precisa ser booleano");
	}
}