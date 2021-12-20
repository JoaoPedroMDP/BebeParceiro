<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'username', 'password'
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
}
