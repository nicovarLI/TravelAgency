<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAirlineRequest;
use App\Http\Requests\UpdateAirlineRequest;
use App\Models\Airline;
use App\Models\City;
use Hamcrest\Arrays\IsArray;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

use function PHPUnit\Framework\isEmpty;

class AirlineController
{
    public function index(): LengthAwarePaginator
    {
        return Airline::withCount(['flights'])->paginate(10);
    }

    public function store(StoreAirlineRequest $request): JsonResponse
    {
        $airline = Airline::create($request->validated());
        $cityIds = explode(',', $request->string('cityIds'));

        $airline->cities()->attach($cityIds);

        return response()->json([
            'message' => 'Airline stored.',
            'status' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateAirlineRequest $request, Airline $airline): JsonResponse
    {
        $airline->update($request->validated());
        $cityIds = $request->string('cityIds')->toString();

        if(!empty($cityIds)){
            $airline->cities()->syncWithoutDetaching(explode(',', $cityIds));
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
        $airline->cities()->detach($request->cityIds);

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
