<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class,'origin_city_id');
    }

    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class,'destination_city_id');
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }
}
