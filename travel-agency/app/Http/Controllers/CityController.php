<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('cities', [
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(): string
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255','min:2','unique:cities,name']
        ]);
        $city = City::create($attributes);

        return redirect('/')->with('success','City has been created');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
