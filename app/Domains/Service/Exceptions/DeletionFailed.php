<?php
declare(strict_types=1);

namespace App\Domains\Service\Exceptions;

use App\Domains\Core\BenignException;

/**
 * Class DeletionFailed
 * @package App\Domains\Service\Exceptions
 */
class DeletionFailed extends BenignException
{
	public function __construct()
	{
		parent::__construct("Não foi possível remover este item", 400);
	}
}