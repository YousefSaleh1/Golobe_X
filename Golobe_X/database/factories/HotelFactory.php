<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'rate' => $this->faker->numberBetween($min = 0, $max = 5),
            'priceForNight'=>rand(1000,100000),
            'city' =>$this->faker->text(20),
            'address'=>$this->faker->address(),
            'image' =>$this->faker->imageUrl(640,480),
            'freebies'=>$this->faker->randomElement(['free breakfast','free parking','free internet','free airport shuttle', 'free cancellation']),
            'amenities'=>$this->faker->randomElement(['24hr front desk','air-conditioned','fitness','pool', 'outdoor pool','indoor pool','restaurant','room service','fitness center','free wifi']),
            'overview'=>$this->faker->text(100),
        ];
    }
}
