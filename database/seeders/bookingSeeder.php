<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class bookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listing = Listing::all();
        Booking::factory(10)
            ->sequence(function ($sequence) use ($listing) {

                return [
                    'listing_id' => $listing->random()->id
                ];
            })
            ->create();
    }
}
