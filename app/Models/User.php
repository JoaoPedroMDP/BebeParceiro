<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\User\Exceptions\NotABenefited;
use App\Domains\User\Exceptions\NotAVolunteer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Models
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles;

	protected $hidden =[
			'password',
			'pivot',
			'remember_token',
			'created_at',
			'updated_at'
		];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'surname',
        'login'
    ];

	/**
	 * @return BelongsToMany
	 */
	public function appointments(): BelongsToMany
	{
		return $this->belongsToMany(Appointment::class);
	}

	/**
	 * @return Collection
	 */
	public function getAppointments(): Collection
	{
		return $this->appointments()->without('users')->get();
	}

	// VOLUNTEER
	/**
	 * @return HasOne
	 */
	public function volunteer(): HasOne
	{
		return $this->hasOne(Volunteer::class);
	}

	/**
	 * @return Volunteer
	 * @throws NotAVolunteer
	 * @noinspection PhpIncompatibleReturnTypeInspection    Vai retornar voluntário sempre
	 */
	public function getVolunteer(): Volunteer
	{
		if( is_null($this->volunteer()->first()) ){
			throw new NotAVolunteer();
		}

		return $this->volunteer()->first();
	}

	/**
	 * @return bool
	 */
	public function isVolunteer(): bool
	{
		try{
			$this->getVolunteer();
		}catch(NotAVolunteer $e){
			return false;
		}

		return true;
	}

	// BENEFITED
	/**
	 * @return HasOne
	 */
	public function benefited(): HasOne
	{
		return $this->hasOne(Benefited::class);
	}

	/**
	 * @return Benefited|null
	 * @noinspection PhpIncompatibleReturnTypeInspection Mesma coisa dali de cima
	 * @throws NotABenefited
	 */
	public function getBenefited(): ?Benefited
	{
		if( is_null($this->benefited()->first()) ){
			throw new NotABenefited();
		}
		return $this->benefited()->first();
	}

	/**
	 * @return bool
	 */
	public function isBenefited(): bool
	{
		return $this->hasRole(['Benefited']);
	}
}
