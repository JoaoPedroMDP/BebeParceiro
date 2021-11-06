<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Seeder;

/**
 * Class VolunteerSeeder
 * @package Database\Seeders
 */
class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
				if(Volunteer::count() == 0){
						$users = User::all()->slice(0,6);
						$roles = Role::all();
						$volunteers = Volunteer::factory()->count(6)->make();

						$this->attachVolunteersToUsersAndRoles($volunteers, $users, $roles);
				}
    }

		/**
		 * @param DatabaseCollection $volunteers
		 * @param DatabaseCollection $users
		 * @param DatabaseCollection $roles
		 */
		private function attachVolunteersToUsersAndRoles(DatabaseCollection $volunteers, DatabaseCollection $users, DatabaseCollection $roles)
		{
				for( $i = 0; $i < count($volunteers); $i++){
						$volunteers[$i]->user()->associate($users[$i]);
						$volunteers[$i]->role()->associate($roles[$i]);
						$volunteers[$i]->save();
				}
		}
}
