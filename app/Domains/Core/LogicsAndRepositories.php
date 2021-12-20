<?php
declare(strict_types=1);

namespace App\Domains\Core;

use App\Domains\Image\Logic\ImageLogic;
use App\Domains\Image\Repository\ImageRepository;
use App\Domains\Service\Logic\ServiceLogic;
use App\Domains\Service\Repository\ServiceRepository;
use App\Domains\User\Logic\UserLogic;
use App\Domains\User\Repository\UserRepository;

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
	 * @var UserLogic
	 */
	public $userLogic;

	/**
	 * @var UserRepository
	 */
	public $userRepository;

	/**
	 * @return UserLogic
	 */
	public function userLogic(): UserLogic
	{
		if($this->userLogic == null){
			$this->userLogic = new UserLogic();
		}

		return $this->userLogic;
	}

	/**
	 * @return UserRepository
	 */
	public function userRepository(): UserRepository
	{
		if($this->userRepository == null){
			$this->userRepository = new UserRepository();
		}

		return $this->userRepository;
	}
}