@extends('userpage.layout.app')
@section('title', 'shared file')
@section('content')
    <style>
        td span {
            white-space: break-spaces;
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
                                Shared Files with me
                            </h1>

                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> File name </th>
                                    <th>File Type</th>
                                    <th> Shared_at</th>
                                    {{-- <th> Folder Name</th> --}}
                                    <th>Shared by </th>
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
                                            <span> {{ $file->file_name }}</span>
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

                                        <td>{{ \Carbon\Carbon::parse($file->shared_time)->timezone('Asia/Kolkata')->format('d M Y, h:i A') }}
                                        </td>



                                        <td>{{ $file->shared_from_user }}</td>
                                        <td>
                                            @if (in_array($file->extension, ['jpeg', 'png', 'jpg', 'gif']))
                                                <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                    href="{{ asset('uploads/files/' . $file->file_name) }}" target="_blank"
                                                    download>
                                                    Download
                                                </a>
                                            @elseif (in_array($file->extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx']))
                                                <a class="btn m-0 p-0 text-danger text-decoration-none"
                                                    href="{{ asset('uploads/files/' . $file->file_name) }}" target="_blank"
                                                    download>
                                                    Download
                                                </a>
                                            @elseif (in_array($file->extension, ['mp4', 'avi', 'mkv']))
                                                <a class="btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                    href="#"
                                                    data-file-url="{{ asset('uploads/files/' . $file->file_name) }}"
                                                    data-file-type="{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}">View</a>
                                            @else
                                                <a href="{{ url('teamlead/file/download/' . $file->id) }}"
                                                    class="text-end btn m-0 p-0 text-danger text-decoration-none"
                                                    target="_blank">
                                                    Download
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="text-end btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                href="#"
                                                data-file-url="{{ asset('uploads/files/' . $file->file_name) }}"
                                                data-file-type="{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}">View</a>
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

            <div style="height:100vh" class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fileModalLabel">Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="imagePreview" src="" alt="Image" class="img-fluid d-none"
                                style="height: 90vh;">
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
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle the view button click
            $('.view-btn').on('click', function(e) {
                e.preventDefault();
                var fileUrl = $(this).data('file-url');
                var fileType = $(this).data('file-type');
                // Reset previews
                $('#imagePreview').addClass('d-none');
                $('#pdfPreview').addClass('d-none');
                $('#videoPreview').addClass('d-none');
                $('#otherPreview').addClass('d-none');
                if (fileType.match(/(jpg|jpeg|png|gif)$/i)) {
                    $('#imagePreview').attr('src', fileUrl).removeClass('d-none');
                } else if (fileType.match(/(pdf)$/i)) {
                    $('#pdfPreview').attr('src', fileUrl).removeClass('d-none');
                } else if (fileType.match(/(mp4|avi|mkv)$/i)) {
                    // Display video as a list item
                    var videoListItem = '<li><video width="320" height="240" controls><source src="' +
                        fileUrl +
                        '" type="video/mp4">Your browser does not support the video tag.</video></li>';
                    $('#otherPreview').html('<ul>' + videoListItem + '</ul>').removeClass('d-none');
                } else if (fileType.match(/(doc|docx|xls|xlsx)$/i)) {
                    $('#fileDownload').attr('href', fileUrl);
                    $('#otherPreview').removeClass('d-none');
                } else {
                    // For unsupported file types
                    $('#fileDownload').attr('href', fileUrl);
                    $('#otherPreview').removeClass('d-none');
                }
                // Show the modal
                $('#fileModal').modal('show');
            });
        });
    </script>
