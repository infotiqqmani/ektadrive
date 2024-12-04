<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\FileShareEmail;
use App\Models\File;
use App\Models\Folder;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class UserFileShare extends Controller
{
    public function fileShare(Request $request)
    {
        $request->validate([
            'file_id' => 'required|exists:files,id',
            'shareto' => 'required|array',
            'shareto.*' => 'exists:users,id',
        ]);

        $fileId = $request->file_id;
        $shareTo = $request->shareto;
        $shareFrom = auth()->id();
        $name = Auth::user()->name;

        $file = Folder::find($fileId);
        $fileName = $file ? $file->file_name : 'Unknown Folder';
        // Array to store email addresses
        $emails = [];
        // Iterate over each user ID in the shareTo array
        foreach ($shareTo as $userId) {
            // Find the user by ID
            $user = User::findOrFail($userId);
            // Add the user's email to the emails array
            $emails[] = $user->email;
        }
        // Try to share the file with the users
        try {
            foreach ($shareTo as $userId) {
                Share::create([
                    'share_to' => $userId,
                    'share_from' => $shareFrom,
                    'file_id' => $fileId,
                    'folder_id' => null
                ]);
                // $fileLink = route('shared.file.list');
                $fileLink = route('login');
                $user = User::findOrFail($userId);
                $user = User::findOrFail($userId);
                $toEmail = $user;
                $fileMessage =  'Dear Member,
                        I hope this message finds you well.
                        I wanted to let you know that I have shared a ' . $fileName .  ' folder with you. You can access it using the link below: ' . $fileLink . '     
                        If you have any questions or need further assistance, please feel free to reach out.
                        Best regards, ' . $name . '  ';
                $subject = $name . ' Share File With You';
                Mail::to($toEmail)->send(new FileShareEmail($fileMessage, $subject));
            }
            return redirect()->back()->with('success', 'File shared successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to share the file. Please try again.');
        }
    }

    public function folderShare(Request $request)
    {
        $request->validate([
            'folder_id' => 'required|exists:folders,id',
            'shareto' => 'required|array',
            'shareto.*' => 'exists:users,id',
        ]);
        $folderId = $request->folder_id;
        $shareTo = $request->shareto;
        $shareFrom = auth()->id();
        $files = File::where('folder_id', $folderId)->get();
        $fileIds = $files->pluck('id')->toArray();
        $name = Auth::user()->name;
        $folder = Folder::find($folderId);
        $folderName = $folder ? $folder->folder_name : 'Unknown Folder';
        if (empty($fileIds)) {
            return redirect()->back()->with('error', 'No files found in the specified folder.');
        }
        foreach ($shareTo as $userId) {
            $user = User::findOrFail($userId);
            $emails[] = $user->email;
        }
        try {
            foreach ($shareTo as $userId) {
                foreach ($fileIds as $fileId) {
                    Share::create([
                        'share_to' => $userId,
                        'share_from' => $shareFrom,
                        'file_id' => $fileId,
                        'folder_id' => $folderId,
                    ]);
                }
            }
            // $folderLink = route('shared.folder.file', [$folderId]);
            $folderLink = route('login');
            $user = User::findOrFail($userId);
            $toEmail = $user;
            $fileMessage = 'Dear Member,
                        I hope this message finds you well.
                        I wanted to let you know that I have shared a ' . $folderName .  ' folder with you. You can access it using the link below: ' . $folderLink . '         
                        If you have any questions or need further assistance, please feel free to reach out.
                        Best regards, ' . $name . '
                        
 ';
            $subject = $name . ' Share folder with you';
            $response = Mail::to($toEmail)->send(new FileShareEmail($fileMessage, $subject));
            return redirect()->back()->with('success', 'Folder and files shared successfully!');
        } catch (\Exception $e) {
            logger('Error sharing folder: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to share the folder. Please try again.');
        }
    }

    // ++++++++Shared function+++++++ and listing
    public function shared()
    {
        $userId = auth()->id();
        // Fetch folder_ids and names shared with the authenticated user
        $folders = DB::table('shares')
            ->join('folders', 'shares.folder_id', '=', 'folders.id')
            ->join('users', 'shares.share_from', '=', 'users.id')
            ->where('shares.share_to', $userId)
            ->whereNotNull('shares.folder_id')
            ->select('folders.id as folder_id', 'folders.folder_name as folder_name', 'users.name as shared_from_user', 'shares.created_at as shared_time')
            ->distinct()
            ->get();
        return view('userpage.pages.shared.shared', compact('folders'));
    }

    public function sharedFileList()
    {
        $userId = auth()->user()->id;
        $files = DB::table('files')
            ->join('shares', 'files.id', '=', 'shares.file_id')
            ->join('users', 'shares.share_from', '=', 'users.id')
            ->where('shares.share_to', $userId)
            ->select(
                'files.id as file_id',
                'files.file_name as file_name',
                'files.extension as extension',
                'shares.id as share_id',
                'shares.share_from',
                'shares.updated_at as shared_time',
                'users.name as shared_from_user'
            )
            ->whereNull('shares.folder_id')->orderBy('shares.created_at', 'desc')
            ->paginate(10);
        return view('userpage.pages.shared.shared-list', compact('files'));
    }


    public function sharedFolderFileList($folderId = null)
    {
        $folder = Folder::withTrashed()->find($folderId);
        if ($folder) {
            $folderName = $folder->slug;
            $originalName = $folder->folder_name;
            $files = File::withTrashed()->where('folder_id', $folderId)->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }
        return view('userpage.pages.shared.shared-filelist-in-folder', compact('folderId', 'folderName', 'files', 'originalName'));
    }

    // ----------------------
    public function getSharedUsers(Request $request)
    {
        $folderId = $request->query('folder_id');
        $sharedUsers = DB::table('folder_user')
            ->where('folder_id', $folderId)
            ->pluck('user_id')
            ->toArray();

        return response()->json(['sharedUserIds' => $sharedUsers]);
    }
}
