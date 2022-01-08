<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Repository;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AppointmentRepository
 * @package App\Domains\Appointment\Repository
 */
class AppointmentRepository
{
	/**
	 * @param User $user
	 * @return Collection
	 */
	public function getAppointmentsFromUser(User $user): Collection
	{
		return $user->getAppointments();
	}

	/**
	 * @param array $data
	 * @param int[] $attendees
	 * @param Service $service
	 * @return Appointment
	 */
	public function createAppointment(array $data, array $attendees, Service $service): Appointment
	{
		$newAppointment = new Appointment;
		$newAppointment->name = $data['name'];
		$newAppointment->datetime = $data['datetime'];
		$newAppointment->service()->associate($service);
		$newAppointment->save();
		$newAppointment->users()->attach($attendees);

		return $newAppointment;
	}
}