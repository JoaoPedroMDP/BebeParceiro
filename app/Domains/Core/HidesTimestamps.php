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
	 * @var array
	 */
	protected $hidden = [
		"created_at", "updated_at"
	];
}