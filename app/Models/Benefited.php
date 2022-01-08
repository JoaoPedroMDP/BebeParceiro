<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Benefited
 * @package App\Models
 */
class Benefited extends Model
{
    use HasFactory;

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
