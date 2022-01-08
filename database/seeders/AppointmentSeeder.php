<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Database\Seeder;

/**
 * Class AppointmentSeeder
 * @package Database\Seeders
 */
class AppointmentSeeder extends Seeder
{
	const CHUNK_SIZE = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		if(Appointment::count() == 0){
			$appointments = Appointment::factory()->count(5)->make();
			$users = User::all()->chunk(self::CHUNK_SIZE)[0];
			$services = Service::all()->chunk(self::CHUNK_SIZE)[0];

			$this->attachServiceAppointment($appointments, $services);
			$this->attachUserAppointment($appointments, $users);
		}
    }

	/**
	 * @param DatabaseCollection $appointments
	 * @param DatabaseCollection $services
	 * @return void
	 */
	private function attachServiceAppointment(DatabaseCollection $appointments, DatabaseCollection $services){
		// Podem haver mais agendamentos do que serviços, por isso o 'j'
		for($i = 0, $j = 0; $i < count($appointments); $i++, $j++){
			if(count($services) <= $j){
				$j = 0;
			}

			$appointments[$i]->service()->associate($services[$j]);
			$appointments[$i]->save();
		}
	}

	/**
	 * @param DatabaseCollection $appointments
	 * @param DatabaseCollection $users
	 */
	private function attachUserAppointment(DatabaseCollection $appointments, DatabaseCollection $users)
	{
		// Podem haver mais agendamentos do que usuários, por isso o 'j'
		for($i = 0, $j = 0; $i < count($appointments); $i++, $j++){
			if(count($users) <= $j){
				$j = 0;
			}

			$appointments[$i]->users()->attach($users[$j]);
		}
	}
}
