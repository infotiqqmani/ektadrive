<?php

namespace App\Http\Controllers\teamlead;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TeamLeadController extends Controller
{
    // ----------------------member function-----------------
    public function index()
    {
        $teamLead = Auth::user();
        $dept = $teamLead->department;

        $departmentId = $teamLead->dept_id;
        $users = User::where('dept_id', $departmentId)
            ->whereIn('role', ['2', '3'])
            ->get();
        $members = User::where('dept_id', $departmentId)
            ->whereIn('role', ['2', '3'])
            ->get()->count();
        $teamLeadFolderCount = Folder::whereHas('user', function ($query) use ($departmentId) {
            $query->where('role', '2')->where('dept_id', $departmentId);
        })
            ->count();

        return view('teamlead.pages.dashboard', compact('users', 'teamLead', 'members', 'teamLeadFolderCount', 'dept'));
    }

    // -------------------------update and see profile-------------------------
    public function edit()
    {
        $user = Auth::user();
        return view('teamlead.pages.profile', compact('user'));
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
        // if ($request->hasFile('profile_img')) {
        //     $fileName = time() . '-' . $request->profile_img->getClientOriginalName();
        //     $imagePath = $request->file('profile_img')->storeAs('public/profiles/TeamLead/' . $userName . '/', $fileName);
        //     if ($user->profile_img) {
        //         Storage::delete('public/' . $user->profile_img);
        //     }
        //     $user->profile_img = $fileName;
        // }

        if ($request->hasFile('profile_img')) {
            $destinationPath = 'profiles/';
            $extension = $request->profile_img->getClientOriginalExtension();
            $slugName = Str::slug(auth()->user()->name, '-');
            $fileName = $slugName . '_profile.' . $extension;

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
            return redirect()->route('teamlead.profile')->with('status', [
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
    // ------------------------logout-----------------------
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
