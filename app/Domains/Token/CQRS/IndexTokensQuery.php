<?php
declare(strict_types=1);

namespace App\Domains\Token\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;

/**
 * Class IndexTokensQuery
 * @package App\Domains\Token\CQRS
 */
class IndexTokensQuery extends CommandQuery
{
	use Validates;

	/**
	 * @var bool
	 */
	public $showAll;

	/**
	 * @param bool $showAll
	 * @param array $fields
	 */
	public function __construct(bool $showAll, array $fields)
	{
		$this->showAll = $showAll;
		$this->fields = $fields;
	}

	/**
	 * @param array $data
	 * @return IndexTokensQuery
	 */
	public static function fromArray(array $data): IndexTokensQuery
	{
		$fields = ["showAll"];
		self::keysExists($data, $fields);

		return new self(
			boolval($data['showAll']),
			$fields
		);
	}
}