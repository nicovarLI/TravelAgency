<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Flight;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class FlightController
{
    public function index(): LengthAwarePaginator
    {
        return Flight::with(['OriginCity:id,name', 'DestinationCity:id,name', 'Airline:id,name'])->paginate(10);
    }

    public function store(StoreFlightRequest $request): JsonResponse
    {
        Flight::create($request->validated());

        return response()->json([
            'message' => 'Flight stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateFlightRequest $request, Flight $flight): JsonResponse
    {
        $flight->update($request->validated());

        return response()->json([
            'message' => 'Flight updated.',
            'status' => 'success',
        ]);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();

        return response()->json([
            'message' => 'Flight deleted.',
            'status' => 'success',
        ]);
    }
}
