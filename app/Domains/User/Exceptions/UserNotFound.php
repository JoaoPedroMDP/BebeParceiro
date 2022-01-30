<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class UserNotFound
 * @package App\Domains\User\Exceptions
 */
class UserNotFound extends BenignException
{
	public function __construct()
	{
		parent::__construct("Usuário não encontrado", 404);
	}
}