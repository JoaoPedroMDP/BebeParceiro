<?php
declare(strict_types=1);

namespace App\Domains\Core;

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
}