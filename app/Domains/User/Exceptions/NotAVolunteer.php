<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class NotAVolunteer
 * @package App\Domains\User\Exceptions
 */
class NotAVolunteer extends BenignException
{

	public function __construct()
	{
		parent::__construct("Este usuário não é um voluntário", 400);
	}
}