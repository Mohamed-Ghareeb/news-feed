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
        $all_trashed = City::onlyTrashed()->get();
        return view('dashboard.cities.index', compact('cities', 'all_trashed'));
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
    
    public function all_trashed() // Soft Delete [ all_trashed ] => Mean Showing All Records trashed
    {
        $all_trashed = City::onlyTrashed()->get();
        return view('dashboard.cities.trashed', compact('all_trashed'));
    }

    public function restore($id) // Soft Delete [ restore ] => Mean restoring The Trashed Cities
    {
        // dd($id, City::onlyTrashed()->where('id', $id)->get());
        City::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('site.restored_successfully'));
        return redirect()->route('dashboard.cities.all_trashed');
    }

    public function delete($id) // Soft Delete [ delete ] => Mean Delete form Database And The Application
    {
        $city = City::onlyTrashed()->where('id', $id)->first();
        $city->forceDelete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.cities.index');
    }
}
