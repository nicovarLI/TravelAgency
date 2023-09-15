<?php

namespace Database\Factories;

use Carbon\CarbonImmutable;
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
        $airline = AirlineFactory::new()->hasCities(2)->create();
        $departureAt = CarbonImmutable::now();

        return [
            'origin_city_id' => $airline->cities[0]->id,
            'destination_city_id' => $airline->cities[1]->id,
            'airline_id'=> $airline->id,
            'departure_at' => $departureAt->seconds(0),
            'arrival_at' => $departureAt->addHours(12)->seconds(0),
        ];
    }
}
