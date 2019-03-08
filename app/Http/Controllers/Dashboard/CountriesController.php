<?php

namespace App\Http\Controllers\Dashboard;

use App\Country;
use App\CountryTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $all_trashed = Country::onlyTrashed()->get();
        return view('dashboard.countries.index', compact('countries', 'all_trashed'));
    }

    public function create()
    {
        return view('dashboard.countries.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'ar.name' => 'required|unique:country_translations,name',
        ]);

        Country::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.countries.index');
    }

    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'ar.name' => ['required', Rule::unique('country_translations', 'name')->ignore($country->id)]
        ]);

        $country->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.countries.index');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.countries.index');
    }
    
    public function all_trashed() // Soft Delete [ all_trashed ] => Mean Showing All Records trashed
    {
        $all_trashed = Country::onlyTrashed()->get();
        return view('dashboard.countries.trashed', compact('all_trashed'));
    }

    public function restore($id) // Soft Delete [ restore ] => Mean restoring The Trashed Countries
    {
        // dd($id, Country::onlyTrashed()->where('id', $id)->get());
        Country::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('site.restored_successfully'));
        return redirect()->route('dashboard.countries.all_trashed');
    }

    public function delete($id) // Soft Delete [ delete ] => Mean Delete form Database And The Application
    {
        $country = Country::onlyTrashed()->where('id', $id)->first();
        $country->forceDelete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.countries.index');
    }
}
