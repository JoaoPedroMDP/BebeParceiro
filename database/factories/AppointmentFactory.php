<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * Class AppointmentFactory
 * @package Database\Factories
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
		{
				$datetime = Carbon::now();
				$datetime->addWeeks(rand(1, 10))->addHours(rand(1, 24));
        return [
            'name' => $this->faker->hexColor(),
						'datetime' => $datetime->toDateTime()
        ];
    }
}
