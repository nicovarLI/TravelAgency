<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function departures(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }

    public function arrivals(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }

    public function airlines(): HasMany
    {
        return $this->hasMany(Airline::class, 'city_airline', 'city_id', 'airline_id');
    }
}
