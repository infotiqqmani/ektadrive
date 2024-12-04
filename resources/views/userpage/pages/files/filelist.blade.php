@extends('userpage.layout.app')
@section('title', 'Storage M')
@section('content')
    <style>
        table thead tr th {
            background-color: #e91e63 !important;
            color: white !important;
            font-weight: 700;
        }

        td span {
            white-space: break-spaces;
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
                            <div>
                               
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> File name </th>
                                    <th>File Type</th>
                                    <th> File Created </th>
                                    {{-- <th> Folder Name</th> --}}
                                    <th> Created by </th>
                                    <th>Save File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($files as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <i class="mdi mdi-file-account-outline menu-icon"
                                                style="font-size: 20px;color:#e91e63"></i>
                                            <span>{{ $file->file_name }}</span>
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
                                        <td>{{ \Carbon\Carbon::parse($file->created_at)->setTimezone('Asia/Kolkata')->format('d M Y, h:i A') }}
                                        </td>
                                        <td>{{ $file->user->name }}</td>
                                        <td>
                                            <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                href="{{ asset('uploads/files/' . $file->file_name) }}" target="_blank"
                                                download>
                                                Download
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('user.delete-file', $file->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="text-end btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                    href="#"
                                                    data-file-url="{{ asset('uploads/files/' . $file->file_name) }}"
                                                    data-file-type="{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}">View</a>
                                                &nbsp;&nbsp;&nbsp;
                                                <button type="button"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-file-id="{{ $file->id }}">Share</button>
                                                &nbsp;&nbsp;&nbsp;
                                                <button type="submit"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none">Delete</button>

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
                        <div class="mt-4">
                            {{ $files->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  models for the preview images --}}
        <div style="height:100vh" class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileModalLabel">Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="imagePreview" src="" alt="Image" class="img-fluid d-none" style="height: 90vh;">
                        <iframe id="pdfPreview" src="" class="w-100 d-none" style="height: 90vh;"
                            frameborder="0"></iframe>
                        <video id="videoPreview" width="100%" height="auto" controls class="d-none">
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div id="otherPreview" class="d-none">
                            <p>Preview is not available for this file type.</p>
                            <a id="fileDownload" href="" class="btn btn-primary" download>Download File</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----for sharing modals---- --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.fileShare') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_id" id="file_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-danger">
                                            <label class="form-check-label">
                                                {{-- <input type="checkbox" id="selectAll" class="form-check-input" /> --}}
                                                <input type="checkbox" id="selectAll" class="form-check-input" />
                                                Select All
                                            </label>
                                        </div>
                                        @foreach ($users as $user)
                                            <div style="width: 40rem;" class="form-check d-flex">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="shareto[]" value="{{ $user->id }}"
                                                        class="form-check-input" />
                                                    {{ $user->name . ' - (' . $user->email . ')' }} &nbsp;
                                                </label>
                                                @if ($user->role == 2)
                                                    <span class="text-success">Team Lead
                                                    </span>
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
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var fileId = button.data('file-id'); // Extract info from data-* attributes
                    var modal = $(this);
                    modal.find('#file_id').val(fileId); // Set the value of the hidden input with file ID
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Handle the view button click
                $('.view-btn').on('click', function(e) {
                    e.preventDefault();
                    var fileUrl = $(this).data('file-url');
                    var fileType = $(this).data('file-type').toLowerCase();

                    // Hide all previews first
                    $('#imagePreview').addClass('d-none');
                    $('#pdfPreview').addClass('d-none');
                    $('#videoPreview').addClass('d-none');
                    $('#otherPreview').addClass('d-none');

                    if (fileType === 'png' || fileType === 'jpeg' || fileType === 'jpg' || fileType === 'gif') {
                        // Show image preview
                        $('#imagePreview').attr('src', fileUrl).removeClass('d-none');
                    } else if (fileType === 'pdf') {
                        // Show PDF preview
                        $('#pdfPreview').attr('src', fileUrl).removeClass('d-none');
                    } else if (fileType === 'mp4' || fileType === 'avi' || fileType === 'mkv') {
                        // Show video preview
                        $('#videoPreview source').attr('src', fileUrl);
                        $('#videoPreview')[0].load();
                        $('#videoPreview').removeClass('d-none');
                    } else {
                        // Show other file type preview
                        $('#otherPreview').removeClass('d-none');
                        $('#fileDownload').attr('href', fileUrl);
                    }

                    // Show the modal
                    $('#fileModal').modal('show');
                });
            });
        </script>
    @endsection
