<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController
{
    public function index(): View
    {
        return view('cities', [
            'cities' => $this->getCities()
        ]);
    }
    public function getCities(): LengthAwarePaginator
    {
        return City::with(['arrivals', 'departures'])->paginate(10);
    }

    public function store(StoreCityRequest $request): JsonResponse
    {
        City::create($request->validated());

        return response()->json([
            'message' => 'City stored.',
            'status' => 'success',
        ],201);
    }

    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $attributes = $request->validated();
        $city->name = $attributes['name'];
        $city->save();
        return response()->json([
            'message' => 'City updated.',
            'status' => 'success',
        ],200);
    }

    public function destroy(City $city): jsonResponse
    {
        $city->delete();

        return response()->json([
            'message' => 'City deleted.',
            'status' => 'success',
        ],204);
    }
}
