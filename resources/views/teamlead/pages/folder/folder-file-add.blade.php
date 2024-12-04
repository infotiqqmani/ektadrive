@extends('teamlead.layout.app')
@section('title', 'Storage M')
@section('teamlead::content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload File</h4>
                        <form action="{{ route('teamlead.folder.file.store') }}" method="POST" class="forms-sample"
                            id="userForm" enctype="multipart/form-data" onsubmit="NProgress.start();">
                            @csrf
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">File Name :</label>
                                        <input type="file" name="files[]" class="form-control" id="file"
                                            placeholder="Select file" multiple required />
                                        @if ($errors->has('file_name'))
                                            <p class="text-danger">
                                                {{ $errors->first('file_name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Folder</label>
                                        <input type="hidden" name="folder_id" class="form-control" id="file"
                                            placeholder="Select file" multiple required />
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-outline-danger redd bg-danger btn-fw text-white">Submit</button>
                            <a class="btn btn-light" href="{{ url('teamlead/files/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection
