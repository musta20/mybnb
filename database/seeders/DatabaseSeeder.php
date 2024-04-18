<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            userSeeder::class,
            listingSeeder::class,
            bookingSeeder::class,
            messagesSeeder::class,
            reviewsSeeder::class,
            listingImageSeeder::class
        ]);



    }
}
