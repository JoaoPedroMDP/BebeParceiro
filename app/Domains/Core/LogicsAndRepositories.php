<?php
declare(strict_types=1);

namespace App\Domains\Core;

use App\Domains\Address\Logic\AddressLogic;
use App\Domains\Address\Repository\AddressRepository;
use App\Domains\Appointment\Logic\AppointmentLogic;
use App\Domains\Appointment\Repository\AppointmentRepository;
use App\Domains\Benefited\Logic\BenefitedLogic;
use App\Domains\Benefited\Repository\BenefitedRepository;
use App\Domains\Image\Logic\ImageLogic;
use App\Domains\Image\Repository\ImageRepository;
use App\Domains\Service\Logic\ServiceLogic;
use App\Domains\Service\Repository\ServiceRepository;
use App\Domains\Token\Logic\TokenLogic;
use App\Domains\Token\Repository\TokenRepository;
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

	/**
	 * @var AppointmentLogic
	 */
	public $appointmentLogic;

	/**
	 * @var AppointmentRepository
	 */
	public $appointmentRepository;

	/**
	 * @return AppointmentLogic
	 */
	public function appointmentLogic(): AppointmentLogic
	{
		if($this->appointmentLogic == null){
			$this->appointmentLogic = new AppointmentLogic();
		}

		return $this->appointmentLogic;
	}

	/**
	 * @return AppointmentRepository
	 */
	public function appointmentRepository(): AppointmentRepository
	{
		if($this->appointmentRepository == null){
			$this->appointmentRepository = new AppointmentRepository();
		}

		return $this->appointmentRepository;
	}

	/**
	 * @var TokenLogic
	 */
	public $tokenLogic;

	/**
	 * @var AppointmentRepository
	 */
	public $tokenRepository;

	/**
	 * @return TokenLogic
	 */
	public function tokenLogic(): TokenLogic
	{
		if($this->tokenLogic == null){
			$this->tokenLogic = new TokenLogic();
		}

		return $this->tokenLogic;
	}

	/**
	 * @return TokenRepository
	 */
	public function tokenRepository(): TokenRepository
	{
		if($this->tokenRepository == null){
			$this->tokenRepository = new TokenRepository();
		}

		return $this->tokenRepository;
	}

	/**
	 * @var BenefitedLogic
	 */
	public $benefitedLogic;

	/**
	 * @var BenefitedRepository
	 */
	public $benefitedRepository;

	/**
	 * @return BenefitedLogic
	 */
	public function benefitedLogic(): BenefitedLogic
	{
		if($this->benefitedLogic == null){
			$this->benefitedLogic = new BenefitedLogic();
		}

		return $this->benefitedLogic;
	}

	/**
	 * @return BenefitedRepository
	 */
	public function benefitedRepository(): BenefitedRepository
	{
		if($this->benefitedRepository == null){
			$this->benefitedRepository = new BenefitedRepository();
		}

		return $this->benefitedRepository;
	}




	/**
	 * @var AddressLogic
	 */
	public $addressLogic;

	/**
	 * @var AddressRepository
	 */
	public $addressRepository;

	/**
	 * @return AddressLogic
	 */
	public function addressLogic(): AddressLogic
	{
		if($this->addressLogic == null){
			$this->addressLogic = new AddressLogic();
		}

		return $this->addressLogic;
	}

	/**
	 * @return AddressRepository
	 */
	public function addressRepository(): AddressRepository
	{
		if($this->addressRepository == null){
			$this->addressRepository = new AddressRepository();
		}

		return $this->addressRepository;
	}
}