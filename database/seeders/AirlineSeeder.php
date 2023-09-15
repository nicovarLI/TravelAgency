<?php

namespace Database\Seeders;

use Database\Factories\AirlineFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AirlineFactory::new()->count(20)->hasCities(2)->create();
    }
}
