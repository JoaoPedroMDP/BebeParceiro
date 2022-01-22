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
	 * @return array
	 */
	public function toArray(): array
	{
		$array = [];
		$class = get_called_class(); // Preciso disso para puxar a constante da classe filha, e não essa vazia aí em cima
		foreach($class::FIELDS as $field => $config){
			$array[$this->snake($field)] = $this->$field;
		}

		return $array;
	}

	/**
	 * Peguei em https://gist.github.com/davidon/f9b9972a8167d0e386f96d74d85a96ea
	 * @param string $value
	 * @param string $delimiter
	 * @return string
	 */
	public function snake(string $value, string $delimiter = '_'): string
	{
		if (!ctype_lower($value)) {
			$value = (string) preg_replace('/\s+/u', '', \ucwords($value));
			$value = (string) mb_strtolower(
				preg_replace(
					'/(.)(?=[A-Z])/u',
					'$1' . $delimiter,
					$value
				)
			);
		}

		return $value;
	}
}