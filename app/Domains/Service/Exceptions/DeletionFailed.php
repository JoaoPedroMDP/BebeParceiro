<?php
declare(strict_types=1);

namespace App\Domains\Service\Exceptions;

use Exception;

/**
 * Class DeletionFailed
 * @package App\Domains\Service\Exceptions
 */
class DeletionFailed extends Exception
{
	public function __construct()
	{
		parent::__construct("Não foi possível remover este item", 500);
	}
}