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
        return view('dashboard.countries.index', compact('countries'));
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
}
