<?php
declare(strict_types=1);

namespace Tests\Helpers;

use App\Domains\Appointment\CQRS\CreateAppointmentCommand;
use App\Domains\Appointment\Exceptions\AppointmentInPast;
use App\Domains\Appointment\Logic\AppointmentLogic;
use App\Domains\Service\Exceptions\ServiceNotFound;
use App\Models\Appointment;
use App\Models\User;

/**
 * Class AppointmentHandler
 * @package Tests\Helpers
 */
Class AppointmentHandler
{
	/**
	 * @param User $actor
	 * @return Appointment
	 * @throws AppointmentInPast
	 * @throws ServiceNotFound
	 */
	public function createDummyAppointment(User $actor): Appointment
	{
		$serviceHandler = new ServiceHandler();
		$service = $serviceHandler->createDummyService();
		$appointmentLogic = new AppointmentLogic();

		return $appointmentLogic->createAppointment(CreateAppointmentCommand::fromArray([
			'name' => 'Teste',
			'datetime' => now()->addWeek()->format("d-m-Y H:i:s"),
			'serviceId' => $service->id
		]), [$actor]);
	}
}