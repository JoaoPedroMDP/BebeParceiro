<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Pregnancy
 * @package App\Models
 * @mixin Builder
 */
class Pregnancy extends Model
{
    use HasFactory;

	protected $fillable = [
		'risky_pregnancy'
	];

	/**
	 * @return BelongsTo
	 */
	public function child(): BelongsTo
	{
		return $this->belongsTo(Child::class);
	}

	/**
	 * @return Child
	 */
	public function getChild(): Child
	{
		return $this->child()->first();
	}

}
