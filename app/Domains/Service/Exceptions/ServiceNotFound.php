<?php
declare(strict_types=1);

namespace App\Domains\Service\Exceptions;

use Exception;

/**
 * Class ServiceNotFound
 * @package App\Domains\Service\Exceptions
 */
class ServiceNotFound extends Exception
{
	public function __construct()
	{
		parent::__construct("Serviço não encontrado");
	}
}