@extends('userpage.layout.app')
@section('title', 'Storage M')
@section('content')
    <style>
        .redd {
            background-color: #e91e63 !important;
        }

        .filebackground {
            background-color: #636363 !important;
        }

        .video-preview {
            width: 320px;
            height: 240px;
            object-fit: cover;
        }

        /* progress bar  */
        #nprogress .bar {
            height: 7px;
            background-color: green;
        }

        /* Style the percentage text */
        #nprogress .percentage {
            position: fixed;
            top: 0;
            right: 50%;
            transform: translateX(50%);
            color: #fff;
            font-size: 16px;
            z-index: 1031;
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
                                My Folder </span>
                            </h1>
                            <div class="col-md-6">

                               
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>name </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($folders as $index => $folder)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{$folder['folder_name']}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ url('user/folder/file-list/' . $folder->id.'?id='.$folder->id) }}">Upload Files</a>
                                            <a class="btn btn-sm btn-primary" href="{{ url('user/folderlist?id='.$folder->id) }}">View Folder</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Data found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection
