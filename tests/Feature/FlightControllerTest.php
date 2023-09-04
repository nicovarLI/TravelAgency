<?php

namespace Tests\Feature;

use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    /** @test */
    public function it_should_return_a_list_of_flights()
    {
        Flight::factory()->count(5)->create();

        $response = $this->get('/api/flights');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'airline',
                    'origin_city',
                    'destination_city',
                    'departure_at',
                    'arrival_at'
                ],
            ],
        ]);
    }
     /** @test */
    public function it_should_store_a_new_flight()
    {
        // Create a sample flight data
        $flightData = Flight::factory()->make()->toArray();

        // Test the store route
        $response = $this->post('/api/flights', $flightData);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Flight stored.',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('flights', $flightData);
    }
     /** @test */
    public function it_should_update_an_existing_flight()
    {
        $flight = Flight::factory()->create();

        $updatedData = [
            'airline_id' => 2,
            'origin_city_id' => 3,
        ];
        $response = $this->put("/api/flights/{$flight->id}", $updatedData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Flight updated.',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('flights', $updatedData);
    }
     /** @test */
    public function it_should_delete_an_existing_flight()
    {
        $flight = Flight::factory()->create();

        $response = $this->delete("/api/flights/{$flight->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Flight deleted.',
            'status' => 'success',
        ]);
        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }
}
