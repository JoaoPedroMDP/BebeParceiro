<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class AppointmentInPast
 * @package App\Domains\Appointment\Exceptions
 */
class AppointmentInPast extends BenignException
{
	public function __construct()
	{
		parent::__construct("Só é possível marcar eventos para o futuro", 400);
	}
}