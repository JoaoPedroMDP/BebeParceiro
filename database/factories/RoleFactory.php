<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class RoleFactory
 * @package Database\Factories
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
		{
        return [
						'name' => $this->faker->city(),
            'permissions' =>
								'{"general": "edit","address": "edit","contact": "edit","children": "edit","number": 123,"sensitive": "edit"}'
        ];
    }
}
