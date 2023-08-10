<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use PDO;

class CityController extends Controller
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

    public function update(UpdateCityRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $city = City::find(request()->id);
        $city->name = $attributes['name'];
        $city->save();
        return response()->json(['updatedCitiesTable' => $this->updateTable(), 'updatedPaginationLinks' => $this->updateLinks()]);
    }

    public function destroy(DestroyCityRequest $request): jsonResponse
    {
        $attributes = $request->validated();
        City::destroy($attributes['id']);
        return response()->json(['updatedCitiesTable' => $this->updateTable(), 'updatedPaginationLinks' => $this->updateLinks()]);
    }

    private function updateTable(): string
    {
        $page = request()->input('page', 1);
        $cities = City::with(['arrivals', 'departures'])->paginate(10, ['*'], 'page', $page);
        return view('components.table', compact('cities'))->render();
    }
    private function updateLinks(): string
    {
        return view('components.pagination-links', [
            'cities' => City::paginate(10)->withQueryString()
        ])->render();
    }
}
