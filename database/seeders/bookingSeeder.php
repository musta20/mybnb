<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
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
        $user = User::where('email', 'admin@admin.com')->first();

        $listingAdmin = Listing::where('host_id', $user->id)->get();
        
        Booking::factory(10)
            ->sequence(function ($sequence) use ($listingAdmin) {

                return [
                    'listing_id' => $listingAdmin->random()->id
                ];
            })
            ->create();

        Booking::factory(10)
            ->sequence(function ($sequence) use ($listing) {

                return [
                    'listing_id' => $listing->random()->id
                ];
            })
            ->create();
    }
}
