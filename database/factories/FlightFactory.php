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
        $airline = Airline::inRandomOrder()->firstOrFail();
        $cities = $airline->cities;

        $originCity = $cities->random();
        do {
            $destinationCity = $cities->random();
        } while ($originCity->id === $destinationCity->id);

        $departureTime = fake()->dateTime();
        $arrivalTime = fake()->dateTimeBetween($departureTime, '+8 hours');

        return [
            'origin_city_id' => $originCity->id,
            'destination_city_id' => $destinationCity->id,
            'airline_id'=> $airline->id,
            'departure_at' => $departureTime,
            'arrival_at' => $arrivalTime,
        ];
    }
}
