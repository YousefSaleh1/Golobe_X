<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlightDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => rand(1, 10),
            'name' => $this->faker->text(30),
            'photo' => $this->faker->imageUrl(640, 480),
            'classSeate' => $this->faker->randomElement(['economy', 'firstClass', 'businessClass']),
            'airplanPolicies' => $this->faker->text(30),
            'destination' => rand(1000, 100000),
            'tripNumber' => rand(1, 10),
            'tripTime' => $this->faker->dateTime(),
        ];
    }
}
