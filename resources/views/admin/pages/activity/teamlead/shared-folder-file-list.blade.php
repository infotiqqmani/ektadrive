@extends('admin.layout.app')
@section('title', 'Storage M')
@section('admin::content')
    {{-- <style>
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
    </style> --}}

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
                                Folder Name - <span>{{ $folderName }}</span>
                            </h1>
                            <div>
                                <i class="text-success mdi mdi-share-all mdi-24px"></i>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> File name </th>
                                    <th>File Type</th>
                                    <th> File Created </th>
                                    <th> Created by </th>
                                    <th>Save</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($files as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <i class="mdi mdi-file-account-outline menu-icon"
                                                style="font-size: 20px;color:#e91e63">
                                            </i><span>{{ $file->file_name }}</span>
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
                                            <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                href="{{ asset('uploads/' . $folderName . '/' . $file->file_name) }}"
                                                target="_blank" download>
                                                Download
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ url('admin/activity/teamlead/delete/' . $file->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none">Delete</button>
                                                &nbsp;&nbsp;&nbsp;

                                                <a class="text-end btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                    href="#"
                                                    data-image-url="{{ asset('uploads/' . $folderName . '/' . $file->file_name) }}">View</a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No files found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="mt-4">{{ $files->links('pagination::bootstrap-5') }}</div>
                    </div>
                </div>
            </div>
            <div style="height:100vh" class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img style="height: 90vh;" id="imagePreview" src="" alt="Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-btn').on('click', function() {
                var imageUrl = $(this).data('image-url');
                $('#imagePreview').attr('src', imageUrl);
                $('#imageModal').modal('show');
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
