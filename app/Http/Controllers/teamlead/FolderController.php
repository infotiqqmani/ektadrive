<?php

namespace App\Http\Controllers\teamlead;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FolderController extends Controller
{
    public function folderIndex()
    {
        
        $user = Auth::user();
        if ($user->role == '2') {
            $departmentId = $user->dept_id;
            $folders = Folder::with('user')
                ->whereHas('user', function ($query) use ($departmentId) {
                    $query->where('dept_id', $departmentId);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $folders = collect();
        }

        return view('teamlead.pages.folder.list', compact('folders', 'user'));
    }

    public function folderFileList($folderId = null)
    {
        $teamLead = auth()->user();
        $userName = $teamLead->name;

        $departmentId = $teamLead->dept_id;
        $users = User::where('dept_id', $departmentId)
            ->whereIn('role', ['3'])
            ->get();
        $folder = Folder::find($folderId);
        if ($folder) {
            $folderName = $folder->slug;
            $originalFolder = $folder->folder_name;
            $files = File::where('folder_id', $folderId)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }

        return view('teamlead.pages.folder.folder-file-list', compact('folderId', 'folderName', 'files', 'users', 'userName', 'originalFolder'));
    }

    // Folder create 
    public function folderCreate()
    {
        return view('teamlead.pages.folder.add');
    }
    public function folderStore(Request $request)
    {
      
        try {
            $request->validate([
                'folder_name' => 'required|string|max:255',
            ]);

            $existingFolder = Folder::where('folder_name', $request->folder_name)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingFolder) {
                return redirect()->back()->with('error', 'Folder with this name already exists. Please choose a different name.')->withInput();
            }

            // Create a new folder instance
            $folder = new Folder();
            $folder->folder_name = $request->input('folder_name');

            // Generate a unique slug from the folder name
            $slug = Str::slug($request->input('folder_name'), '-');

            // Ensure the slug is unique by appending a number if necessary
            $originalSlug = $slug;
            $counter = 1;
            while (Folder::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $folder->slug = $slug;
            $folder->user_id = Auth::id();
            $folder->parent_id=$request->folderid;
            $folder->save();

            return redirect('teamlead/my-folders/?id='.$request->folderid)->with('success', 'Folder created successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    // edit folder 

    public function editFolder($id = null)
    {
        $user = Folder::findOrFail($id);

        return view('teamlead.pages.folder.edit', compact('user'));
    }

    public function folderUpdate(Request $request, $id = null)
    {

        try {
            $request->validate([
                'folder_name' => 'required|string|max:255',
            ]);

            $folder = Folder::findOrFail($id);
            $oldFolderName = $folder->folder_name;
            $newFolderName = $request->input('folder_name');

            // Generate slug from updated folder name
            $slug = Str::slug($newFolderName, '-');

            // Check if a folder with the same slug exists for the current user
            $existingFolder = Folder::where('slug', $slug)
                ->where('user_id', Auth::id())
                ->where('id', '!=', $folder->id) // Exclude the current folder
                ->first();

            if ($existingFolder) {
                return redirect()->back()->with('error', 'Folder with this name already exists. Please choose a different name.')->withInput();
            }

            $folder->slug = $slug;
            $folder->folder_name = $newFolderName;
            $folder->user_id = auth()->id();

            // Rename the directory
            $oldFolderPath = public_path('uploads/' . Str::slug($oldFolderName, '-'));
            $newFolderPath = public_path('uploads/' . $slug);

            if (file_exists($oldFolderPath)) {
                rename($oldFolderPath, $newFolderPath);
            }

            // Update file paths in the database
            $files = File::where('folder_id', $folder->id)->get();
            foreach ($files as $file) {
                $oldFilePath = public_path('uploads/' . Str::slug($oldFolderName, '-') . '/' . $file->file_name);
                $newFilePath = public_path('uploads/' . $slug . '/' . $file->file_name);

                if (file_exists($oldFilePath)) {
                    rename($oldFilePath, $newFilePath);
                }
            }

            $folder->save();

            return redirect('teamlead/my-folders/')->with('success', 'Folder updated successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    // ++++++++file upload inside the folder++++++++++

    public function folderInsideFile(Request $request)
    {
        return view('teamlead.pages.folder.folder-file-add');
    }

    public function storeFileInFolder(Request $request)
    {
        try {
            $request->validate([
                'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx,mp4,avi,mp3,webp|max:1024000', // Increased max size to 1GB
            ]);

            $folder = Folder::findOrFail($request->folder_id);
            $folderName = $folder->folder_name;
            $slugFolderName = Str::slug($folderName, '-');
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                $fileExtension = $file->getClientOriginalExtension();
                $uniqueFileName = time() . '-' . uniqid() . '-' . $file->getClientOriginalName();

                $folderPath = 'uploads/' . $slugFolderName . '/';

                // Check if the file already exists
                if (file_exists(public_path($folderPath . $uniqueFileName))) {
                    return back()->withErrors([$uniqueFileName . ' already exists.']);
                }

                // Store the file in the public/uploads/folderName directory
                $file->move(public_path($folderPath), $uniqueFileName);

                // Save file information in the database
                $fileRecord = new File();
                $fileRecord->file_name = $uniqueFileName;
                $fileRecord->extension = $fileExtension;
                $fileRecord->folder_id = $request->folder_id;
                $fileRecord->user_id = auth()->user()->id;

                if (!$fileRecord->save()) {
                    // Rollback file upload if saving fails
                    unlink(public_path($folderPath . $uniqueFileName));
                    return back()->withErrors(['Failed to save ' . $uniqueFileName . ' in the database.']);
                }
            }

            $successMessage = 'Files uploaded successfully: ';
            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            return back()->withErrors(['An error occurred while uploading files: ' . $e->getMessage()]);
        }
    }


    // --file delete method inside the folder----
    public function deleteFileInFolder(Request $request, $id = null)
    {
        $delete = File::findOrFail($id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'file delete successfully');
        } else {
            return redirect()->back()->withErrors('error', 'Not deleted file');
        }
    }



    // delete folder 
    public function folderDelete($id = null)
    {
        $folder = Folder::findOrFail($id)->delete();
        if ($folder) {
            return redirect()->back()->with('success', 'delete successfully');
        } else {
            return redirect()->back()->with('error', 'not delete !');
        }
    }
}
