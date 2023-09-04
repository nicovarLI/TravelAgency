<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin_city_id' => City::factory(),
            'destination_city_id' => City::factory(),
            'airline_id'=> Airline::factory(),
            'departure_at' => fake()->dateTime(),
            'arrival_at' => fake()->dateTime(),
        ];
    }
}
