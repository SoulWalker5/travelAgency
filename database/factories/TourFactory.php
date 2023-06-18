<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_id' => Travel::factory()->create()->id,
            'name' => fake()->word(),
            'startingDate' => fake()->dateTime(),
            'endingDate' => fake()->dateTime(),
            'price' => fake()->numberBetween(100, 2000) * 100,
        ];
    }
}
