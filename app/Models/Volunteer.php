<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Volunteer
 * @package App\Models
 */
class Volunteer extends Model
{
    use HasFactory;

		protected $fillable = ["role"];
		protected $with = ["user"];

		/**
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
		 * @return string
		 */
		public function getRole(): string
		{
				return $this->role;
		}

		/**
		 * @param string $role
		 */
		public function setRole(string $role)
		{
				$this->role = $role;
		}
}
