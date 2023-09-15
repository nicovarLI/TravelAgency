<?php

namespace Database\Seeders;

use Database\Factories\FlightFactory;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       FlightFactory::new()->count(15)->create();
    }
}
