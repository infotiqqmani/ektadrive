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
                                All Files and Folders Shared With Me
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
                <a href="{{ url('user/shared-file-list/') }}" class="card filebackground text-decoration-none text-white">
                    <div class="px-2">
                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                            <i class="mdi mdi-file-account-outline px-2 mdi-24px"></i>
                            <span class="mt-2">Files Shared</span>
                        </span>
                    </div>
                </a>
            </div>
            @foreach ($folders as $folder)
                <div style="height: 4rem;" class="btn-group rounded col-md-3">
                    <a href="{{ url('user/shared-folder-file-list/' . $folder->folder_id) }}"
                        class="btn p-2 filebackground">
                        <span class="text-nowrap text-white d-flex align-items-center mt-2">
                            <i class="mdi mdi-folder-account mdi-24px px-2 text-white"></i>
                            <span>{{ $folder->folder_name }}</span>
                        </span>
                    </a>
                    {{-- <button type="button" style="border: none;"
                        class="text-white filebackground dropdown-toggle dropdown-toggle-split p-3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden"></span>
                    </button> --}}
                    {{-- <ul class="dropdown-menu">

                        <li><a class="btn p-2" href="{{ url('user/shared-folder/delete/' . $folder->folder_id) }}">Delete
                                Folder</a>

                        </li>

                    </ul> --}}
                </div>
            @endforeach
        </div>
    </div>


@endsection
