<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use Exception;

/**
 * Class LoginAlreadyTaken
 * @package App\Domains\User\Exceptions
 */
class LoginAlreadyTaken extends Exception
{

	public function __construct()
	{
		parent::__construct("Este login não está disponível");
	}
}