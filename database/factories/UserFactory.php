<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
		{
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt("senha") // password
        ];
    }
}
