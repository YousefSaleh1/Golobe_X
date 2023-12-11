<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guestNumber' =>$this->faker->numberBetween($min = 1, $max = 7),
            'hotel_id' =>rand(1,10),
            'available' => $this->faker->numberBetween($min = 0, $max = 1),
            'fromDay' =>$this->faker->dateTime(),
            'toDay' =>$this->faker->dateTime(),
            'price'=>rand(1000,100000),
        ];
    }
}
