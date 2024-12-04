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
    public function user_create(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|numeric',
                'password' => 'required|string',
                'team' => 'required|string'
            ]);

            // If validation fails, return with errors
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Create a new user instance and populate fields
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->dept_id = $request->team;
            $TeamLead = $user->team_lead = $request->has('team_lead_checkbox') ? '1' : '0';

            // Assign role if user is a team lead
            if ($TeamLead) {
                $user->role = '2';
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
    public function update_user(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
            'team' => 'required|string',
            'new_password' => 'nullable|string|min:6',
            'new_password_confirmation' => 'nullable|string|min:6'

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if ($request->new_password) {
            if ($request->new_password == $request->new_password_confirmation) {
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'Old password does not match.']);
            }
        }
        $user->dept_id = $request->team;
        if ($request->has('team_lead_checkbox')) {
            $user->team_lead = '1';
            $user->role = '2';
        } else {
            $user->team_lead = '0';
            $user->role = '3';
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect('admin/user/')->with('success', 'User updated successfully.');
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
