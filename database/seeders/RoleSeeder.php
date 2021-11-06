<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Self_;

/**
 * Class RoleSeeder
 * @package Database\Seeders
 */
class RoleSeeder extends Seeder
{
		const ROLES = [
				'Administrator', 'Clerk', 'Doula', 'Deliverer', 'Validator', 'Scheduler'
		];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
				if(Role::count() == 0)
        $roles = Role::factory()->count(
						count(self::ROLES)
				)->make();

				for( $i = 0; $i < count($roles); $i++)
				{
						$roles[$i]->setName(self::ROLES[$i]);
						$roles[$i]->save();
				}
    }
}
