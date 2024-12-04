@extends('userpage.layout.app')
@section('title', 'Storage M')
@section('content')
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
                                {{$folderName!=''?$folderName->folder_name:'My Drive'}}
                            </h1>
                           
                        </div>

                        <div class="row gap-4">
                            <div style="height: 4rem;" class="col-md-2 stretch-card">
                                <a href="{{ url('user/files/list?id='.@$_GET['id']) }}" class="card filebackground text-decoration-none text-white">
                                    <div class="px-2">
                                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                                            <i class="mdi mdi-file-account-outline px-2 mdi-24px"></i>
                                            <span class="mt-2">My Files</span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            @foreach ($folders as $folder)
                                <div style="height: 4rem;" class="btn-group rounded col-md-3">
                                    <a href="{{url('user/folders?id='.$folder->id)}}" class="btn p-2 filebackground">
                                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                                            <i class="mdi mdi-folder-account mdi-24px px-2 text-white"></i>
                                            <span>{{ $folder->folder_name }}</span>
                                        </span>
                                    </a>
                                    <button type="button" id="sendDataButton" style="border: none;"
                                        class="text-white filebackground dropdown-toggle dropdown-toggle-split p-3"
                                        data-bs-toggle="dropdown" aria-expanded="false" data-folder-id="{{ $folder->id }}">
                                        <span class="visually-hidden"></span>
                                    </button>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="btn p-2" href="{{ url('user/folder/edit/' . $folder->id) }}">Update Folder
                                                Name</a></li>
                                        <li><a class="btn p-2" href="{{ url('user/folder/delete/' . $folder->id) }}">Delete Folder</a>
                                        </li>
                                        <li>
                
                                        <li><button class="btn p-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-folder-id="{{ $folder->id }}">Share
                                                With</button></li>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    {{-- -----------modal for the sahring------ --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div style="width: 600px !important;" class="modal-dialog modal-fullscreen-sm-down">
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
                                        <div style="width: 30rem" class="form-check d-flex">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="shareto[]" value="{{ $user->id }}"
                                                    class="form-check-input" />
                                                {{ $user->name . ' - (' . $user->email . ')' }}
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectAll').click(function() {
                $('input[name="shareto[]"]').prop('checked', $(this).prop('checked'));
            });

            $('#exampleModal').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget);
                var fileId = button.data('folder-id');
                var modal = $(this);
                modal.find('#folder_id').val(fileId);
            });
        });
    </script>

@endsection
