<?php
declare(strict_types=1);

namespace App\Domains\Token\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class TokenNotFound
 * @package App\Domains\Token\Exceptions
 */
class TokenNotFound extends BenignException
{
	public function __construct()
	{
		parent::__construct("Token inexistente", 404);
	}
}