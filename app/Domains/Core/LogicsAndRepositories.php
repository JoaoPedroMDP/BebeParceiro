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
	 * @return ServiceLogic
	 */
	public function serviceLogic(): ServiceLogic
	{
		if($this->serviceLogic == null){
			$this->serviceLogic = new ServiceLogic();
		}

		return $this->serviceLogic;
	}

	/**
	 * @return ServiceRepository
	 */
	public function serviceRepository(): ServiceRepository
	{
		if($this->serviceRepository == null){
			$this->serviceRepository = new ServiceRepository();
		}

		return $this->serviceRepository;
	}

	/**
	 * @var ImageLogic
	 */
	public $imageLogic;

	/**
	 * @var ImageRepository
	 */
	public $imageRepository;

	/**
	 * @return ImageLogic
	 */
	public function imageLogic(): ImageLogic
	{
		if($this->imageLogic == null){
			$this->imageLogic = new ImageLogic();
		}

		return $this->imageLogic;
	}

	/**
	 * @return ImageRepository
	 */
	public function imageRepository(): ImageRepository
	{
		if($this->imageRepository == null){
			$this->imageRepository = new ImageRepository();
		}

		return $this->imageRepository;
	}


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