@extends('teamlead.layout.app')
@section('title', 'folder')
@section('teamlead::content')
    <style>
        table thead tr th {
            background-color: #e91e63 !important;
            color: white !important;
            font-weight: 700;
        }

        .redd {
            background-color: #e91e63 !important;
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
                        <h4 class="card-title">Add Folder</h4>
                        <form action="{{ url('teamlead/folder/update/' . $user->id) }}" method="POST" class="forms-sample"
                            id="userForm">
                            @csrf @csrf
                            @method('PUT')
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Folder Name :</label>
                                        <input type="text" name="folder_name" value="{{ $user->folder_name }}"
                                            class="form-control" id="exampleInputUsername1" placeholder="Username"
                                            required />
                                        @if ($errors->has('folder_name'))
                                            <p class="text-danger">
                                                {{ $errors->first('folder_name') }}
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn text-white redd me-2">Submit</button>
                            <a class="btn btn-light" href="{{ url('teamlead/dashboard/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
