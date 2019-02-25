<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function do_login()
    {
        $remember_me = request('remember_me') == 1 ? true : false;
        if (Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect()->route('dashboard.index');
        } else {
            session()->flash('error', 'The Data Is Not Correct');
            return redirect()->route('dashboard.login');
        }
    }
}
