<?php
declare(strict_types=1);

namespace App\Domains\Token\Exceptions;

use Exception;

/**
 * Class TokenAlreadyUsed
 * @package App\Domains\Token\Exceptions
 */
class TokenAlreadyUsed extends Exception
{
	public function __construct()
	{
		parent::__construct("Este token já foi usado");
	}
}