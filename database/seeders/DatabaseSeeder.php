<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Request;
use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    $members = User::factory(10)->create(['user_type' => 'member']);
     User::factory(3)->create(['user_type' => 'admin']);

    // Create requests
    Request::factory(20)
        ->recycle($members)  // sender_id will come from members
        ->create();

        Advertisement::factory(20)->recycle($members)->create();

    Review::create([
    'title' => 'Great Service',
    'rating' => 5,
    'comment' => 'I loved the experience, highly recommended!',
    'user_id' => null
]);
    }


}
