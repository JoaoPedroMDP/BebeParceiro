<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use App\Domains\Core\BenignException;
use Exception;

/**
 * Class LoginAlreadyTaken
 * @package App\Domains\User\Exceptions
 */
class LoginAlreadyTaken extends BenignException
{

	public function __construct()
	{
		parent::__construct("Este login não pode ser usado", 400);
	}
}