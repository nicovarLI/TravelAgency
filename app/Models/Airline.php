<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }

    public function cities(): HasMany
    {
        return $this->belongsToMany(City::class);
    }
}
