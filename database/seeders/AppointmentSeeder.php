<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Seeder;

/**
 * Class AppointmentSeeder
 * @package Database\Seeders
 */
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
				if(Appointment::count() == 0){
						$appointments = Appointment::factory()->count(5)->create();
						$users = User::all()->chunk(5);

						$this->attachUserAppointment($appointments, $users);
				}
    }

		/**
		 * @param DatabaseCollection $appointments
		 * @param DatabaseCollection $users
		 */
		private function attachUserAppointment(DatabaseCollection $appointments, DatabaseCollection $users)
		{
				for($i = 0; $i < count($users); $i++){
						$appointments[$i]->users()->attach($users[$i]);
						$appointments[$i]->save();
				}

		}
}
