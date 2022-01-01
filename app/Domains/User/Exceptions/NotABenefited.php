<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use Exception;

/**
 * Class NotABenefited
 * @package App\Domains\User\Exceptions
 */
class NotABenefited extends Exception
{

	public function __construct()
	{
		parent::__construct("Este usuário não é um beneficiado");
	}
}