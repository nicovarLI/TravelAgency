<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights', [
            'flights' => Flight::with(['OriginCity:id,name', 'DestinationCity:id,name', 'Airline:id,name'])->paginate(10)
        ]);
    }
}
