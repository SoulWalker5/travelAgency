<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Travel::get()->each(function (Travel $travel) {
            Tour::factory(rand(1, 5))->create(['travel_id' => $travel->id]);
        });
    }
}
