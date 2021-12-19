<?php
declare(strict_types=1);

namespace App\Domains\Core;

/**
 * Class Command
 * @package App\Domains\Core
 */
class Command
{
	/**
	 * @var array
	 */
	protected $fields;

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		$array = [];
		foreach($this->fields as $field){
			$array[$field] = $this->$field;
		}

		return $array;
	}
}