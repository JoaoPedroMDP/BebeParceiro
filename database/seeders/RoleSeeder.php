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

		// Admin
		"Admin" => [
			'Children', 'Contact', 'Edit responses', 'General', 'Localization', 'Sensitive', 'Generate tokens'
		],

		// Realiza o primeiro atendimento
		"Atendente" => [
			'General', 'Contact', 'Children'
		],

		// Pessoa que será agraciada pelo projeto
		"Beneficiada" => [
			'General', 'Contact', 'Children'
		],

		"Doula" => [
			'General', 'Contact', 'Children'
		],

		// Pessoa que marca quaisquer outros atendimentos
		"Secretario" => [
			'General', 'Contact'
		],

		// Pessoa que marca o atendimento inicial, a qual invariavelmente entrará em contato com dados sensíveis
		"Secretario inicial" => [
			'General', 'Contact', 'Sensitive', 'Generate tokens'
		],

		// Responsável por marcar OU montar as trocas/kits
		"Trocas" => [
			'Children'
		],

		// Valida os novos preenchimentos de formulário
		"Validador" => [
			'Edit responses'
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
		    foreach(self::ROLES as $roleName => $permissions) {
			    $newRole = Role::create(
					['name' => $roleName]
			    );
				$newRole->syncPermissions($permissions);
		    }
	    }
    }
}
