<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class DeptController extends Controller
{
    // =======list=====
    public function department_index()
    {
        $datas = Department::orderBy('created_at', 'desc')->paginate(10);
        return view('admin::pages.department.list', compact('datas'));
    }

    // ===== add====
    public function add_department()
    {
        $users = User::where('role', 1)->get();
        return view('admin::pages.department.add', compact('users'));
    }

    // ===========create department=========
    public function create_department(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $existDepartMent = Department::where('dept_name', $request->name)->first();
            if ($existDepartMent) {
                throw new \Exception('Department with the same name already exists.');
            }

            $department = new Department;
            $department->dept_name = $request->name;

            if (!$department->save()) {
                throw new \Exception('Error creating department. Please try again.');
            }

            return redirect('admin/department/')->with('success', 'Department created successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->with('error', $errorMessage)->withInput();
        }
    }

    // ========edit=======
    public function edit_department(Request $request)
    {
        $id = ($request->id);
        $data = Department::where('id', $id)->first();
        return view('admin::pages.department.edit', compact('data'));
    }

    // ==========update===========
    public function update_department(Request $request, $id = null)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $department = Department::findOrFail($id);
        $department->dept_name = $request->name;
        $result = $department->save();

        if (!$result) {
            return redirect()->back()->withSuccess('error', 'team is not inserted !');
        }

        return redirect('admin/department/')->withSuccess('Team created successfully');
    }
    // ========delete=======
    public function delete_department(Request $request, $id = null)
    {
        // If $id is null, get the ID from the request
        if ($id === null) {
            $id = $request->id;
        }

        // Find the department
        $department = Department::findOrFail($id);

        // Check if there are users belonging to the department
        $usersCount = $department->users()->count();

        if ($usersCount > 0) {
            // If there are users, return a message indicating that they need to be deleted first
            return redirect('/admin/department/')->with('error', 'Please delete all users belonging to this department first.');
        }

        // If no users are found, delete the department
        $department->delete();

        return redirect('/admin/department/')->withSuccess('Deleted successfully');
    }
}
