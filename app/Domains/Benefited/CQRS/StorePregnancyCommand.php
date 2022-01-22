<?php
declare(strict_types=1);

namespace App\Domains\Benefited\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use App\Models\Benefited;
use App\Models\Child;
use Webmozart\Assert\Assert;

/**
 * Class StorePregnancyCommand
 * @package App\Domains\Benefited\CQRS
 */
class StorePregnancyCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'riskyPregnancy' => [
			'rules' => ['required', 'boolean']
		],
		'child' => [
			'rules' => ['required']
		]
	];

	/**
	 * @var bool
	 */
	public $riskyPregnancy;

	/**
	 * @var Child
	 */
	public $child;

	/**
	 * @param bool $riskyPregnancy
	 * @param Child $child
	 */
	public function __construct(bool $riskyPregnancy, Child $child)
	{
		$this->riskyPregnancy = $riskyPregnancy;
		$this->child = $child;
	}

	/**
	 * @param array $data
	 * @return StorePregnancyCommand
	 */
	public static function fromArray(array $data): StorePregnancyCommand
	{
		$data['riskyPregnancy'] = !($data['riskyPregnancy'] == 'false');
		self::validate($data, self::FIELDS);
		Assert::isInstanceOf($data['child'], Child::class, "Erro ao recuperar a criança relacionada");

		return new self(
			$data['riskyPregnancy'],
			$data['child']
		);
	}
}