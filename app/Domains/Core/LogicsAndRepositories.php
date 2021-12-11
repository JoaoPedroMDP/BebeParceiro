<?php
declare(strict_types=1);

namespace App\Domains\Core;

use App\Domains\Images\Logic\ImageLogic;
use App\Domains\Service\Logic\ServiceLogic;
use App\Domains\Service\Repositories\ServiceRepository;

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
	 * @param string $logicName
	 * @return ServiceLogic | \App\Domains\Images\Logic\ImageLogic
	 */
	public function logic(string $logicName)
	{
		$varName = $logicName . "Logic";
		if( $this->$varName == null){
				$className = ucwords($logicName) . "Logic";
				$this->$varName = new $className;
		}

		return $this->$varName;
	}

	/**
	 * @param string $repositoryName
	 * @return ServiceRepository
	 */
	public function repository(string $repositoryName): ServiceRepository
	{
		$varName = $repositoryName . "Repository";
		if( $this->$varName == null){
				$className = "App\\Domains\\" . ucwords($repositoryName) . "\\Repositories\\" . ucwords($repositoryName) . "Repository";
				$this->$varName = new $className;
		}

		return $this->$varName;
	}
}