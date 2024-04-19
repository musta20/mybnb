<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ListingMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class listingMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listings = Listing::all();

        $images = array_map('basename', glob(storage_path('images') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE));


        foreach ($listings as $listing) {

            ListingMedia::factory()
                ->for($listing)
                ->count(3)
                ->sequence(function ($sequence) use ($images) {

                    return [
                        'path' => $this->copyImage($images)
                    ];
                })->create();
        }
    }

    public function copyImage($images): string
    {

        $image = $images[array_rand($images)];

        $imagePath = storage_path("images/{$image}");


        $ext = pathinfo($imagePath, PATHINFO_EXTENSION);

        $name = \Illuminate\Support\Str::uuid()->toString() . '.' . $ext;

        Storage::disk('listings')->put($name, file_get_contents($imagePath));

        return  $name;
    }
}
