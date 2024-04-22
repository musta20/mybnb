<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class listingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allusers = User::all();

        foreach ($allusers  as $user) {
            Listing::factory()->count(10)->withHost($user)->create();
        }

        $user = User::where('email', 'admin@admin.com')->first();

        Listing::factory()->count(20)->withHost($user)->create();

    }
}
