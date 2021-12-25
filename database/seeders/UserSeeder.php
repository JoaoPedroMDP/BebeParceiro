<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach(RoleSeeder::ROLES as $roleName => $permissions){
			if(!$this->alreadyCreated('name', $roleName)){
				$newUser = new User;
				$newUser->name = $roleName;
				$newUser->surname = "da Silva";
				$newUser->username = $this->trimRoleName($roleName) . "@email";
				$newUser->password = bcrypt("secret");
				$newUser->save();
				$newUser->assignRole($roleName);
			}
		}
    }

	/**
	 * @param string $field
	 * @param $value
	 * @return bool
	 */
	private function alreadyCreated(string $field, $value): bool
	{
		return !is_null(
			User::where($field,"=",$value)->first()
		);
	}

	/**
	 * @param string $roleName
	 * @return string
	 */
	private function trimRoleName(string $roleName): string
	{
		$roleName = strtolower($roleName);
		return str_replace(' ', '_', $roleName);
	}
}
