<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Token
 * @package App\Models
 */
class Token extends Model
{
    use HasFactory;

	protected $fillable = [
		'token'
	];

	/**
	 * @return BelongsTo
	 */
	public function volunteer(): BelongsTo
	{
		return $this->belongsTo(Volunteer::class);
	}

	/**
	 * @return Volunteer|null
	 */
	public function getVolunteer(): ?Volunteer
	{
		return $this->volunteer()->first();
	}

	/**
	 * @return BelongsTo
	 */
	public function benefited(): BelongsTo
	{
		return $this->belongsTo(Benefited::class);
	}

	/**
	 * @return Benefited|null
	 */
	public function getBenefited(): ?Benefited
	{
		return $this->benefited()->first();
	}

	/**
	 * @return void
	 */
	public function useToken(){
		$this->used = true;
	}

	/**
	 * @return bool
	 */
	public function isUsed(): bool
	{
		$this->touch();
		return $this->used;
	}
}
