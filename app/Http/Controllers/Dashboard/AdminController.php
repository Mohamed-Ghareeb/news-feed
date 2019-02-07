<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'name'      => 'required',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required|confirmed',
        ]);
    
        $data = $request->except(['password', 'password_confirm']);
        $data['password'] = bcrypt($request->password);
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
            'name' => 'required',
            'email' => ['required',  Rule::unique('admins', 'email')->ignore($admin->id)],
        ]);

        $admin->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admins.index');  
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admins.index');  
    }
}
