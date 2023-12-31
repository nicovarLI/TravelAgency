<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpsertFlightRequest;
use App\Models\Flight;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class FlightController
{
    public function index(): LengthAwarePaginator
    {
        return Flight::with([
            'originCity:id,name',
            'destinationCity:id,name',
            'airline:id,name'
            ])->paginate(10);
    }

    public function store(UpsertFlightRequest $request): JsonResponse
    {
        Flight::create($request->validated());

        return response()->json([
            'message' => 'Flight stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpsertFlightRequest $request, Flight $flight): JsonResponse
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
