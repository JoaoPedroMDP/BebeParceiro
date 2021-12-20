<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use Exception;

/**
 * Class UserNotFound
 * @package App\Domains\User\Exceptions
 */
class UserNotFound extends Exception
{
	public function __construct()
	{
		parent::__construct("Usuário não encontrado");
	}
}