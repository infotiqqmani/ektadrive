<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\TeamLead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function user_index()
    {

        $users = User::with('department')
            ->where('role', '!=', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin::pages.user.list', ['users' => $users]);
    }


    // ==========add user=========
    public function add_user(Request $request)
    {
        $depts = Department::all();
        return view('admin::pages.user.add', ['depts' => $depts]);
    }
    // public function user_create(Request $request)
    // {
    //     try {
    //         // Validate the request
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string',
    //             'email' => 'required|email|unique:users,email',
    //             'mobile' => 'required|numeric',
    //             'password' => 'required|string',
    //             'team' => 'required|string'
    //         ]);

    //         // If validation fails, return with errors
    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         // Create a new user instance and populate fields
    //         $user = new User;
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->mobile = $request->mobile;
    //         $user->password = Hash::make($request->password);
    //         $user->dept_id = $request->team;
    //         $TeamLead = $user->team_lead = $request->has('team_lead_checkbox') ? '1' : '0';

    //         // Assign role if user is a team lead
    //         if ($TeamLead) {
    //             $user->role = '2';
    //         }

    //         // Save the user and check for success
    //         if ($user->save()) {
    //             return redirect('admin/user/')->with('success', 'User created successfully.');
    //         } else {
    //             throw new \Exception('Error creating user. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         // Return with an error message if exception occurs
    //         return redirect()->back()->with('error', $e->getMessage())->withInput();
    //     }
    // }

    // update code with full security for the adding user

    public function user_create(Request $request)
    {
        try {
            // Validate the request with stricter rules
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/', // Only allow alphabet and spaces
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|numeric|digits:10', // Ensure mobile has exactly 10 digits
                'password' => 'required|string|min:6', // Ensure strong password (at least 8 characters)
                'team' => 'required|string|exists:departments,id' // Ensure the team exists
            ]);

            // If validation fails, return with errors
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Sanitize the inputs to strip HTML/JavaScript
            $name = strip_tags($request->input('name'));
            $email = strip_tags($request->input('email'));
            $mobile = strip_tags($request->input('mobile'));
            $password = strip_tags($request->input('password'));
            $team = strip_tags($request->input('team'));

            // Check for team_lead_checkbox and ensure it's safe (boolean)
            $teamLead = $request->has('team_lead_checkbox') ? '1' : '0';

            // Create a new user instance and populate fields
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->mobile = $mobile;
            $user->password = Hash::make($password);
            $user->dept_id = $team;
            $user->team_lead = $teamLead;

            // Assign role if user is a team lead
            if ($teamLead) {
                $user->role = '2'; // Assuming '2' is for team leads
            }

            // Save the user and check for success
            if ($user->save()) {
                return redirect('admin/user/')->with('success', 'User created successfully.');
            } else {
                throw new \Exception('Error creating user. Please try again.');
            }
        } catch (\Exception $e) {
            // Return with an error message if exception occurs
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    public function edit_user(Request $request)
    {
        $id = $request->id;
        $data = User::findOrFail($id);
        $dept = Department::all();
        return view('admin::pages.user.edit', compact('data', 'dept'));
    }

    // =================update==========================
    // public function update_user(Request $request, $id = null)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         // 'email' => 'required|email|unique:users,email,' . $id,
    //         'mobile' => 'required|string',
    //         'password' => 'nullable|string|min:6|confirmed',
    //         'team' => 'required|string',
    //         'new_password' => 'nullable|string|min:6',
    //         'new_password_confirmation' => 'nullable|string|min:6'

    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $user = User::findOrFail($id);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->mobile = $request->mobile;
    //     if ($request->new_password) {
    //         if ($request->new_password == $request->new_password_confirmation) {
    //             $user->password = Hash::make($request->new_password);
    //         } else {
    //             return redirect()->back()->withErrors(['old_password' => 'Old password does not match.']);
    //         }
    //     }
    //     $user->dept_id = $request->team;
    //     if ($request->has('team_lead_checkbox')) {
    //         $user->team_lead = '1';
    //         $user->role = '2';
    //     } else {
    //         $user->team_lead = '0';
    //         $user->role = '3';
    //     }
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();
    //     return redirect('admin/user/')->with('success', 'User updated successfully.');
    // }

    // latest for the  udpaeted usre with security
    public function update_user(Request $request, $id = null)
{
    try {
        // Validate the request with stricter rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',  // Only allow alphabet and spaces
            'email' => 'required|email|unique:users,email,' . $id,  // Ensure the email is unique except for current user
            'mobile' => 'required|string|digits:10',  // Ensure mobile has exactly 10 digits
            'password' => 'nullable|string|min:6|confirmed',  // Validate password length and confirmation
            'team' => 'required|string|exists:departments,id',  // Ensure the team exists
            'new_password' => 'nullable|string|min:6|confirmed',  // Validate new password if provided
            'new_password_confirmation' => 'nullable|string|min:6'  // Validate new password confirmation if provided
        ]);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by ID
        $user = User::findOrFail($id);

        // Sanitize and strip HTML/JS tags from user inputs
        $name = strip_tags($request->input('name'));
        $email = strip_tags($request->input('email'));
        $mobile = strip_tags($request->input('mobile'));
        $team = strip_tags($request->input('team'));

        // Update basic user info
        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->dept_id = $team;

        // If a new password is provided, ensure it's confirmed and hashed
        if ($request->new_password) {
            if ($request->new_password == $request->new_password_confirmation) {
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->withErrors(['new_password' => 'New password and confirmation do not match.']);
            }
        }

        // Handle team lead status and role assignment
        if ($request->has('team_lead_checkbox')) {
            $user->team_lead = '1';
            $user->role = '2';  // Assuming '2' is the role for team leads
        } else {
            $user->team_lead = '0';
            $user->role = '3';  // Assuming '3' is the role for normal users
        }

        // Save the updated user data
        $user->save();

        // Return success message
        return redirect('admin/user/')->with('success', 'User updated successfully.');

    } catch (\Exception $e) {
        // Return error message in case of exception
        return redirect()->back()->with('error', $e->getMessage())->withInput();
    }
}

    // -----------------------------status update---------------------------------------
    public function status_update(Request $request)
    {
        $id = $request->id;
        $record = User::find($id);

        if ($record) {
            if ($record->status == '1') {
                $record->previous_role = $record->role;
                $record->status = '0';
                $record->role = '0';
            } else {
                $record->status = '1';
                $record->role = $record->previous_role ?? $record->role;
                $record->previous_role = null;
            }
            $record->save();
            return redirect()->back()->with('success', 'Status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Record not found.');
        }
    }


    public function getTeamLead($dept_id)
    {
        $teamLead = User::where('team_lead', '1')->where('dept_id', $dept_id)->first();
        return response()->json(['team_lead' => $teamLead]);
    }

    // ++++++++++++++++++++++ Team lead list++++++++++++++++++++
    public function delete_user(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->delete();
        if ($user) {
            return redirect('admin/user/')->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', ' not deleted! some error is occur ');
        }
    }
}
