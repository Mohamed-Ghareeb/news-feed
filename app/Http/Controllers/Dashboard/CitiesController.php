<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\Country;
use App\cityTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->get();
        
        return view('dashboard.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();            
        return view('dashboard.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'ar.name'    => 'required|unique:city_translations,name',
            'country_id' => ['required', Rule::exists('countries', 'id')],
        ]);

        City::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.cities.index');
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('dashboard.cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'ar.name' => ['required', Rule::unique('city_translations', 'name')->ignore($city->id)],
            'country_id' => ['required', Rule::exists('countries', 'id')],
        ]);

        $city->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.cities.index');
    }

    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.cities.index');
    }
}
