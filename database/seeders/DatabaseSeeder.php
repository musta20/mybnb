<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ListingSeeder::class,
            BookingSeeder::class,
            MessagesSeeder::class,
            ReviewsSeeder::class,
            ListingMediaSeeder::class,
        ]);

    }
}
