<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Role
 * @package App\Models
 * @mixin Builder
 */
class Role extends Model
{
    use HasFactory;

		protected $fillable = [ 'name', 'permissions' ];

		/**
		 * @return string
		 */
		public function getName(): string
		{
				return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function setName(string $name)
		{
				$this->name = $name;
		}

		/**
		 * @return string
		 */
		public function getPermissions(): string
		{
				return $this->permissions;
		}

		/**
		 * @param string $permissions
		 */
		public function setPermissions(string $permissions)
		{
				$this->permissions = $permissions;
		}
}
