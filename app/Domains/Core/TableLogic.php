<?php
declare(strict_types=1);

namespace App\Domains\Core;

/**
 * Class TableLogic
 * @package App\Domains\Core
 */
class TableLogic extends LogicsAndRepositories
{
	/**
	 * @param array $tableData
	 * @param int $page
	 * @param int $totalItems
	 * @param int $lastPage
	 * @return array
	 */
	public function generateTable( array $tableData, int $page, int $totalItems, int $lastPage): array
	{
		return [
			'page' => $page,
			'items' => $tableData,
			'totalItems' => $totalItems,
			'lastPage' => $lastPage
		];
	}
}