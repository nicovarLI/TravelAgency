<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController
{
    public function index(): View
    {
        return view('cities', [
            'cities' => City::with(['arrivals', 'departures'])->paginate(10)
        ]);
    }

    public function store(StoreCityRequest $request): JsonResponse
    {
        City::create($request->validated());

        return response()->json(['updatedCitiesTable' => $this->updateTable(), 'updatedPaginationLinks' => $this->updateLinks()]);
    }

    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $attributes = $request->validated();
        $city->name = $attributes['name'];
        $city->save();
        return response()->json(['updatedCitiesTable' => $this->updateTable(), 'updatedPaginationLinks' => $this->updateLinks()]);
    }

    public function destroy(City $city): jsonResponse
    {
        $city->delete();

        return response()->json(['updatedCitiesTable' => $this->updateTable(), 'updatedPaginationLinks' => $this->updateLinks()]);
    }

    private function updateTable(): string
    {
        $cities = City::with(['arrivals', 'departures'])->paginate(10);
        return view('components.table', compact('cities'))->render();
    }
    private function updateLinks(): string
    {
        return view('components.pagination-links', [
            'cities' => City::paginate(10)->withQueryString()
        ])->render();
    }
}
