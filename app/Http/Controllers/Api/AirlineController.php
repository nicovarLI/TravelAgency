<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAirlineRequest;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirlineController
{
    public function index():LengthAwarePaginator
    {
        return Airline::withCount(['flights'])->paginate(10);
    }

    public function store(StoreAirlineRequest $request): JsonResponse
    {
        Airline::create($request->validated());

        return response()->json([
            'message' => 'Airline stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateAirlineRequest $request, Airline $airline): JsonResponse
    {
        $airline->update($request->validated());

        return response()->json([
            'message' => 'airline deleted.',
            'status' => 'success',
        ]);
    }

    public function destroy(Airline $airline): JsonResponse
    {
        $airline->delete();

        return response()->json([
            'message' => 'airline deleted.',
            'status' => 'success',
        ]);
    }
}
