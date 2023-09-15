<?php

namespace Tests\Feature;

use App\Models\Flight;
use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Database\Factories\FlightFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    private const BASE_URL = '/api/flights';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /** @test */
    public function it_should_return_a_list_of_flights(): void
    {
        $this
            ->get(self::BASE_URL)
            ->assertSuccessful()
            ->assertJsonStructure([
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
    public function it_should_return_a_list_of_flights_paginated_and_include_pagination_data(): void
    {
        $this
            ->get(self::BASE_URL."?page=2")
            ->assertSuccessful()
            ->assertJsonStructure([
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
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ])
            ->assertJson([
                'current_page' => 2,
                'per_page' => 10,
                'from' => 11,
                'to' => 15,
                'total' => 15,
            ]);
    }

    /** @test */
    public function it_should_return_an_empty_list_of_flights_when_database_is_empty(): void
    {
        Flight::truncate();

        $this
            ->get(self::BASE_URL)
            ->assertSuccessful()
            ->assertJson(['data' => []])
            ->assertJson(['total' => 0]);
    }

    /** @test */
    public function it_should_store_a_new_flight(): void
    {
        $flightData = [
            'airline_id' => 1,
            'destination_city_id' => 1,
            'origin_city_id' => 2,
            'arrival_at' => '2000-02-01T05:02',
            'departure_at' => '2000-01-01T02:01',
        ];

        $this
            ->postJson(self::BASE_URL, $flightData)
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Flight stored.',
                'status' => 'success',
            ]);

        $this->assertDatabaseHas(Flight::class, $flightData);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_should_return_validation_errors_for_invalid_data_when_storing(array $provider): void
    {
        $data = $provider['data'];

        $this
            ->postJson(self::BASE_URL, $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors($provider['errors']);
    }

    /** @test */
    public function it_should_update_an_existing_flight(): void
    {
        $airline = AirlineFactory::new()->create();
        $origin = CityFactory::new()->create();
        $destination = CityFactory::new()->create();
        $flight = FlightFactory::new()->create();

        $updatedData = [
            'airline_id' => $airline->id,
            'origin_city_id' => $origin->id,
            'destination_city_id' => $destination->id,
            'arrival_at' => '2000-02-01T05:02',
            'departure_at' => '2000-01-01T02:01',
        ];

        $this
            ->putJson(self::BASE_URL."/{$flight->id}", $updatedData)
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Flight updated.',
                'status' => 'success',
            ]);

        $this->assertDatabaseHas(Flight::class, $updatedData);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_should_return_validation_errors_for_invalid_data_when_updating(array $provider): void
    {
        $flight = FlightFactory::new()->create();

        $this
            ->putJson(self::BASE_URL."/{$flight->id}", $provider['data'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors($provider['errors']);
    }

    /** @test */
    public function it_should_delete_an_existing_flight(): void
    {
        $flight = FlightFactory::new()->create();

        $this
            ->delete(self::BASE_URL."/{$flight->id}")
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Flight deleted.',
                'status' => 'success',
            ]);

        $this->assertDatabaseMissing(Flight::class, ['id' => $flight->id]);
    }

    /** @test */
    public function it_should_return_not_found_when_deleting_invalid_id(): void
    {
        $this
            ->delete(self::BASE_URL."/invalid")
            ->assertNotFound();
    }

    private function invalidData(): array
    {
        return [
            ['missing airline id' => [
                'data' => [
                    'origin_city_id' => 1,
                    'destination_city_id' => 2,
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
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
                    'departure_at' => '2000-02-01T05:02',
                    'arrival_at' => '2000-01-01T02:01',
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
                        'The arrival at field must match the format Y-m-d\\TH:i.',
                    ],
                    'departure_at' => [
                        'The departure at field must match the format Y-m-d\\TH:i.',
                    ],
                ],
            ]],
            ['invalid airline_id type' => [
                'data' => [
                    'airline_id' => 'invalid',
                    'destination_city_id' => 1,
                    'origin_city_id' => 1,
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => 'invalid',
                ],
                'errors' => [
                    'departure_at' => [
                        'The departure at field must match the format Y-m-d\\TH:i.'
                    ]
                ]
            ]],
            ['invalid arrival_at type' => [
                'data' => [
                    'airline_id' => 1,
                    'destination_city_id' => 1,
                    'origin_city_id' => 2,
                    'arrival_at' => 'invalid',
                    'departure_at' => '2000-01-01T02:01',
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
                    'arrival_at' => '2000-02-01T05:02',
                    'departure_at' => '2000-01-01T02:01',
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
