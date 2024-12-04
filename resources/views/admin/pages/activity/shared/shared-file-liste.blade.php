@extends('admin::layout.app')
@section('title', 'users')
@section('admin::content')
    <div class="content-wrapper overflow-auto">

        <div class="row">
            <div>
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Shared files between Users</h4>
                            <i class="text-success mdi mdi-share-all mdi-24px pe-5"></i>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th>Items</th>
                                    <th>Shared By</th>
                                    <th>Shared To</th>
                                    <th>Shared Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $iteration = 1;
                                @endphp
                                @foreach ($sharedItems as $item)
                                    @if ($item->file && !$item->file->folder_id)
                                        <tr>
                                            <td>{{ $iteration++ }}</td>
                                            <td class="d-flex align-items-center">
                                                <i class="mdi mdi-file-document mdi-18px"></i>
                                                &nbsp;&nbsp;
                                                <span>{{ $item->file->file_name }}</span>
                                            </td>
                                            <td>{{ $item->userFrom->name }}</td>
                                            <td>{{ $item->userTo->name }}</td>
                                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                                            <td>
                                                {{-- <a class="text-end btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                    href="#"
                                                    data-image-url="{{ asset('storage/files/' . $item->file->file_name) }}">View</a> --}}


                                                <a class="text-end btn m-0 p-0 text-danger text-decoration-none view-btn"
                                                    href="#"
                                                    data-file-url="{{ asset('uploads/files/' . $item->file->file_name) }}"
                                                    data-file-type="{{ pathinfo($item->file->file_name, PATHINFO_EXTENSION) }}">View</a>

                                                <a class="text-end btn ms-3 p-0 text-danger text-decoration-none"
                                                    href="{{ url('admin/shared-file/delete/' . $item->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="mt-3 pe-4">
                        {{ $sharedItems->links('pagination::bootstrap-5') }}
                    </div> --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
            $('#error-alert').fadeOut('slow');
        }, 5000); // 5 seconds
    </script>

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
                    $('#videoPreview source').attr('src', fileUrl);
                    $('#videoPreview').removeClass('d-none')[0].load();
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
