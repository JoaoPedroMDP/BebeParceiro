<?php
declare(strict_types=1);

namespace App\Domains\Benefited\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;

/**
 * Class IndexNewBeneficiariesQuery
 * @package App\Domains\Benefited\CQRS
 */
class IndexNewBeneficiariesQuery extends CommandQuery
{
	use Validates;
	const FIELDS = [
		'page' => [
			'rules' => ['nullable', 'string']
		]
	];

	/**
	 * @var int
	 */
	public $page;

	/**
	 * @param int $page
	 */
	public function __construct(int $page)
	{
		$this->page = $page;
	}

	/**
	 * @param array $data
	 * @return IndexNewBeneficiariesQuery
	 */
	public static function fromArray(array $data): IndexNewBeneficiariesQuery
	{
		self::validate($data, self::FIELDS);
		$data['page'] = intval($data['page']);

		return new self($data['page']);
	}
}