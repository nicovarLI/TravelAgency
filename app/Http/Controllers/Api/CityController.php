<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class CityController
{
    public function index(): LengthAwarePaginator
    {
        return City::withCount(['arrivals', 'departures'])->paginate(10);
    }

    public function getAll(): JsonResponse
    {
        return response()->json(City::all());
    }

    public function store(StoreCityRequest $request): JsonResponse
    {
        City::create($request->validated());

        return response()->json([
            'message' => 'City stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $city->update($request->validated());

        return response()->json([
            'message' => 'City updated.',
            'status' => 'success',
        ]);
    }

    public function destroy(City $city): JsonResponse
    {
        $city->delete();

        return response()->json([
            'message' => 'City deleted.',
            'status' => 'success',
        ]);
    }
}
