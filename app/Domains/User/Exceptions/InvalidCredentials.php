<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use Exception;

/**
 * Class InvalidCredentials
 * @package App\Domains\User\Exceptions
 */
class InvalidCredentials extends Exception
{
	public function __construct()
	{
		parent::__construct("Credenciais inválidas");
	}
}