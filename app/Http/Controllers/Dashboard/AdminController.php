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
        $all_trashed = Admin::onlyTrashed()->get();
        return view('dashboard.admins.index', compact('admins','all_trashed'));
    }
    
    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email|unique:admins,email',
            'profile_image'  => 'sometimes|nullable|image',
            'password'       => 'required|confirmed',
        ]);
    
        $data = $request->except(['password', 'password_confirmation', 'profile_image']);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('profile_image')) {
            Image::make($request->profile_image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/admins_images/' . $request->profile_image->hashName()));
            $data['profile_image'] = 'uploads/admins_images/' . $request->profile_image->hashName();
        } else {
            $data['profile_image'] = 'uploads/admins_images/default.png';
        } // end of if

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
            'first_name'     => 'required',
            'last_name'      => 'required',
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

    public function destroy(Admin $admin) // Soft Delete [ destroy ] => Mean Trash
    {
        $admin->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admins.index');
    }

    public function all_trashed() // Soft Delete [ all_trashed ] => Mean Showing All Records trashed
    {
        $all_trashed = Admin::onlyTrashed()->get();
        return view('dashboard.admins.trashed', compact('all_trashed'));
    }

    public function restore($id) // Soft Delete [ restore ] => Mean restoring The Trashed Admins
    {
        // dd($id, Admin::onlyTrashed()->where('id', $id)->get());
        Admin::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('site.restored_successfully'));
        return redirect()->route('dashboard.admins.all_trashed');
    }

    public function delete($id) // Soft Delete [ delete ] => Mean Delete form Database And The Application
    {
        $admin = Admin::onlyTrashed()->where('id', $id)->first();
        // $admin->onlyTrashed()->where('id', $id)
        // dd($admin);
        if ($admin->profile_image) {
            Storage::disk('public_uploads')->delete($admin->profile_image);
        }
        $admin->forceDelete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admins.index');
    }
}
