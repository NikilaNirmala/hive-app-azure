<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'  => $this->faker->sentence(3),
            'amount' => $this->faker->randomFloat(2, 10, 10000),
            'type'   => $this->faker->randomElement(['credit','debit']),
            'user_id' => User::factory()->state(['user_type' => 'member']),

        ];
    }
}
