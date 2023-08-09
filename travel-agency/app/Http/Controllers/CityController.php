<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): View
    {
        $cities = City::paginate(10); // 10 ciudades por página
        return view('cities', compact('cities'));
    }

    public function store(): JsonResponse
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255','min:2','unique:cities,name']
        ]);
        City::create($attributes);
        return response()->json(['updatedCitiesTable'=> $this->updateTable(),'updatedPaginationLinks'=>$this->updateLinks()]);
    }
    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    public function update(): JsonResponse
    {
        $attributes = request()->validate([
            'name' => ['max:255','min:2','unique:cities,name']
        ]);
        $city = City::find(request()->id);
        $city->name = $attributes['name'];
        $city->save();
        return response()->json(['updatedCitiesTable'=>$this->updateTable(),'updatedPaginationLinks'=>$this->updateLinks()]);
    }

    public function destroy(): jsonResponse
    {
        City::destroy(request()->id);
        return response()->json(['updatedCitiesTable'=> $this->updateTable(),'updatedPaginationLinks'=>$this->updateLinks()]);

    }

    private function updateTable(): string
    {
        $cities = City::paginate(10); // 10 ciudades por página
        return view('components.table', compact('cities'))->render();

    }
    private function updateLinks()
    {
        $cities = City::paginate(10);
        return view('components.pagination-links', compact('cities'))->render();
    }
}
