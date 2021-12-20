<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Logic;

use App\Domains\Core\LogicsAndRepositories;
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
}