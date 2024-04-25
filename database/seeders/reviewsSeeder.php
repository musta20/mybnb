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
        foreach ($listings as $listing) {
       
            Reviews::factory()
            ->count(20)
            ->for($listing)
            ->create(); 


        }
     

    }
}
