<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
// use Session;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::all()->count();
        $members = User::all()->count();
        $teamleads = User::where('team_lead', '1')->count();

        return view('admin::pages.dashboard', compact('departments', 'members', 'teamleads'));
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
