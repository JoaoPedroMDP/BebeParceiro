<?php
declare(strict_types=1);

namespace App\Domains\Core;

/**
 * Class CommandQuery
 * @package App\Domains\Core
 */
class CommandQuery
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