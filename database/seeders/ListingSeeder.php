<?php

namespace Database\Seeders;

use App\Enums\HostType;
use App\Enums\Status;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allusers = User::where('type', HostType::HOST->value)->get();

        foreach ($allusers as $user) {
            Listing::factory()->count(10)->withHost($user)->create();
        }

        $user = User::where('email', 'admin@admin.com')->first();

        Listing::factory()->count(20)->withHost($user)->create([
            'status' => Status::PUBLISHED->value,
        ]);
    }
}
