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

        /* Additional style for progress bar */
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
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div>
                        @if ($errors->any())
                            <div class="alert alert-danger" id="error-alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
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
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Upload File</h4>
                        <form action="{{ route('user.store-file') }}" method="POST" class="forms-sample" id="userForm"
                            enctype="multipart/form-data" onsubmit="NProgress.start();">
                            @csrf
                            <input type="hidden" name="id" value="{{@$_GET['id']}}">
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">File Name :</label>
                                        <input type="file" name="files[]" class="form-control" id="file"
                                            placeholder="Select file" multiple required />
                                        <div class="progress bg-success mt-2" style="display: none;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="progress-text" class="mt-2"></div>
                                        @if ($errors->has('file_name'))
                                            <p class="text-danger">
                                                {{ $errors->first('file_name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-outline-danger redd bg-danger btn-fw text-white">Submit</button>
                            <a class="btn btn-light" href="{{ url('user/folders/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('#file').change(function() {
            var files = $(this)[0].files;
            var totalSize = 0;
            for (var i = 0; i < files.length; i++) {

                totalSize += files[i].size;
            }
            var maxSize = 1024000 * 50; // 50GB in KB
            if (totalSize > maxSize) {

                alert('Total file size exceeds the limit of 50GB.');
                $(this).val(''); // Clear file input
                return;
            }
            $('.progress').show();
            $('#progress-text').text('0%');
            var progress = 0;
            var uploadInterval = setInterval(function() {
                progress++;
                console.log("sajhasj")
                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                $('#progress-text').text(progress + '%');
                if (progress == 100) {
                    clearInterval(uploadInterval);
                    $('#progress-text').text('Upload Complete');
                    setTimeout(function() {
                        $('.progress').hide();
                        $('#progress-text').text('');
                    }, 1000); // Hide progress bar after 1 second
                }
            }, 1000); // Update progress every 1 second
        });
    });
</script> --}}
