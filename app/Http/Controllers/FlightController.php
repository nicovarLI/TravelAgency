<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightController extends Controller
{
    public function index(): View
    {
        return view('flights', [
            'flights' => Flight::with([
                'originCity:id,name',
                'destinationCity:id,name',
                'airline:id,name'
                ])->paginate(10)
        ]);
    }
}
