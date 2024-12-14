<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFileController extends Controller
{
    public function fileList(Request $request)
    {
        $teamLead = auth()->user();


        $id=$request->id!=''?$request->id:null;
        $folderName=Folder::where('id',$id)->first();

        $users = User::whereNotIn('role', ['1'])
            ->where('id', '!=', $teamLead->id)
            ->get();
        $files = File::where('user_id', $teamLead->id)
            ->where('folder_id',$id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('userpage.pages.files.filelist', compact('files', 'teamLead', 'users', 'folderName'));
    }

    // ++++++++++user file creation++++++++++++
    public function fileCreate(Request $request)
    {
        $teamLead = auth()->user();

        $departmentId = $teamLead->dept_id;
        $folders = Folder::where('user_id', $teamLead->id)
            ->orWhereHas('user', function ($query) use ($departmentId) {
                $query->where('dept_id', $departmentId);
            })
            ->get();
        return view('userpage.pages.files.add', compact('folders'));
    }

    // public function storeFile(Request $request)
    // {
    //     $teamLead = auth()->user();
    //     $userName = $teamLead->name;

    //     $request->validate([
    //         'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx,xls,xlsx,mp4,avi,mp3|max:1024000', // Increased max size to 1GB
    //     ]);

    //     $folderId = $request->id!='' ? $request->id : null;


    //     foreach ($request->file('files') as $file) {
    //         $fileExtension = $file->getClientOriginalExtension(); // Get the file extension
    //         $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get the original file name without extension
    //         $slugName = Str::slug($userName, '-');
    //         $fileName = $slugName . '-' . time() . '-' . Str::slug($originalFileName, '-') . '.' . $fileExtension; // Create the filename with slug-username-time-originalfilename.extension

    //         // Check if the file already exists
    //         if (file_exists(public_path('uploads/files/' . $fileName))) {
    //             return back()->withErrors([$fileName . ' already exists.']);
    //         }

    //         // Store the file in the public/uploads/files directory
    //         $file->move(public_path('uploads/files'), $fileName);

    //         // Save file information in the database
    //         $store = new File();
    //         $store->file_name = $fileName;
    //         $store->extension = $fileExtension; // Store the file extension
    //         $store->folder_id = $folderId;
    //         $store->user_id = auth()->user()->id;

    //         if (!$store->save()) {
    //             // Rollback file upload if saving fails
    //             unlink(public_path('uploads/files/' . $fileName));
    //             return back()->withErrors(['Failed to save ' . $fileName . ' in the database.']);
    //         }
    //     }
    //     return redirect('user/files/list?id='.$folderId)->with('success', 'Files uploaded successfully.');
    // }

    public function storeFile(Request $request)
{
    $teamLead = auth()->user();
    $userName = $teamLead->name;

    // Validate files with allowed MIME types and file size limit
    $request->validate([
        'files.*' => 'required|file|mimes:jpeg,png,jpg,pdf,xls,xlsx|max:1024000', // Allow specific MIME types and 1GB max size
    ]);

    $folderId = $request->id != '' ? $request->id : null;

    try {
        foreach ($request->file('files') as $file) {
            // Perform additional security checks
            $fileExtension = strtolower($file->getClientOriginalExtension());
            $mimeType = $file->getMimeType();

            // Validate MIME type and file extension consistency
            $allowedMimeTypes = [
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'pdf' => 'application/pdf',
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            if (!isset($allowedMimeTypes[$fileExtension]) || $mimeType !== $allowedMimeTypes[$fileExtension]) {
                return back()->withErrors(['Invalid file type or MIME type mismatch for ' . $file->getClientOriginalName()]);
            }

            // Check for malicious content (optional, for advanced scenarios)
            // Example: Scan the file using third-party antivirus API (like ClamAV, if integrated)
            // Skipping this step for simplicity, but this is recommended in production.

            // Generate a secure file name
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($userName, '-');
            $fileName = $slugName . '-' . time() . '-' . Str::slug($originalFileName, '-') . '.' . $fileExtension;

            // Prevent overwriting an existing file
            if (file_exists(public_path('uploads/files/' . $fileName))) {
                return back()->withErrors([$fileName . ' already exists.']);
            }

            // Store the file securely
            $file->move(public_path('uploads/files'), $fileName);

            // Save file details to the database
            $store = new File();
            $store->file_name = $fileName;
            $store->extension = $fileExtension;
            $store->folder_id = $folderId;
            $store->user_id = auth()->user()->id;

            if (!$store->save()) {
                // Rollback if database save fails
                unlink(public_path('uploads/files/' . $fileName));
                return back()->withErrors(['Failed to save ' . $fileName . ' in the database.']);
            }
        }

        return redirect('user/files/list?id=' . $folderId)->with('success', 'Files uploaded successfully.');
    } catch (\Exception $e) {
        return back()->withErrors(['An error occurred while uploading files: ' . $e->getMessage()]);
    }
}


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
