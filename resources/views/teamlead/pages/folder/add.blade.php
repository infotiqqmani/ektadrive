@extends('teamlead.layout.app')
@section('title', 'folder')
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
                        <h4 class="card-title">Create Folder</h4>
                        <form action="{{ route('teamlead.store-folder') }}" method="POST" class="forms-sample"
                            id="userForm">
                            @csrf
                            <input type="hidden" name="folderid" value="{{@$_GET['id']}}">
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Folder Name :</label>
                                        <input type="text" name="folder_name" value="{{ old('folder_name') }}"
                                            class="form-control" id="exampleInputUsername1" placeholder="Folder name"
                                            required />
                                        @if ($errors->has('folder_name'))
                                            <p class="text-danger">
                                                {{ $errors->first('folder_name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-outline-danger redd bg-danger btn-fw text-white">Submit</button>
                            <a class="btn btn-light" href="{{ url('teamlead/dashboard/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
