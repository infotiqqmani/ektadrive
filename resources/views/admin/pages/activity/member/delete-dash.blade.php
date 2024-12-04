@extends('admin.layout.app')
@section('title', 'Storage M')
@section('admin::content')
    <style>
        table thead tr th {
            background-color: #e91e63 !important;
            color: white !important;
            font-weight: 700;
        }

        .redd {
            background-color: #e91e63 !important;
        }

        .filebackground {
            background-color: #636363 !important;
        }
    </style>

    <div class="content-wrapper overflow-auto">
        <div class="row">
            <div>
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            $('#error-alert').fadeOut('slow');
                        }, 5000); // 5 seconds
                    </script>
                @endif
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            $('#success-alert').fadeOut('slow');
                        }, 5000); // 5 seconds
                    </script>
                @endif
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title pb-5 ">
                                Member Deletd files
                            </h1>
                            {{-- <div>
                                <a class="btn btn-outline-danger redd bg-danger btn-fw text-white"
                                    href="{{ url('user/folder/add/') }}">Create New Folder</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gap-4">
            <div style="height: 4rem;" class="col-md-3 stretch-card">
                <a href="{{ url('admin/activity/member/delete-list/' . $id) }}"
                    class="card filebackground text-decoration-none text-white">
                    <div class="px-2">
                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                            <i class="mdi mdi-file-account-outline px-2 mdi-24px"></i>
                            <span class="mt-2">Files Deleted</span>
                        </span>
                    </div>
                </a>
            </div>
            @foreach ($trashedFolders as $folder)
                <div style="height: 4rem;" class="btn-group rounded col-md-3">
                    <a href="{{ url('admin/activity/member/deleted-folder-file/' . $folder->id) }}"
                        class="btn p-2 filebackground">
                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                            <i class="mdi mdi-folder-account mdi-24px px-2 text-white"></i>
                            <span>{{ $folder->folder_name }}</span>
                        </span>
                    </a>
                    <button type="button" style="border: none;"
                        class="text-white filebackground dropdown-toggle dropdown-toggle-split p-3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden"></span>
                    </button>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="btn p-2" href="{{ url('user/folder/edit/' . $folder->id) }}">Update Folder
                                Name</a></li> --}}
                        <li><a class="btn p-2" href="{{ url('admin/activity/members/folder/' . $folder->id) }}">Delete
                                Folder</a>
                        </li>
                        <li>

                            {{-- <li><button class="btn p-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-folder-id="{{ $folder->id }}">Share
                                With</button></li>
                        </li> --}}
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    {{-- -----------modal for the sahring------ --}}
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.folderShare') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="folder_id" id="folder_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                           
                                            <input type="checkbox" id="selectAll" class="form-check-input" />
                                            Select All
                                        </label>
                                    </div>
                                    @foreach ($users as $user)
                                        <div class="form-check d-flex gap-3 nowrap">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="shareto[]" value="{{ $user->id }}"
                                                    class="form-check-input" />
                                                {{ $user->name }}
                                            </label>
                                            @if ($user->role == 2)
                                                <label class="text-success ms-4">Team Lead</label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Share</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectAll').click(function() {
                $('input[name="shareto[]"]').prop('checked', $(this).prop('checked'));
            });

            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var fileId = button.data('folder-id'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('#folder_id').val(fileId); // Set the value of the hidden input with file ID

            });
        });
    </script>
@endsection
