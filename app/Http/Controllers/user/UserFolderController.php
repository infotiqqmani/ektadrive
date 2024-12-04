<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFolderController extends Controller
{
    //list of the folder
    public function folderIndex(Request $request,$folderId = null)
    {
        $id=$request->id!=''?$request->id:null;
        $folderName=Folder::where('id',$id)->first();
        $user = Auth::user();
        $folders = Folder::with('user')
            ->where('user_id', $user->id)
            ->where('parent_id',$id)
            ->orderBy('created_at', 'desc')
            ->get();
        // Fetch shared users for each folder
        $folder = Folder::find($folderId);
        $sharedUsers = $folder ? $folder->sharedUsers->pluck('id')->toArray() : [];
        $users = User::whereNotIn('role', ['1'])
            ->where('id', '!=', $user->id)
            ->get();
        // shared folder 


        return view('userpage.pages.folder.list', compact('folders', 'user', 'users', 'sharedUsers','folderName'));
    }


    public function subfolderlist(Request $request){
       
        $folders=Folder::where('parent_id',$request->id)->orderBy('id','DESC')->get();
       
        return view('userpage.pages.folder.folderlist',compact('folders'));
    }

    // inside folder file list 
    public function folderFileList($folderId = null)
    {

        $folder = Folder::find($folderId);
        $teamLead = auth()->user();
        $userName = $teamLead->name;
        $users = User::whereNotIn('role', ['1'])
            ->where('id', '!=', $teamLead->id)
            ->get();
        if ($folder) {
            $folderName = $folder->slug;
            $files = File::where('folder_id', $folderId)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $folderName = null;
            $files = collect();
        }

        return view('userpage.pages.folder.foler-file-list', compact('folderId', 'folderName', 'files', 'users', 'userName'));
    }



    // upload the larges files 

    public function storeFileInFolder(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx,mp4,avi,mp3,webp|max:1024000',
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

            $uploadedFiles[] = $uniqueFileName;
        }
        $successMessage = 'Files uploaded successfully: ';
        return redirect()->back()->with('success', $successMessage);
    }

    // add folder
    public function folderCreate()
    {
        $folderlist=Folder::orderBy('folder_name','ASC')->get();
        return view('userpage.pages.folder.add',compact('folderlist'));
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
            $folder->parent_id=$request->folderid;

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
            $folder->save();

            return redirect('user/folders/')->with('success', 'Folder created successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    //edit the folder

    public function editFolder($id = null)
    {
        $user = Folder::findOrFail($id);
        return view('userpage.pages.folder.edit', compact('user'));
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

                // No need to update the file record unless the filename changes, as only the folder path changes
            }

            $folder->save();

            return redirect('user/folders/')->with('success', 'Folder updated successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    // -- file delete inside the foler---
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
            return redirect('user/folders/')->with('success', 'delete successfully');
        } else {
            return redirect()->back()->with('error', 'not delete !');
        }
    }
}