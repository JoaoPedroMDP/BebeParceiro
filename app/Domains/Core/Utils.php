<?php
declare(strict_types=1);

namespace App\Domains\Core;

use Exception;

/**
 * Class Utils
 * @package App\Domains\Core
 */
class Utils
{
	/**
	 * @param string $keyToFind
	 * @param array $data
	 * @return array
	 */
	public function extractFromArray(string $keyToFind, array $data): array
	{
		$usefulData = [];
		foreach($data as $key => $value){
			if($key == $keyToFind){
				$usefulData = array_merge(
					$usefulData,
					[$value->id]
				);
			}else if(is_array($value)){
				$usefulData = array_merge(
					$usefulData,
					$this->extractFromArray($keyToFind, $value)
				);
			}
		}

		return $usefulData;
	}

	/**
	 * @param int $size
	 * @return string
	 * @throws Exception
	 */
	public function randomAlphaString(int $size = 16): string
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($i = 0; $i < $size; $i++){
			$string .= $chars[random_int(0, count(str_split($chars)) - 1)];
		}

		return $string;
	}
}