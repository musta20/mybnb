<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ListingMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListingMediaSeeder extends Seeder
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
                ->count(6)
                ->sequence(function ($sequence) use ($images) {
                    $data=$this->copyImage($images);

                    return [
                        'path' => $data['path'],
                        'width' => $data['width'],
                        'height' => $data['height'],
                    ];
                })->create();
        }
    }

    public function copyImage($images): array
    {

        $image = $images[array_rand($images)];

        $imagePath = storage_path("images/{$image}");
        
        list($width, $height) = getimagesize($imagePath);

        $ext = pathinfo($imagePath, PATHINFO_EXTENSION);

        $name = Str::uuid()->toString() . '.' . $ext;

        Storage::disk('listings')->put($name, file_get_contents($imagePath));

        return [
            'path' => $name,
            'width' => $width,
            'height' => $height];
    }
}
