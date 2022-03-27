<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

/**
 * Class Child
 * @package App\Models
 * @mixin Builder
 */
class Child extends Model
{
    use HasFactory;

	protected $fillable = [
		'name', 'sex', 'birthday', 'weight'
	];

	/**
	 * @return HasOne
	 */
	public function pregnancy(): HasOne
	{
		return $this->hasOne(Pregnancy::class);
	}

	/**
	 * @return Pregnancy|null
	 */
	public function getPregnancy(): ?Pregnancy
	{
		return $this->pregnancy()->first();
	}

	/**
	 * @return bool
	 */
	public function isPregnancy(): bool
	{
		return !is_null($this->getPregnancy());
	}

	/**
	 * @return BelongsTo
	 */
	public function benefited(): BelongsTo
	{
		return $this->belongsTo(Benefited::class);
	}

	/**
	 * @return Benefited
	 */
	public function getBeneficiary(): Benefited
	{
		return $this->benefited()->first();
	}

	/**
	 * @return HasMany
	 */
	public function measures(): HasMany
	{
		return $this->hasMany(Measure::class);
	}

	/**
	 * Esse é collection pq a criança pode ter mais de uma medida, como calça, sapatinho, body, essas coisas
	 * @return Collection
	 */
	public function getMeasures(): Collection
	{
		return $this->measures()->get();
	}
}
