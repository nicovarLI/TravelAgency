<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAirlineRequest;
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAirlineRequest $request): JsonResponse
    {
        Airline::create($request->validated());

        return response()->json([
            'message' => 'Airline stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        //
    }
}
