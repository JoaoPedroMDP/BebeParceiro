<?php
declare(strict_types=1);

namespace Database\Seeders;

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
			$users = User::factory()->count(5)->create();
			$volunteers = Volunteer::factory()->count(5)->make();

			$this->attachVolunteersToUsers($volunteers, $users);
		}
    }

	/**
	 * @param DatabaseCollection $volunteers
	 * @param DatabaseCollection $users
	 */
	private function attachVolunteersToUsers(DatabaseCollection $volunteers, DatabaseCollection $users)
	{
		for( $i = 0; $i < count($volunteers); $i++){
			$volunteers[$i]->user()->associate($users[$i]);
			$volunteers[$i]->save();
		}
	}
}
