<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Volunteer
 * @package App\Models
 * @mixin Builder
 */
class Volunteer extends Model
{
    use HasFactory;

		protected $fillable = ["role_id"];
		protected $with = ["user", "role"];

		/** REL
		 * @return BelongsTo
		 */
		public function user(): BelongsTo
		{
				return $this->belongsTo(User::class);
		}

		/** REL
		 * @return BelongsTo
		 */
		public function role(): BelongsTo
		{
				return $this->belongsTo(Role::class);
		}

		/**
		 * @return DatabaseCollection
		 */
		public function getUser(): DatabaseCollection
		{
				return $this->user()->get();
		}

		/**
		 * @return DatabaseCollection
		 */
		public function getRole(): DatabaseCollection
		{
				return $this->role()->get();
		}
}
