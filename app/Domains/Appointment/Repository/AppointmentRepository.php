<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Repository;

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
}