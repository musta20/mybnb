<?php

namespace Database\Factories;

use App\Enums\HostType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            'type' => fake()->randomElement(HostType::cases())->value,
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'profile_picture' => fake()->imageUrl(),
            'about_me' => fake()->paragraph(), // For hosts
            'languages' => fake()->randomElement(['English, arabic', 'French, Italian']), // For hosts
            'response_time' => fake()->randomElement(['within an hour', 'within a day']), // For hosts
            'response_rate' => fake()->numberBetween(80, 100), // For hosts
            'remember_token' => Str::random(10),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
