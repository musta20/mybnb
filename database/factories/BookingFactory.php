<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Enums\HostType;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkInDate = fake()->dateTimeBetween('-1 month', '+1 month');
        $checkOutDate = fake()->dateTimeBetween($checkInDate, $checkInDate->format('Y-m-d H:i:s') . ' + 5 days');

        return [
            'listing_id' => Listing::factory(),
            'guest_id' => User::factory()->create([
                'type' => HostType::GUEST->value,
            ]),
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => fake()->randomFloat(2, 50, 500),
            'status' => fake()->randomElement(BookingStatus::cases())->value,
            'special_requests' => fake()->paragraph(),
        ];
    }
}
