<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Class Volunteer
 * @package App\Models
 * @mixin Builder
 */
class Volunteer extends Model
{
	use HasFactory;

	protected $with = ["user"];

	/** REL
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return DatabaseCollection
	 */
	public function getUser(): DatabaseCollection
	{
		return $this->user()->get();
	}

	/**
	 * @return HasMany
	 */
	public function tokens(): HasMany
	{
		return $this->hasMany(Token::class);
	}

	/**
	 * @param bool $showAll
	 * @param array $columns
	 * @return DatabaseCollection|Token[]
	 */
	public function getTokens(bool $showAll, array $columns = ['*']): DatabaseCollection
	{
		return $this->tokens()->where("used", '=', false)->get($columns);
	}
}
