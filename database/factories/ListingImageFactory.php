<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListingImage>
 */
class ListingImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'listing_id' => Listing::factory(),
            'path' => fake()->imageUrl(),
            'alt_text' => fake()->sentence(),

        ];
    }


    public function withImage($image){

        return $this->state(function (array $attributes) use ($image) {
            return [
                'path' => $image,
            ];
        });
    }
}
