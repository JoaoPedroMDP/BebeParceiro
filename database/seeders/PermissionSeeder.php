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
			"Children" => "Children",
			"Contact" => "Contact",
			"Edit responses" => "Edit responses",
			"General" => "General",
			"Localization" => "Localization",
			"Sensitive" => "Sensitive",
			"Generate tokens" => "Generate tokens",
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
				$permission = [
					"name" => $perm
				];
				Permission::create($permission);
			}
		}
    }
}
