@extends('teamlead.layout.app')
@section('title', 'Storage M')
@section('teamlead::content')
    <style>
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
                        <form action="{{ route('teamlead.store-file') }}" method="POST" class="forms-sample" id="userForm"
                            enctype="multipart/form-data" onsubmit="NProgress.start();">
                            @csrf
                            <input type="hidden" name="id" value="{{@$_GET['id']}}">
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">File Name :</label>
                                        <input type="file" name="files[]" class="form-control" id="file"
                                            placeholder="Select file" multiple required />

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
                            <a class="btn btn-light" href="{{ url('teamlead/folders/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
@endsection
