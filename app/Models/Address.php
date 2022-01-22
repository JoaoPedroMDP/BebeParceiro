<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Address
 * @package App\Models
 * @mixin Builder
 */
class Address extends Model
{
    use HasFactory;

	protected $fillable = [
		'street', 'number', 'cep',
		'city', 'complement', 'reference'
	];

	protected $with = ['user'];

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user()->get();
	}
}
