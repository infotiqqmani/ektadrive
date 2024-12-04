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
                                My Folders
                            </h1>
                            {{-- <div>
                                <a class="btn btn-outline-danger redd bg-danger btn-fw text-white"
                                    href="{{ url('user/file/add/') }}">Choose New File </a>
                            </div> --}}
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> File name </th>
                                    <th>File Type</th>
                                    <th> File Created </th>
                                    <th> Created by </th>
                                    <th>Save File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deletedFiles as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <i class="mdi mdi-file-account-outline menu-icon"
                                                style="font-size: 20px;color:#e91e63"></i>
                                            {{ $file->file_name }}
                                        </td>
                                        <td>
                                            @if (in_array($file->extension, ['png', 'jpeg', 'jpg', 'gif']))
                                                Image File
                                            @elseif (in_array($file->extension, ['pdf']))
                                                PDF File
                                            @elseif (in_array($file->extension, ['doc', 'docx']))
                                                Word Document
                                            @elseif (in_array($file->extension, ['xls', 'xlsx']))
                                                Excel File
                                            @elseif (in_array($file->extension, ['mp4', 'avi', 'mkv']))
                                                Video File
                                            @else
                                                {{ ucfirst($file->extension) }} File
                                            @endif
                                        </td>
                                        <td>{{ $file->created_at->format('D-M-Y') }}</td>
                                        <td>{{ $file->user->name }}</td>
                                        <td>
                                            @if (in_array($file->extension, ['jpeg', 'png', 'jpg', 'gif']))
                                                <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                    href="{{ asset('storage/files/' . $file->file_name) }}" target="_blank"
                                                    download>
                                                    Download
                                                </a>
                                            @elseif (in_array($file->extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                                <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                    href="{{ asset('storage/files/' . $file->file_name) }}" target="_blank"
                                                    download>
                                                    Download
                                                </a>
                                            @elseif (in_array($file->extension, ['mp4', 'avi', 'mkv']))
                                                <video width="320" height="240" controls>
                                                    <source class="btn m-0 p-0 text-danger text-decoration-none"
                                                        src="{{ asset('path_to_your_storage/' . $file->file_name) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <a href="{{ url('teamlead/file/download/' . $file->id) }}"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none"
                                                    target="_blank">
                                                    Download
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('user.delete-file', $file->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none">Delete</button>
                                                &nbsp;&nbsp;&nbsp;


                                                {{-- <button type="button"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-file-id="{{ $file->id }}">Share</button> --}}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No files found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <div class="mt-4">
                            {{ $files->links('pagination::bootstrap-5') }}
                        </div> --}}
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
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var fileId = button.data('file-id'); // Extract info from data-* attributes
                    var modal = $(this);
                    modal.find('#file_id').val(fileId); // Set the value of the hidden input with file ID
                });
            });
        </script>
    @endsection
