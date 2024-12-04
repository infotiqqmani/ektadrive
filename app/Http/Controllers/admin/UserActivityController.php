<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function teamLead()
    {
        return view('admin.pages.activity.activity');
    }

    // Team Lead activity functions 
    public function teamleadFileList()
    {
        $teamLeadRole = 'team_lead';
        $teamLeadIds = User::where('role', $teamLeadRole)->pluck('id');
        $deletedFiles = File::onlyTrashed()->whereIn('user_id', $teamLeadIds)->get();
        return view('admin.pages.activity.teamlead-trash-file', compact('deletedFiles'));
    }

    // ++++++++++member list +++++++++++++++
    public function teamleadDeleteFiles()
    {
        $teamLeadRole = '2';
        $teamLeadIds = User::where('role', $teamLeadRole)->pluck('id');
        $deletedFiles = File::onlyTrashed()->whereIn('user_id', $teamLeadIds)->get();
        $deletedFolders = Folder::onlyTrashed()->whereIn('user_id', $teamLeadIds)->get();
        $userIdsWithDeletedItems = $deletedFiles->pluck('user_id')->merge($deletedFolders->pluck('user_id'))->unique();
        $usersWithDeletedItems = User::with('department')
            ->whereIn('id', $userIdsWithDeletedItems)
            ->get();
        return view('admin.pages.activity.teamlead_dele', compact('usersWithDeletedItems', 'deletedFiles', 'deletedFolders'));
    }
    // partcular team lead delete dash
    public function teamleadDeleteFileDash($id = null)
    {
        if ($id === null) {
            return redirect()->back()->withErrors('User ID is required.');
        }
        $trashedFolders = Folder::onlyTrashed()->where('user_id', $id)->get();
        return view('admin.pages.activity.teamlead.delete-dash', compact('id', 'trashedFolders'));
    }

    // team lead delete list 
    // $deletedFiles = File::onlyTrashed()->where('user_id', $id)->paginate(10);
    public function teamleadDeleteFileList($id = null)
    {
        $deletedFiles = File::onlyTrashed()
            ->where('user_id', $id)
            ->with(['user.department'])
            ->paginate(10);

        return view('admin.pages.activity.teamlead.file-list', compact('deletedFiles'));
    }


    // team lead file in folder lists 
    public function teamleadFileDeleteInFolder($folderId = null)
    {
        $folder = Folder::onlyTrashed()->find($folderId);
        if ($folder) {
            $folderName = $folder->slug;
            $originalFolderName = $folder->folder_name;
            $files = File::where('folder_id', $folderId)->with(['user.department'])->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }
        return view('admin.pages.activity.teamlead.folder-file-list', compact('folderId', 'folderName', 'files', 'originalFolderName'));
    }


    // ++++++++ member activity controller 
    public function memberDeleteFileDash($id = null)
    {
        if ($id === null) {
            return redirect()->back()->withErrors('User ID is required.');
        }
        $trashedFolders = Folder::onlyTrashed()->where('user_id', $id)->get();

        return view('admin.pages.activity.member.delete-dash', compact('id', 'trashedFolders'));
    }

    // file list by member 

    public function memberDeleteFileList($id = null)
    {
        // $deletedFiles = File::onlyTrashed()->where('user_id', $id)->get();

        $deletedFiles = File::onlyTrashed()
            ->where('user_id', $id)
            ->with(['user.department'])
            ->paginate(10);
        return view('admin.pages.activity.member.file-list', compact('deletedFiles'));
    }

    // files inside the folder list 
    public function memberFileDeleteInFolder($folderId = null)
    {
        $folder = Folder::onlyTrashed()->find($folderId);
        if ($folder) {
            $folderName = $folder->slug;
            $originalFolderName = $folder->folder_name;
            $files = File::where('folder_id', $folderId)->with(['user.department'])->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }
        return view('admin.pages.activity.member.folder-file-list', compact('folderId', 'folderName', 'files', 'originalFolderName'));
    }

    //  member show whoes delete the files
    public function memberDeleteFiles()
    {
        $teamLeadRole = '3';
        $teamLeadIds = User::where('role', $teamLeadRole)->pluck('id');
        $deletedFiles = File::onlyTrashed()->whereIn('user_id', $teamLeadIds)->get();
        $deletedFolders = Folder::onlyTrashed()->whereIn('user_id', $teamLeadIds)->get();
        $userIdsWithDeletedItems = $deletedFiles->pluck('user_id')->merge($deletedFolders->pluck('user_id'))->unique();
        $usersWithDeletedItems = User::with('department')
            ->whereIn('id', $userIdsWithDeletedItems)
            ->get();
        return view('admin.pages.activity.memberdele', compact('usersWithDeletedItems', 'deletedFiles', 'deletedFolders'));
    }

    // hard delete files 
    public function hardDeleteFileList($id = null)
    {
        $file = File::withTrashed()->find($id);
        if ($file) {
            $file->forceDelete();
            return redirect()->back()->with('success', 'File permanently deleted successfully');
        } else {
            return redirect()->back()->with('error', 'File not found');
        }
    }

    // hard delete the folder 

    public function hardDeleteFolders($id = null)
    {
        if ($id === null) {
            return redirect()->back()->withErrors('Folder ID is required.');
        }
        $folder = Folder::withTrashed()->findOrFail($id);

        try {
            $folder->forceDelete();
            return redirect()->back()->with('success', 'Folder permanently deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to delete the folder permanently.');
        }
    }

    // for members hard  delete 
    public function hardDeleteMembersFileList($id = null)
    {
        $file = File::withTrashed()->find($id);
        if ($file) {
            $file->forceDelete();
            return redirect()->back()->with('success', 'File permanently deleted successfully');
        } else {
            return redirect()->back()->with('error', 'File not found');
        }
    }

    // file delete inside the folder 
    public function hardDeleteMembersFoldersFile($fileId = null)
    {
        $file = File::withTrashed()->find($fileId);
        if ($file) {
            $file->forceDelete();
            return redirect()->back()->with('success', 'File permanently deleted successfully');
        } else {
            return redirect()->back()->with('error', 'File not found');
        }
    }

    // hard delete the folder 
    public function hardDeleteMembersFolders($id = null)
    {
        if ($id === null) {
            return redirect()->back()->withErrors('Folder ID is required.');
        }
        $folder = Folder::withTrashed()->findOrFail($id);

        try {
            $folder->forceDelete();
            return redirect()->back()->with('success', 'Folder permanently deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to delete the folder permanently.');
        }
    }
    // shared activity 
    public function sharedFoldersList()
    {
        // $sharedItems = Share::with(['userFrom', 'userTo', 'file', 'file.folder'])->get();
        $sharedItems = Share::with(['userFrom', 'userTo', 'file' => function ($query) {
            $query->whereNull('deleted_at')->with(['folder' => function ($query) {
                $query->whereNull('deleted_at');
            }]);
        }])->get();
        return view('admin.pages.activity.shared.shared-folder-liste', compact('sharedItems'));
    }

    public function sharedList()
    {
        $sharedItems = Share::with(['userFrom', 'userTo', 'file', 'file.folder'])->get();
        return view('admin.pages.activity.sharedlist', compact('sharedItems'));
    }

    // shared folder listing
    public function sharedFolderList($folderId = null)
    {
        $folder = Folder::find($folderId);
        if ($folder) {
            $folderName = $folder->slug;
            $originalFolderName = $folder->folder_name;
            $files = File::where('folder_id', $folderId)->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }
        return view('admin.pages.activity.teamlead.shared-folder-file-list', compact('folderId', 'folderName', 'files', 'originalFolderName'));
    }

    // shared files listing
    public function sharedFilesList()
    {
        $sharedItems = Share::with(['userFrom', 'userTo', 'file', 'file.folder'])->get();
        return view('admin.pages.activity.shared.shared-file-liste', compact('sharedItems'));
    }

    // shared files delete
    public function sharedFileDelete($shareToId = null)
    {
        if ($shareToId === null) {
            return redirect()->back()->with('error', 'Invalid ID provided');
        }
        $share = Share::where('id', $shareToId)->first();
        if ($share) {
            $share->delete();
            return redirect()->back()->with('success', 'Shared File is deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Record not found, file not deleted');
        }
    }

    // shared folder delete
    public function sharedFolderDelete(Request $request, $folderId)
    {
        $folderId = $request->input('folderId');
        $shareToId = $request->input('shareToId');

        // Assuming 'Share' model has a relationship to the 'File' model which has 'folder_id' field
        $files = Share::whereHas('file', function ($query) use ($folderId) {
            $query->where('folder_id', $folderId);
        })->where('share_to', $shareToId)->delete();
        if ($files) {
            return redirect()->back()->with('success', 'Shared folder deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Some error occur');
        }
    }
}
