<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Benefited
 * @package App\Models
 * @mixin Builder
 */
class Benefited extends Model
{
    use HasFactory;

	protected $table = 'beneficiaries';

	protected $fillable = [
		"birthday", "child_count", "is_pregnant",
		"marital_status", "familiar_income", "has_disablement"
	];

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return User|null
	 */
	public function getUser(): ?User
	{
		return $this->user()->first();
	}
}
