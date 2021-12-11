<?php
declare(strict_types=1);

namespace App\Domains\Core;

use App\Domains\Image\Logic\ImageLogic;
use App\Domains\Image\Repository\ImageRepository;
use App\Domains\Service\Logic\ServiceLogic;
use App\Domains\Service\Repository\ServiceRepository;

/**
 * Class LogicsAndRepositories
 * @package App\Domains\Core
 */
class LogicsAndRepositories
{
	/**
	 * @var ServiceLogic
	 */
	public $serviceLogic;

	/**
	 * @var ServiceRepository
	 */
	public $serviceRepository;

	/**
	 * @var ImageLogic
	 */
	public $imageLogic;

	/**
	 * @var ImageRepository
	 */
	public $imageRepository;

	/**
	 * @param string $logicName
	 * @return ServiceLogic | ImageLogic
	 */
	public function logic(string $logicName)
	{
		$varName = $logicName . "Logic";
		if($this->$varName == null){
				$className = "App\\Domains\\" . ucwords($logicName) . "\\Logic\\" . ucwords($logicName) . "Logic"; // ucwords capitaliza a string que passo
				$this->$varName = new $className;
		}

		return $this->$varName;
	}

	/**
	 * @param string $repositoryName
	 * @return ServiceRepository | ImageRepository
	 */
	public function repository(string $repositoryName)
	{
		$varName = $repositoryName . "Repository";
		if($this->$varName == null){
				$className = "App\\Domains\\" . ucwords($repositoryName) . "\\Repository\\" . ucwords($repositoryName) . "Repository";
				$this->$varName = new $className;
		}

		return $this->$varName;
	}
}