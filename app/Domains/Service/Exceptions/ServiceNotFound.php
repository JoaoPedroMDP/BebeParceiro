<?php
declare(strict_types=1);

namespace App\Domains\Service\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class ServiceNotFound
 * @package App\Domains\Service\Exceptions
 */
class ServiceNotFound extends BenignException
{
	public function __construct()
	{
		parent::__construct("Serviço não encontrado", 404);
	}
}