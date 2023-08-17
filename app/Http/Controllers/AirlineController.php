<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AirlineController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('airlines',[
            'airlines' => Airline::withCount(['flights'])->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

}
