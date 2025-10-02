<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // some pending (not approved)
        Advertisement::factory(15)->create();

        // some approved by admins
        // pick an existing admin to evaluate
        $admin = User::where('user_type','admin')->inRandomOrder()->first();
        Advertisement::factory(10)->create([
            'admin_id' => $admin?->id,
        ]);
    }
}
