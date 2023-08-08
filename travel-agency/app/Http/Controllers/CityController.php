<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): View
    {
        return view('cities', [
            'cities' => City::all()
        ]);
    }

    public function store(): JsonResponse
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255','min:2','unique:cities,name']
        ]);
        City::create($attributes);
        return response()->json(['updatedCitiesTable'=> $this->updateTable()]);
    }
    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    public function update(): JsonResponse
    {
        $attributes = request()->validate([
            'name' => ['max:255','min:2','unique:cities,name']
        ]);
        $city = City::find(request()->id);
        $city->name = $attributes['name'];
        $city->save();
        return response()->json(['updatedCitiesTable'=>$this->updateTable()]);
    }

    public function destroy(): jsonResponse
    {
        City::destroy(request()->id);
        return response()->json(['updatedCitiesTable'=> $this->updateTable()]);
    }

    private function updateTable(): string
    {
        return view('components.table', [
            'cities' => City::all()
        ])->render();
    }
}
