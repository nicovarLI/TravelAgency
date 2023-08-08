<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

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
    public function store(): JsonResponse
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:255','min:2','unique:cities,name']
        ]);
        City::create($attributes);
        $updatedCitiesTable = view('components.table', [
            'cities' => City::all()
        ])->render();

        return response()->json(['updatedCitiesTable'=> $updatedCitiesTable]);
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
    public function update(): string
    {
        $attributes = request()->validate([
            'name' => ['max:255','min:2','unique:cities,name']
        ]);
        $city = City::find(request()->id);
        $city->name = $attributes['name'];
        $city->save();
        return redirect('/')->with('success','City has been updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): string
    {
        City::destroy(request()->id);

        return redirect('/')->with('success','City has been deleted successfully');
    }
}
