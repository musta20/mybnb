<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Reviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class reviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listings = Listing::all();
        Reviews::factory()
        ->count(20)
        ->sequence(function ($sequence) use ($listings) {

            return [
                'listing_id' => $listings->random()->id
            ];
        })
        ->create(); // Create 20 reviews

    }
}
