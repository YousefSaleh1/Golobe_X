<?php

namespace Database\Seeders;
use App\Models\{Company, Flight, User,Hotel,Room,Review};
use App\Models\FlightDetails;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory(10)->create();
        // Hotel::factory(10)->create();
        // Review::factory(10)->create();
        // Room::factory(10)->create();
        // Company::factory(5)->create();
        // Flight::factory(5)->create();
        FlightDetails::factory(5)->create();
    }
}
