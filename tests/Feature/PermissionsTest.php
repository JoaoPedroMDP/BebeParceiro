<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Tests\Tools;

/**
 * Class PermissionsTest
 * @package Tests\Feature
 */
class PermissionsTest extends Tools
{
	/**
	 * O seeder cria um usuário por role, colocando a role como nome
	 * Por isso, posso pegar a lista de roles e pesquisa por um usuário
	 * para cada role dentro dessa lista
	 * @return void
	 */
	public function test_roles_and_permissions()
	{
		$roles = RoleSeeder::ROLES;

		foreach($roles as $role)
		{
			$name = $role['name'];
			$user = User::where("name", '=', $name)->first();
			$this->assertTrue(
				$user->hasRole($name),
				"User $name isn't $name"
			);

			foreach($role['permissions'] as $perm){
				$this->assertTrue(
					$user->can($perm),
					"User $name can't $perm"
				);
			}
		}
	}
}