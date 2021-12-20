<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\User;

/**
 * Class AppointmentLogic
 * @package App\Domains\Appointment\Logic
 */
class AppointmentLogic extends LogicsAndRepositories
{
	/**
	 * @param User $user
	 * @return void
	 */
	public function indexAppointments(User $user)
	{
		return $this->appointmentRepository()->getAppointmentsFromUser($user);
	}
}