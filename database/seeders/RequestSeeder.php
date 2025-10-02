<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::where('user_type','member')->get();
        $agents  = User::where('user_type','agent')->get();

        if ($members->isEmpty() || $agents->isEmpty()) return;

        foreach ($members as $m) {
            // each member sends 1–3 requests to random agents
            for ($i=0; $i<rand(1,3); $i++) {
                $agent = $agents->random();
                Request::factory()->create([
                    'sender_id' => $m->id,
                    'receiver_id' => $agent->id,
                    'contact_email' => $m->email,
                ]);
            }
        }
    }
}
