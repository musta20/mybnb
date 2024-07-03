<?php

namespace Database\Factories;

use App\Enums\Amenities;
use App\Enums\Cities;
use App\Enums\HostType;
use App\Enums\Status;
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
        $city = fake()->randomElement(Cities::cases())->value;
        $getPosition = Cities::getByString($city)->getPosition();
        $newpostion = $this->getRandomPosition($getPosition['lat'], $getPosition['lng'], 5);

        return [
            'title' => fake()->randomElement(['فيلا', 'بيت', 'شقة', 'عمارة']) . ' ' . __('messages.' . $city),
            'description' => fake()->paragraph(),
            'address' => fake()->streetAddress(),
            'city' => $city,
            'latitude' => $newpostion['latitude'],
            'longitude' => $newpostion['longitude'],
            'status' => fake()->randomElement(Status::cases())->value,
            'number_of_guests' => fake()->numberBetween(1, 10),
            'number_of_bedrooms' => fake()->numberBetween(1, 5),
            'number_of_bathrooms' => fake()->numberBetween(1, 4),
            'amenities' => json_encode(fake()->randomElements(Amenities::cases(), 5, false)),
            'price_per_night' => fake()->randomFloat(2, 50, 500),
            'host_id' => User::factory()->create([
                'type' => HostType::HOST->value,
            ]),
        ];

    }

    public function getRandomPosition($latitude, $longitude, $radiusKm = 10)
    {
        // Earth's radius in kilometers
        $earthRadius = 6371;

        // Convert radius from kilometers to radians
        $radiusRadians = $radiusKm / $earthRadius;

        // Generate random angle in radians
        $randomAngle = mt_rand() / mt_getrandmax() * 2 * M_PI;

        // Generate random distance within the radius
        $randomDistance = mt_rand() / mt_getrandmax() * $radiusRadians;

        // Convert latitude and longitude to radians
        $latRad = deg2rad($latitude);
        $lonRad = deg2rad($longitude);

        // Calculate new latitude
        $newLatRad = asin(sin($latRad) * cos($randomDistance) +
                          cos($latRad) * sin($randomDistance) * cos($randomAngle));

        // Calculate new longitude
        $newLonRad = $lonRad + atan2(sin($randomAngle) * sin($randomDistance) * cos($latRad),
            cos($randomDistance) - sin($latRad) * sin($newLatRad));

        // Convert new latitude and longitude back to degrees
        $newLatitude = rad2deg($newLatRad);
        $newLongitude = rad2deg($newLonRad);

        return [
            'latitude' => $newLatitude,
            'longitude' => $newLongitude,
        ];
    }

    public function withHost(User $user)
    {

        return $this->state(function (array $attributes) use ($user) {
            return [
                'host_id' => $user->id,
            ];
        });
    }
}
