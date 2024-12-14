<?php


use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DeptController;
use App\Http\Controllers\admin\UserActivityController;
use App\Http\Controllers\teamlead\FolderController;
use App\Http\Controllers\teamlead\TeamLeadController;
use App\Http\Controllers\user\UserFolderController;
use App\Http\Controllers\user\UserPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\teamlead\FileController;
use App\Http\Controllers\teamlead\MyTeamController;
use App\Http\Controllers\teamlead\TeamLeadFileShare;
use App\Http\Controllers\user\UserFileController;
use App\Http\Controllers\user\UserFileShare;


// =========login routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

});


Route::fallback(function () {
    return view('404');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth', 'role:1']], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');
        Route::any('/profile', [LoginController::class, 'edit'])->name('admin.profile');
        Route::any('/update', [LoginController::class, 'update'])->name('admin.update');
        // User management controller
        Route::get('/user', [UserController::class, 'user_index'])->name('admin.user');
        Route::any('/user/add', [UserController::class, 'add_user'])->name('admin.add-user');
        Route::any('/user/create', [UserController::class, 'user_create'])->name('admin.create_user');
        Route::any('/user/edit-user/{id?}', [UserController::class, 'edit_user'])->name('admin.edit-user');
        Route::any('/user/update_user/{id?}', [UserController::class, 'update_user'])->name('admin.update-user');
        Route::any('/user/delete-user/{id?}', [UserController::class, 'delete_user'])->name('admin.delete-user');
        Route::any('/user/update-status/{id?}', [UserController::class, 'status_update'])->name('admin.update-status');
        Route::get('/ajax/getTeamLead/{dept_id?}', [UserController::class, 'getTeamLead'])->name('admin.check_team_lead');

        // Department Management
        Route::any('/department', [DeptController::class, 'department_index'])->name('admin.department');
        Route::any('/add-department', [DeptController::class, 'add_department'])->name('admin.department-add');
        Route::any('/create-department', [DeptController::class, 'create_department'])->name('admin.department-create');
        Route::any('/delete-department/{id?}', [DeptController::class, 'delete_department'])->name('admin.department-delete');

        // Activity list of users
        Route::any('/activity', [UserActivityController::class, 'teamLead'])->name('delete.teamlead');
        Route::any('/activity/teamlead', [UserActivityController::class, 'teamleadDeleteFiles'])->name('admin.teamleadlist');
        Route::any('/activity/teamlead/deleted/{id}', [UserActivityController::class, 'teamleadDeleteFileDash']);
        Route::any('/activity/teamlead/delete-list/{id?}', [UserActivityController::class, 'teamleadDeleteFileList'])->name('admin.member.files.lists');
        Route::any('/activity/teamlead/deleted-folder-file/{id?}', [UserActivityController::class, 'teamleadFileDeleteInFolder'])->name('admin.member.files.list.folder');
        Route::any('/teamlead/file-list', [UserActivityController::class, 'teamleadFileList'])->name('admin.teamlead.filelist');

        // member activity
        Route::any('/activity/member', [UserActivityController::class, 'memberDeleteFiles'])->name('admin.memberlist');
        Route::any('/activity/member/delete/{id?}', [UserActivityController::class, 'memberDeleteFileDash'])->name('admin.member.files');
        Route::any('/activity/member/delete-list/{id?}', [UserActivityController::class, 'memberDeleteFileList'])->name('admin.member.files.list');
        Route::any('/activity/member/deleted-folder-file/{id?}', [UserActivityController::class, 'memberFileDeleteInFolder'])->name('admin.member.files.list.folderr');
        //shared files list
        Route::any('/activity/shared', [UserActivityController::class, 'sharedList'])->name('admin.shared');
        Route::any('/activity/shared/files', [UserActivityController::class, 'sharedFilesList']);
        Route::any('/activity/shared/folders', [UserActivityController::class, 'sharedFoldersList']);
        Route::any('/activity/shared/folder/list/{id?}', [UserActivityController::class, 'sharedFolderList'])->name('admin.shared.folder.file.list');

        // delete from the admin side
        Route::any('/activity/teamlead/delete/{id?}', [UserActivityController::class, 'hardDeleteFileList'])->name('admin.delete.files.list');
        Route::any('/activity/teamlead/folder/{id?}', [UserActivityController::class, 'hardDeleteFolders']);
        Route::any('/activity/teamlead/delete/folder-file/{id?}', [UserActivityController::class, 'hardDeleteMembersFoldersFile']);
        Route::any('/activity/members/delete/{id?}', [UserActivityController::class, 'hardDeleteMembersFileList'])->name('admin.delete.member.files.list');
        Route::any('/activity/members/folder/{id?}', [UserActivityController::class, 'hardDeleteMembersFolders']);

        // shared files and folders delete
        Route::any('/shared-file/delete/{id?}', [UserActivityController::class, 'sharedFileDelete'])->name('shared.delete-file');
        Route::any('/shared-folder/delete/{id?}', [UserActivityController::class, 'sharedFolderDelete'])->name('shared.delete-folder');
    });
});

