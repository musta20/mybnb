<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\Status;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listing = Listing::where('status', Status::PUBLISHED->value)->get();

        $user = User::where('email', 'admin@admin.com')->first();
        $samah = User::where('email', 'samah@samah.com')->first();
        $ALI = User::where('email', 'ALI@ALI.com')->first();

        $listingAdmin = Listing::where('status', Status::PUBLISHED->value)->where('host_id', $user->id)->get();

        Booking::factory()
            ->sequence(function ($sequence) use ($listingAdmin, $samah) {
                return [
                    'listing_id' => $listingAdmin->random()->id,
                    'guest_id' => $samah->id,
                    'status' => BookingStatus::PENDING->value,
                ];
            })
            ->count(5)
            ->create();

        Booking::factory()
            ->sequence(function ($sequence) use ($listingAdmin, $ALI) {
                return [
                    'listing_id' => $listingAdmin->random()->id,
                    'guest_id' => $ALI->id,
                    'status' => BookingStatus::PENDING->value,
                ];
            })
            ->count(5)
            ->create();

        Booking::factory()
            ->sequence(function ($sequence) use ($listing) {

                return [
                    'listing_id' => $listing->random()->id,
                ];
            })
            ->count(5)

            ->create();
    }
}
