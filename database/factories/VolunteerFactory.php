<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class VolunteerFactory
 * @package Database\Factories
 */
class VolunteerFactory extends Factory
{
		const ROLES = [
				'admin', 'atendente', 'beneficiada', 'doula', 'entregador', 'validador', 'agendador'
		];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
		{
        return [
            "role" => $this->faker->randomElement(self::ROLES)
        ];
    }
}