// team leader routes
Route::group(['prefix' => 'teamlead'], function () {
    Route::group(['middleware' => ['auth', 'role:2']], function () {
        Route::get('/dashboard', [TeamLeadController::class, 'index'])->name('teamlead.dashboard');
        Route::get('/logout', [TeamLeadController::class, 'logout'])->name('teamlead.logout');
        Route::any('/profile', [TeamLeadController::class, 'edit'])->name('teamlead.profile');
        Route::any('/update', [TeamLeadController::class, 'ProfileUpdate'])->name('teamlead.update');
        Route::any('/teams', [MyTeamController::class, 'myTeams'])->name('teamlead.teams');

        // Folders related routes
        Route::any('/folder/file-list/{id?}', [FolderController::class, 'folderFileList'])->name('teamlead.folder.files');
        Route::any('folder/file/store', [FolderController::class, 'storeFileInFolder'])->name('teamlead.folder.file.store');
        Route::any('folder/file/add/{id}', [FolderController::class, 'folderInsideFile'])->name('teamlead.folder.file.add');
        Route::any('/folder/add', [FolderController::class, 'folderCreate'])->name('teamlead.add-folder');
        Route::any('/folder/store', [FolderController::class, 'folderStore'])->name('teamlead.store-folder');
        Route::any('/folder/edit/{id?}', [FolderController::class, 'editFolder'])->name('teamlead.edit-folder');
        Route::any('/folder/update/{id?}', [FolderController::class, 'folderUpdate'])->name('teamlead.update-folder');
        Route::any('/folder/delete/{id?}', [FolderController::class, 'folderDelete'])->name('teamlead.delete-folder');
        Route::any('/folder/file/delete/{id?}', [FolderController::class, 'deleteFileInFolder']);

        // Files related routes
        Route::any('/my-folders', [FileController::class, 'fileIndex'])->name('teamlead.folder');
        Route::any('/update-folder/{id?}', [FileController::class, 'fileIndex'])->name('teamlead.folder.update');
        Route::any('/files/list', [FileController::class, 'fileList'])->name('teamlead.files.list');
        Route::any('/file/add', [FileController::class, 'fileCreate'])->name('teamlead.add-files');
        Route::any('/file/store', [FileController::class, 'storeFile'])->name('teamlead.store-file');
        Route::any('/file/delete/{id?}', [FileController::class, 'deleteFile'])->name('teamlead.delete-file');

        //teamlead files and folders sharing routes
        Route::any('/shared', [TeamLeadFileShare::class, 'shared'])->name('shared.file');
        Route::any('/file/sharing', [TeamLeadFileShare::class, 'fileShare'])->name('leamlead.fileShare');
        Route::any('/folder/sharing', [TeamLeadFileShare::class, 'folderShare'])->name('leamlead.folderShare');
        Route::any('/shared-file-list', [TeamLeadFileShare::class, 'sharedFileList'])->name('shared.file.list');
        Route::any('/shared-folder-file-list/{id?}', [TeamLeadFileShare::class, 'sharedFolderFileList'])->name('shared.folder.filee');
    });
});
// users routes
Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth', 'role:3']], function () {
        Route::get('/dashboard', [UserPageController::class, 'index'])->name('user.dashboard');
        Route::get('/logout', [UserPageController::class, 'logout'])->name('user.logout');
        Route::any('/profile', [UserPageController::class, 'edit'])->name('user.profile');
        Route::any('/update', [UserPageController::class, 'ProfileUpdate'])->name('user.update');

        // folder creation with nested folder
        Route::any('/folders', [UserFolderController::class, 'folderIndex'])->name('user.folder');
        Route::any('/folder/add', [UserFolderController::class, 'folderCreate'])->name('user.add-folder');
        Route::any('/folder/store', [UserFolderController::class, 'folderStore'])->name('user.store-folder');
        Route::get('/folderlist', [UserFolderController::class, 'subfolderlist']);
        Route::any('/folder/edit/{id?}', [UserFolderController::class, 'editFolder'])->name('user.edit-folder');
        Route::any('/folder/update/{id?}', [UserFolderController::class, 'folderUpdate'])->name('user.update-folder');
        Route::any('/folder/delete/{id?}', [UserFolderController::class, 'folderDelete'])->name('user.delete-folder');
        Route::any('/folder/file-list/{id?}', [UserFolderController::class, 'folderFileList'])->name('user.folder.files');
        Route::any('folder/file/store', [UserFolderController::class, 'storeFileInFolder'])->name('user.folder.file.store');
        Route::any('/folder/file/delete/{id?}', [UserFolderController::class, 'deleteFileInFolder']);

        // files route
        Route::any('/files/list', [UserFileController::class, 'fileList'])->name('user.files.list');
        Route::any('/file/add', [UserFileController::class, 'fileCreate'])->name('user.add-files');
        Route::any('/file/store', [UserFileController::class, 'storeFile'])->name('user.store-file');
        Route::any('/file/delete/{id?}', [FileController::class, 'deleteFile'])->name('user.delete-file');

        // user files and folder sharing routes
        Route::any('/file/sharing', [UserFileShare::class, 'fileShare'])->name('user.fileShare');
        Route::any('/folder/sharing', [UserFileShare::class, 'folderShare'])->name('user.folderShare');
        Route::get('/getSharedUsers', [UserFileShare::class, 'getSharedUsers'])->name('user.getSharedUsers');
        Route::any('/shared', [UserFileShare::class, 'shared'])->name('shared.filee');
        Route::any('/shared-file-list', [UserFileShare::class, 'sharedFileList'])->name('shared.file.listt');
        Route::any('/shared-folder-file-list/{id?}', [UserFileShare::class, 'sharedFolderFileList'])->name('shared.folder.file');
        Route::any('/shared-folder-file/mail', [UserFileShare::class, 'sendFileMail'])->name('shared.folder.mail');
    });
});
