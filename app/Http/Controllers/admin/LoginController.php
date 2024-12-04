<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.pages.login');
    }

    // ============================authenticate==============

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Check if the user exists and fetch the user
        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (in_array($user->role, ['2', '3']) && $user->status != '1') {
                return redirect()->route('login')->with('error', 'Your account is inactive. Please contact the administrator.');
            }
            // Attempt to authenticate the user
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                session(['user_role' => $user->role]);
                switch ($user->role) {
                    case '1':
                        return redirect()->route('admin.dashboard');
                    case '2':
                        return redirect()->route('teamlead.dashboard');
                    case '3':
                        return redirect()->route('user.dashboard');
                    default:
                        Auth::logout();
                        return redirect()->route('login')->with('error', 'Unauthorized access');
                }
            } else {
                return redirect()->route('login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('login')->with('error', 'Either Email/Password is incorrect');
        }
    }

    public function edit()
    {
        $user = Auth::user();
        return view('admin::pages.profile', compact('user'));
    }

    // ==========image uploadation=======
    public function update(Request $request)
    {
        $user = Auth::user();
        $userName = $user->name;
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[0-9]{10}$/|unique:users,mobile,' . $user->id,
            'profile_img' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
            'old_password' => 'nullable|string|min:6',
            'new_password' => 'nullable|string|min:6',
        ]);

        // Update user profile information
        $user->name = $validatedData['name'];
        $user->mobile = $validatedData['mobile'];
        // if ($request->hasFile('profile_img')) {
        //     $destinationPath = 'profiles/';
        //     $fileName = time() . '-' . $request->profile_img->getClientOriginalName();
        //     $request->file('profile_img')->move(public_path($destinationPath), $fileName);
        //     $user->profile_img = $fileName;
        // }

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

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                // Update password if old password matches
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'Old password does not match.']);
            }
        }

        // Save the updated user information
        $save = $user->save();

        if ($save) {
            return redirect()->route('admin.profile')->with('status', [
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
}
