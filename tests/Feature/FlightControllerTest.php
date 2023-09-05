<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Database\Seeders\AirlineSeeder;
use Database\Seeders\CitySeeder;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;
    private $baseUrl = '/api/flights';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([CitySeeder::class, AirlineSeeder::class]);
    }

    /** @test */
    public function it_should_return_a_list_of_flights()
    {
        $response = $this->get($this->baseUrl);

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
        public function it_should_return_the_remaining_flights_for_the_pagination()
        {
            //TODO FIJARME LA ESTRUCTURA DEL PAGINATOR PARA VERIFICAR EL TAMAÑO DE LA PAGINA Y LA CANTIDAD DE DATOS
            $response = $this->get($this->baseUrl);

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
        $flightData = Flight::factory()->make([
            'departure_at' => '2023-09-10',
            'arrival_at' => '2023-09-11',
        ])->toArray();

        $response = $this->postJson($this->baseUrl, $flightData);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $response->assertJson([
            'message' => 'Flight stored.',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('flights', $flightData);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_should_return_validation_errors_for_invalid_data_when_storing(array $provider)
    {
        $data = $provider['data'];
        $response = $this->postJson('/api/flights', $data);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors($provider['errors']);
    }

    /** @test */
    public function it_should_update_an_existing_flight()
    {
        $airline = Airline::factory()->create();
        $origin = City::factory()->create();
        $destination = City::factory()->create();
        $flight = Flight::factory()->create();

        $updatedData = [
            'airline_id' => $airline->id,
            'origin_city_id' => $origin->id,
            'destination_city_id' => $destination->id,
            'arrival_at' => '2000-02-01',
            'departure_at' => '2000-01-01',
        ];
        $response = $this->putJson("{$this->baseUrl}/{$flight->id}", $updatedData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Flight updated.',
            'status' => 'success',
        ]);
        $this->assertDatabaseHas('flights', $updatedData);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_should_return_validation_errors_for_invalid_data_when_updating(array $provider)
    {
        $flight = Flight::factory()->create();

        $data = $provider['data'];
        $response = $this->putJson("{$this->baseUrl}/{$flight->id}", $data);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors($provider['errors']);
    }

    /** @test */
    public function it_should_delete_an_existing_flight()
    {
        $flight = Flight::factory()->create();

        $response = $this->delete("{$this->baseUrl}/{$flight->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Flight deleted.',
            'status' => 'success',
        ]);
        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }

    /** @test */
    public function it_should_return_not_found()
    {
        $response = $this->delete("{$this->baseUrl}/invalid");

        $response->assertStatus(404);
    }

    private function invalidData(): array
    {
        return [
            ['missing airline id' => [
                'data' => [
                    'origin_city_id' => 1,
                    'destination_city_id' => 2,
                    'arrival_at' => '2000-02-01',
                    'departure_at' => '2000-01-01',
                ],
                'errors' => [
                    'airline_id' => [
                        'The airline id field is required.',
                    ],
                ],
            ]],
            ['missing origin city id' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 1,
                    'arrival_at' => '2000-02-01',
                    'departure_at' => '2000-01-01',
                ],
                'errors' => [
                    'origin_city_id' => [
                        'The origin city id field is required.',
                    ],
                ],
            ]],
            ['missing destination city id' => [
                'data' => [
                    'airline_id' => 1,
                    'origin_city_id' => 1,
                    'arrival_at' => '2000-02-01',
                    'departure_at' => '2000-01-01',
                ],
                'errors' => [
                    'destination_city_id' => [
                        'The destination city id field is required.',
                    ],
                ],
            ]],
            ['missing arrival at' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 2,
                    'origin_city_id' => 1,
                    'departure_at' => '2000-01-01',
                ],
                'errors' => [
                    'arrival_at' => [
                        'The arrival at field is required.',
                    ],
                ],
            ]],
            ['missing departure at' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 2,
                    'origin_city_id' => 1,
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'departure_at' => [
                        'The departure at field is required.',
                    ],
                ],
            ]],
            ['missing all data' => [
                'data' => [],
                'errors' => [
                    'airline_id' => [
                        'The airline id field is required.',
                    ],
                    'origin_city_id' => [
                        'The origin city id field is required.',
                    ],
                    'destination_city_id' => [
                        'The destination city id field is required.',
                    ],
                    'arrival_at' => [
                        'The arrival at field is required.',
                    ],
                    'departure_at' => [
                        'The departure at field is required.',
                    ],
                ],
            ]],
            ['arrival before departure' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 2,
                    'origin_city_id' => 1,
                    'departure_at' => '2000-02-01',
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'arrival_at' => [
                        'The arrival at field must be a date after departure at.',
                    ],
                ],
            ]],
            ['all invalid data types' => [
                'data' => [
                    'airline_id' => 'invalid',
                    'origin_city_id' => 'invalid',
                    'destination_city_id' => 'invalid',
                    'arrival_at' => 'invalid',
                    'departure_at' => 'invalid',
                ],
                'errors' => [
                    'airline_id' => [
                        'The airline id field must be an integer.',
                    ],
                    'origin_city_id' => [
                        'The origin city id field must be an integer.',
                    ],
                    'destination_city_id' => [
                        'The destination city id field must be an integer.',
                    ],
                    'arrival_at' => [
                        'The arrival at field must be a valid date.',
                    ],
                    'departure_at' => [
                        'The departure at field must be a valid date.',
                    ],
                ],
            ]],
            ['invalid airline_id type' => [
                'data' => [
                    'airline_id' => 'invalid',
                    'destination_city_id' => 1,
                    'origin_city_id' => 1,
                    'departure_at' => '2000-02-01',
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'airline_id' => [
                        'The airline id field must be an integer'
                    ]
                ]
            ]],
            ['invalid destination_city_id type' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 'invalid',
                    'origin_city_id' => 1,
                    'departure_at' => '2000-02-01',
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'destination_city_id' => [
                        'The destination city id field must be an integer'
                    ]
                ]
            ]],
            ['invalid origin_id type' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 2,
                    'origin_city_id' => 'invalid',
                    'departure_at' => '2000-02-01',
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'origin_city_id' => [
                        'The origin city id field must be an integer'
                    ]
                ]
            ]],
            ['invalid departure_at type' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 1,
                    'origin_city_id' => 2,
                    'departure_at' => 'invalid',
                    'arrival_at' => '2000-01-01',
                ],
                'errors' => [
                    'departure_at' => [
                        'The departure at field must be a valid date'
                    ]
                ]
            ]],
            ['invalid arrival_at type' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 1,
                    'origin_city_id' => 2,
                    'departure_at' => '2000-01-01',
                    'arrival_at' => 'invalid',
                ],
                'errors' => [
                    'arrival_at' => [
                        'The arrival at field must be a valid date'
                    ]
                ]
            ]],
            ['duplicate origin and destination' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 1,
                    'origin_city_id' => 1,
                    'departure_at' => '2000-01-01',
                    'arrival_at' => '2000-02-01',
                ],
                'errors' => [
                    'destination_city_id' => [
                        'The selected destination city id is invalid.'
                    ]
                ]
            ]],
        ];
    }
}
