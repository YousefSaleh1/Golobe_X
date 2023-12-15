<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fromTo' =>$this->faker->text(30),
            'tripType' =>$this->faker->text(30),
            'dapartReturn' =>$this->faker->text(30),
            'passengerClass' =>$this->faker->text(30),
            'price' =>rand(1000,100000),
            'rate' =>rand(1,5),
            'company_id'=>rand(1,10),
        ];
    }
}
