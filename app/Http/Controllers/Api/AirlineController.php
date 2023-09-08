<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAirlineRequest;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class AirlineController
{
    public function index(): LengthAwarePaginator
    {
        return Airline::withCount(['flights'])->paginate(10);
    }

    public function getAll(): JsonResponse
    {
        return response()->json(Airline::all());
    }

    public function store(StoreAirlineRequest $request): JsonResponse
    {
        $airline = Airline::create($request->validated());

        $airline->cities()->attach($request->string('cityIds')->explode(','));

        return response()->json([
            'message' => 'Airline stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateAirlineRequest $request, Airline $airline): JsonResponse
    {
        $airline->update($request->validated());
        $cityIds = $request->string('cityIds');

        if($cityIds->isNotEmpty()){
            $airline->cities()->syncWithoutDetaching($cityIds->explode(','));
        }

        return response()->json([
            'message' => 'Airline updated.',
            'status' => 'success',
        ]);
    }

    public function destroy(Airline $airline): JsonResponse
    {
        $airline->delete();

        return response()->json([
            'message' => 'Airline deleted.',
            'status' => 'success',
        ]);
    }

    public function destroyCities(Request $request, Airline $airline): JsonResponse
    {
        $airline->cities()->detach($request->collect('cityIds'));

        return response()->json([
            'message' => 'City-airline relationships deleted successfully',
            'status' => 'success',
        ]);
    }

    public function getCities(Airline $airline): JsonResponse
    {
        return response()->json($airline->cities);
    }
}
