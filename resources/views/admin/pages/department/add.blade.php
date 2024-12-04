@extends('admin::layout.app')
@section('title', 'department')
@section('admin::content')
    <div class="content-wrapper">
        <div class="row">
            <div>
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success">
                        {{ session('success') }}
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
                        }, 5000);
                    </script>
                @endif
            </div>

            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">


                        <form action="{{ route('admin.department-create') }}" method="POST" class="forms-sample"
                            id="userForm">
                            @csrf
                            <div class="d-flex row justify-content-between ">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputUsername1">Department Name : </label>
                                    <input type="text" name="name" required class="form-control"
                                        id="exampleInputUsername1" placeholder="Department name" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">
                                Submit
                            </button>
                            <a class="btn btn-light" href="{{ url('admin/dashboard/') }}">Cencel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
        $('#error-alert').fadeOut('slow');
    }, 5000);
</script>
