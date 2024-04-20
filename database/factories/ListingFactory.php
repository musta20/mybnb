<?php

namespace Database\Factories;

use App\Enums\Amenities;
use App\Enums\Cities;
use App\Enums\HostType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>fake()->randomElement(["فيلا","بيت","شقة","عمارة"])." " . __("messages.".fake()->randomElement(Cities::cases())->value) ,
            'description' => fake()->paragraph(),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(Cities::cases())->value,
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'number_of_guests' => fake()->numberBetween(1, 10),
            'number_of_bedrooms' => fake()->numberBetween(1, 5),
            'number_of_bathrooms' => fake()->numberBetween(1, 4),
            'amenities' => json_encode(fake()->randomElements(Amenities::cases(), 3, false)),
            'price_per_night' => fake()->randomFloat(2, 50, 500),
            'host_id' => User::factory()->create([
                'type' => HostType::HOST->value,
            ]),
        ];
    }
}
