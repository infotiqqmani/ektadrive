<?php

namespace App\Http\Controllers\teamlead;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // list the files
    public function fileIndex(Request $request)
    {
        $id=$request->id!=''?$request->id:null;
        $teamLead = auth()->user();
        $departmentId = $teamLead->dept_id;
        $files = File::where('user_id', $teamLead->id)
            ->orWhereHas('user', function ($query) use ($departmentId) {
                $query->where('dept_id', $departmentId);
            })
            ->with('folder', 'user')
            ->get();
        // ------- all folder show 

        $user = Auth::user();
        $users = User::where('dept_id', $departmentId)
            // ->whereNotIn('id', [$teamLead->id])
            ->whereIn('role', ['3'])
            ->get();
        if ($user->role == '2') {
            $folders = Folder::with('user')
                ->where('user_id', $user->id)
                ->where('parent_id',$id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $folders = collect();
        }
        $folder=Folder::where('id',$id)->first();
        return view('teamlead.pages.files.list', compact('files', 'folders', 'users','folder'));
    }

    // file list 
    public function fileList(Request $request)
    {
        $id=$request->id!=''?$request->id:null;
        $teamLead = auth()->user();
        $departmentId = $teamLead->dept_id;
        $userName = $teamLead->name;

        $users = User::where('dept_id', $departmentId)
            ->whereIn('role', ['3'])
            ->get();
        $files = File::where('user_id', $teamLead->id)
            ->where('folder_id',$id) // Files not belonging to any folder
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $folder=Folder::where('id',$id)->first();
        return view('teamlead.pages.files.fileslist', compact('files', 'users', 'userName','folder'));
    }

    // create the files
    public function fileCreate(Request $request)
    {
        $teamLead = auth()->user();
        $departmentId = $teamLead->dept_id;
        $folders = Folder::where('user_id', $teamLead->id)
            ->orWhereHas('user', function ($query) use ($departmentId) {
                $query->where('dept_id', $departmentId);
            })
            ->get();
        return view('teamlead.pages.files.add', compact('folders'));
    }

    public function storeFile(Request $request)
    {
        $teamLead = auth()->user();
        $userName = $teamLead->name;

        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx,mp4,avi,webp,mp3|max:1024000',
        ]);

        $folderId = $request->id !='' ? $request->id : null;
        

        try {
            foreach ($request->file('files') as $file) {
                $fileExtension = $file->getClientOriginalExtension(); // Get the file extension
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get the original file name without extension
                $slugName = Str::slug($userName, '-');
                $fileName = $slugName . '-' . time() . '-' . Str::slug($originalFileName, '-') . '.' . $fileExtension; // Create the filename with slug-username-time-originalfilename.extension

                // Check if the file already exists
                if (file_exists(public_path('uploads/files/' . $fileName))) {
                    return back()->withErrors([$fileName . ' already exists.']);
                }

                // Store the file in the public/uploads/files directory
                $file->move(public_path('uploads/files'), $fileName);

                // Save file information in the database
                $store = new File();
                $store->file_name = $fileName;
                $store->extension = $fileExtension; // Store the file extension
                $store->folder_id = $folderId;
                $store->user_id = auth()->user()->id;

                if (!$store->save()) {
                    // Rollback file upload if saving fails
                    unlink(public_path('uploads/files/' . $fileName));
                    return back()->withErrors(['Failed to save ' . $fileName . ' in the database.']);
                }
            }
            return redirect('teamlead/files/list?id='.$folderId)->with('success', 'Files uploaded successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['An error occurred while uploading files: ' . $e->getMessage()]);
        }
    }



    // =============delete===========
    public function deleteFile(Request $request, $id = null)
    {
        $delete = File::findOrFail($id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'delete successfully');
        } else {
            return redirect()->back()->withErrors('error', 'Not deleted file');
        }
    }
}
