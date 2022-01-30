<?php
declare(strict_types=1);

namespace App\Domains\User\Exceptions;

use App\Domains\Core\BenignException;
use Exception;

/**
 * Class NotABenefited
 * @package App\Domains\User\Exceptions
 */
class NotABenefited extends BenignException
{

	public function __construct()
	{
		parent::__construct("Este usuário não é um beneficiado", 400);
	}
}