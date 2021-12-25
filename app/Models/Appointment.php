<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

/**
 * Class Appointment
 * @package App\Models
 * @mixin Builder
 */
class Appointment extends Model
{
    use HasFactory;

	protected $fillable = [ 'name', 'datetime' ];

	protected $with = [ 'users' ];

	/**
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class);
	}

	/**
	 * @return DatabaseCollection
	 */
	public function getUsers(): DatabaseCollection
	{
		return $this->users()->get();
	}

	/**
	 * @return BelongsTo
	 */
	public function service(): BelongsTo
	{
		return $this->belongsTo(Service::class);
	}

	/**
	 * @return DatabaseCollection
	 */
	public function getService(): DatabaseCollection
	{
		return $this->service()->get();
	}
}
