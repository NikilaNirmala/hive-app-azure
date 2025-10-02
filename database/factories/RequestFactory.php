<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         // sender: member, receiver: agent
        $sender  = User::factory()->create(['user_type' => 'member']);

        return [
            'title' => $this->faker->sentence(6),
            'message' => $this->faker->paragraph(3),
            'contact_email' => $this->faker->safeEmail(),

            'sender_id' => $sender->id,
        ];
    }
}
