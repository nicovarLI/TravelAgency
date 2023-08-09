<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Flight;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): View
    {
        return view('cities', [
            'cities'=> City::latest()->paginate(10)
        ]);
    }

    public function store(): JsonResponse
    {
        var_dump(request());
        $attributes = request()->validate([
            'name' => ['required', 'max:255','min:2','unique:cities,name']
        ]);
        $arr['name'] = $attributes['name'];
        City::create($arr);
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
            'name' => ['max:40','min:2','unique:cities,name']
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
        $page = request()->input('page', 1);
        $cities = City::paginate(10, ['*'], 'page', $page);
        return view('components.table', compact('cities'))->render();
    }
    private function updateLinks(): string
    {
        return view('components.pagination-links', [
            'cities'=> City::latest()->paginate(10)->withQueryString()
        ])->render();
    }
}
