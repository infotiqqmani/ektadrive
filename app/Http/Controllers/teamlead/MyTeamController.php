<?php

namespace App\Http\Controllers\teamlead;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;

class MyTeamController extends Controller
{
    public function myTeams()
    {
        $teamLead = Auth::user();
        $departmentId = $teamLead->dept_id;
        $users = User::where('dept_id', $departmentId)
            ->where('role', '!=', '1') // Exclude users with role 1
            ->paginate(10);
        return view('teamlead.pages.folder.list', compact('users', 'teamLead'));
    }
}
