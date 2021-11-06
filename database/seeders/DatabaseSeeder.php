<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
				(new UserSeeder())->run();
				(new RoleSeeder())->run();
        (new VolunteerSeeder())->run();
				(new AppointmentSeeder())->run();
    }
}
