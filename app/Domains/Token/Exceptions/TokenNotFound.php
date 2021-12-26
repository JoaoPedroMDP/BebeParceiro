<?php
declare(strict_types=1);

namespace App\Domains\Token\Exceptions;

use Exception;

/**
 * Class TokenNotFound
 * @package App\Domains\Token\Exceptions
 */
class TokenNotFound extends Exception
{
	public function __construct()
	{
		parent::__construct("Token inexistente");
	}
}