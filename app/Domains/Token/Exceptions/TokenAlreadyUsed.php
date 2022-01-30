<?php
declare(strict_types=1);

namespace App\Domains\Token\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class TokenAlreadyUsed
 * @package App\Domains\Token\Exceptions
 */
class TokenAlreadyUsed extends BenignException
{
	public function __construct()
	{
		parent::__construct("Este token já foi usado", 400);
	}
}