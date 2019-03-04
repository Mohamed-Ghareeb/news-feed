<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Storage;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.admins.index', compact('admins'));
    }
    
    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'           => 'required',
            'email'          => 'required|email|unique:admins,email',
            'profile_image'  => 'sometimes|nullable|image',
            'password'       => 'required|confirmed',
        ]);
    
        $data = $request->except(['password', 'password_confirm', 'profile_image']);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('profile_image')) {
            Image::make($request->profile_image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/admins_images/' . $request->profile_image->hashName()));
        } // end of if

        $data['profile_image'] = 'uploads/admins_images/' . $request->profile_image->hashName();


        Admin::create($data);
        session()->flash('success', __('site.added_successfully'));    
        return redirect()->route('dashboard.admins.index');            
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'           => 'required',
            'profile_image'  => 'sometimes|nullable|image',
            'email'          => ['required',  Rule::unique('admins', 'email')->ignore($admin->id)],
        ]);

        $data = $request->except(['profile_image']);

        if ($request->hasFile('profile_image')) {
            
            if ($admin->profile_image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/admins_images/' . $admin->profile_image);
            }

            Image::make($request->file('profile_image'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/admins_images/' . $request->file('profile_image')->hashName()));
        
            $data['profile_image'] = 'uploads/admins_images/' . $request->file('profile_image')->hashName();

        } // end of if

        $admin->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admins.index');  
    }

    public function destroy(Admin $admin)
    {
        if ($admin->profile_image) {
            Storage::disk('public_uploads')->delete($admin->profile_image);
        }
        $admin->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admins.index');  
    }
}
