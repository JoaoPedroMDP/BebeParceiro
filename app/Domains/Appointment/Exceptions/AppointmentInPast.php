<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Exceptions;

use Exception;

/**
 * Class AppointmentInPast
 * @package App\Domains\Appointment\Exceptions
 */
class AppointmentInPast extends Exception
{
	public function __construct()
	{
		parent::__construct("Só é possível marcar eventos para o futuro");
	}
}