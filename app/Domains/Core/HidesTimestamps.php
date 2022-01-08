<?php
declare(strict_types=1);

namespace App\Domains\Core;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HidesTimestamps
 * @package App\Domains\Core
 */
class HidesTimestamps extends Model
{
	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param array $toHide
	 */
	public function __construct(array $toHide = [])
	{
		$this->hidden = array_merge(
			$toHide, [
			"created_at", "updated_at"
		]);
		parent::__construct();
	}
}