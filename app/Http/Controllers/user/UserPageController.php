<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserPageController extends Controller
{
    // -------------show dashboard----------------------
    public function index()
    {
        $users = Auth::user()->load('department');
        return view('userpage.pages.dashboard', compact('users'));
    }

    // -------------edit user detail-----------------
    public function edit()
    {
        $user = Auth::user();
        return view('userpage.pages.profile', compact('user'));
    }

    public function ProfileUpdate(Request $request)
    {
        $userName = Auth::user()->name;

        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[0-9]{10}$/|unique:users,mobile,' . $user->id,
            'profile_img' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);
        $user->name = $validatedData['name'];
        $user->mobile = $validatedData['mobile'];
        if ($request->hasFile('profile_img')) {
            $destinationPath = 'profiles/';
            $extension = $request->profile_img->getClientOriginalExtension();
            $slugName = Str::slug(auth()->user()->name, '-');
            $fileName = $slugName . '_profile.' . $extension; // Create the filename with slugname_profile.extension

            $request->file('profile_img')->move(public_path($destinationPath), $fileName);

            if ($user->profile_img) {
                $previousImagePath = public_path($destinationPath . $user->profile_img);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $user->profile_img = $fileName;
        }

        $save = $user->save();
        if ($save) {
            return redirect()->route('user.profile')->with('status', [
                'message' => 'Profile updated successfully!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with('message', [
                'message' => 'Error updating profile. Please try again.',
                'type' => 'error'
            ]);
        }
    }

    // -------------logout user -------------------------
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
