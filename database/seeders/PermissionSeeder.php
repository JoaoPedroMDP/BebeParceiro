<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionSeeder
 * @package Database\Seeders
 */
class PermissionSeeder extends Seeder
{
	const PERMISSIONS = [
		[
			"name" => "Children"
		],
		[
			"name" => "Contact"
		],
		[
			"name" => "Edit responses"
		],
		[
			"name" => "General"
		],
		[
			"name" => "Localization"
		],
		[
			"name" => "Sensitive"
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		if(Permission::all()->count() == 0){
			foreach(self::PERMISSIONS as $perm){
				Permission::create($perm);
			}
		}
    }
}
