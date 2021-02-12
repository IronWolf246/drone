<?php

namespace Database\Factories;

use App\Models\Drone;
use Illuminate\Database\Eloquent\Factories\Factory;

class DroneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => 'https://robohash.org/'.$this->faker->word.'.jpg',
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            "battery" => $this->faker->numberBetween($min = 0, $max = 100),
            "max_speed" => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 20),
            "average_speed" => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 15),
            "status" => $this->faker->boolean,
        ];
    }
}
