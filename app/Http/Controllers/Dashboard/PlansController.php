<?php

namespace App\Http\Controllers\Dashboard;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Image;
use Storage;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('dashboard.plans.index', compact('plans'));
    }
    
    public function create()
    {
        $types = ['in-site', 'in-site & e-mail', 'no notification'];
        return view('dashboard.plans.create', compact('types'));
    }
    
    public function store(Request $request)
    {        
        $types = ['in-site', 'in-site & e-mail', 'no notification'];
        $validated = $request->validate([
            'name'      => 'required',
            'features'  => 'required',
            'price'     => 'required|numeric',
            'image'     => 'required|image',
            'notification_type' => ['required', Rule::in($types)],
        ]);

        $validated = $request->except(['image']);
        if ($request->hasFile('image')) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/plans_icons/' . $request->image->hashName()));
        } // end of if

        $validated['image'] = 'uploads/plans_icons/' . $request->image->hashName();
        $validated['price'] = abs($validated['price']);

        Plan::create($validated);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.plans.index');
    }

    public function edit(Plan $plan)
    {
        $types = ['in-site', 'in-site & e-mail', 'no notification'];
        return view('dashboard.plans.edit', compact('types', 'plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $types = ['in-site', 'in-site & e-mail', 'no notification'];
        $validated = $request->validate([
            'name'      => 'required',
            'features'  => 'required',
            'price'     => 'required|numeric',
            'image'     => 'sometimes|nullable',
            'notification_type' => ['required', Rule::in($types)],
        ]);
        
        $validated = $request->except(['image']);

        if ($request->hasFile('image')) {
            
            if ($plan->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/plans_icons/' . $plan->image);
            }

            Image::make($request->file('image'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/plans_icons/' . $request->file('image')->hashName()));
        
            $validated['image'] = $request->file('image')->hashName();

        } // end of if
        
        $validated['price'] = abs($validated['price']);

        $plan->update($validated);
        
        session()->flash('success', __('site.added_successfully'));
        
        return redirect()->route('dashboard.plans.index');
        
    }

    public function destroy(Plan $plan)
    {

        // dd($plan->image);
        if ($plan->image) {
            Storage::disk('public_uploads')->delete($plan->image);
        }

        $plan->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.plans.index');
    }
}
