<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Admins
        User::factory()->create([
            'user_type' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'admin',
            'full_name' => 'System Admin',
            'status' => true,
        ]);
        User::factory(2)->create(['user_type' => 'admin']);

        // Agents
        User::factory(3)->create(['user_type' => 'agent']);

        // Members
        User::factory(10)->create(['user_type' => 'member']);
    }
}
