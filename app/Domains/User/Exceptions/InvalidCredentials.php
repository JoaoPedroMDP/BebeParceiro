<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class InvalidCredentials
 * @package App\Domains\User\Exceptions
 */
class InvalidCredentials extends BenignException
{
	public function __construct()
	{
		parent::__construct("Credenciais inválidas", 400);
	}
}