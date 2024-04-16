<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Messages>
 */
class MessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::all()->pluck('id')->toArray(); // Get all user IDs

        do {
            $senderId = fake()->randomElement($users);
            $recipientId = fake()->randomElement($users);
        } while ($senderId === $recipientId); // Ensure sender and recipient are different

        return [
            'sender_id' => $senderId,
            'recipient_id' => $recipientId,
            'content' => fake()->sentence(),
            'is_read' => fake()->boolean(),
        ];
    }
}
