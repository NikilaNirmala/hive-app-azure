<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['house', 'apartment', 'land', 'commercial', 'villa', 'room'];

        return [
            'user_id'       => User::factory()->state(['user_type' => 'member']),
            'title'         => $this->faker->streetName().' '.$this->faker->randomElement(['House','Apartment','Listing']),
            'city'          => $this->faker->city(),
            'country'       => $this->faker->country(),
            'description'   => $this->faker->paragraph(),
            'no_rooms'      => $this->faker->numberBetween(0, 8),
            'property_size' => $this->faker->numberBetween(250, 4000),
            'price'         => $this->faker->randomFloat(2, 50000, 1500000),
            'property_type' => $this->faker->randomElement($types),
            'image_path' => 'product.jpg',

            // not evaluated by default
            'admin_id' => null,

        ];
    }
    public function approved(): static
    {
        return $this->state(function () {
            $admin = User::factory()->create(['user_type' => 'admin']);
            return [
                'admin_id' => $admin->id,
            ];
        });
    }
}
