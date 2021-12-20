<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class RoleSeeder
 * @package Database\Seeders
 */
class RoleSeeder extends Seeder
{
	const ROLES = [
		[
			"name" => "Admin", // Admin
			"permissions" => [
				'Children', 'Contact', 'Edit responses', 'General', 'Localization', 'Sensitive'
			]
		],
		[
			"name" => "Atendente", // Realiza o primeiro atendimento
			"permissions" => [
				'General', 'Contact', 'Children'
			]
		],
		[
			"name" => "Beneficiada", // Pessoa que será agraciada pelo projeto
			"permissions" => []
		],
		[
			"name" => "Doula", // Presta serviços de Doula
			"permissions" => [
				'General', 'Contact', 'Children'
			]
		],
		[
			"name" => "Secretário", // Pessoa que marca quaisquer outros atendimentos
			"permissions" => [
				'General', 'Contact'
			]
		],
		[
			"name" => "Sensível", // Pessoa que marca o atendimento inicial, a qual invariavelmente entrará em contato com dados sensíveis
			"permissions" => [
				'General', 'Contact', 'Sensitive'
			]
		],
		[
			"name" => "Trocas", // Responsável por marcar OU montar as trocas/kits
			"permissions" => [
				'Children'
			]
		],
		[
			"name" => "Validador", // Valida os novos preenchimentos de formulário
			"permissions" => [
				'Edit responses'
			]
		],

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    if(Role::all()->count() == 0) {
		    foreach(self::ROLES as $role) {
			    $newRole = Role::create(
					['name' => $role['name']]
			    );
				$newRole->syncPermissions($role['permissions']);
		    }
	    }
    }
}
