<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Query\Builder;

/**
 * Class Service
 * @package App\Models
 * @mixin Builder
 */
class Service extends Model
{
    use HasFactory;

	protected $fillable = [
		'name', 'description', 'enabled'
	];

	protected $with = [
		'image'
	];

	/**
	 * @return MorphOne
	 */
	public function image(): MorphOne
	{
		return $this->morphOne(Image::class, 'imageable');
	}

	/**
	 * @return Image|null
	 */
	public function getImage(): ?Image
	{
		return $this->image()->first();
	}

	/**
	 * Não criei o get desse lado do relacionamento pois não seria usado para nada (acho)
	 * @return HasMany
	 */
	public function appointments(): HasMany
	{
		return $this->hasMany(Appointment::class);
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name){
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description){
		$this->description = $description;
	}

	/**
	 * @return bool
	 */
	public function isEnabled(): bool {
		return $this->enabled;
	}

	/**
	 * @param bool $enabled
	 */
	public function setEnabled(bool $enabled){
		$this->enabled = $enabled;
	}
}
