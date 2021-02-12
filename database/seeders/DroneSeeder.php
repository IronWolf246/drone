<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drone;
use Illuminate\Support\Facades\DB;

class DroneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drone::create([        
        //     "image" => "https://robohash.org/verovoluptatequia.jpg",
        //     "name" => "Suzanne",
        //     "address" => "955 Springview Junction",
        //     "battery" => 80,
        //     "max_speed" => 3.8,
        //     "average_speed" => 11.6,
        //     "status" => 1
        // ]);
        Drone::factory()
        ->count(50)
        ->create();
    }
}
