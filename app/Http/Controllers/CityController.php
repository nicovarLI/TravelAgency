<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\View\View;

class CityController
{
    public function index(): View
    {
        return view('cities', [
            'cities' => City::paginate(10)
        ]);
    }
}
