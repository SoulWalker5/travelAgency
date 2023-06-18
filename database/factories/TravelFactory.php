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
            'name' => 'My awesome travel',
            'description' => fake()->sentence(),
            'numberOfDays' => fake()->numberBetween(1, 20),
            'isPublic' => fake()->boolean(),
        ];
    }
}
