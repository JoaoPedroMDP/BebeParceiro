<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ServiceFactory
 * @package Database\Factories
 */
class ServiceFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'name' => $this->faker->hexColor(),
			'description' => $this->faker->sentence,
			'enabled' => true
		];
	}
}