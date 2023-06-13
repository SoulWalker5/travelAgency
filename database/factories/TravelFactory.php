<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->unique()->word(),
            'description' => fake()->sentence(),
            'numberOfDays' => $number = fake()->numberBetween(1, 20),
            'numberOfNights' => $number - 1,
            'isPublic' => fake()->boolean(),
        ];
    }
}
