<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Logic;

use App\Domains\Appointment\CQRS\CreateAppointmentCommand;
use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Core\Utils;
use App\Domains\Service\Exceptions\ServiceNotFound;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AppointmentLogic
 * @package App\Domains\Appointment\Logic
 */
class AppointmentLogic extends LogicsAndRepositories
{
	/**
	 * @param User $user
	 * @return Collection
	 */
	public function indexAppointments(User $user): Collection
	{
		return $this->appointmentRepository()->getAppointmentsFromUser($user);
	}

	/**
	 * @param CreateAppointmentCommand $command
	 * @param User[] $attendees
	 * @return Appointment
	 * @throws ServiceNotFound
	 */
	public function createAppointment(CreateAppointmentCommand $command, array $attendees): Appointment
	{
		$service = $this->serviceLogic()->getFirstServiceWhere('id', $command->serviceId);
		$utils = new Utils;
		$extractedAttendeesIDs = $utils->extractFromArray('id', $attendees);
		return $this->appointmentRepository()->createAppointment($command->toArray(), $extractedAttendeesIDs, $service);
	}
}