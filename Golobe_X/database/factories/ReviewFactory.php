<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' =>rand(1,10),
            'user_id' =>rand(1,10),
            'comment' =>$this->faker->text(50),
            'rate' => $this->faker->numberBetween($min = 0, $max = 5),
        ];
    }
}
