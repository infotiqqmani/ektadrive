@extends('admin::layout.app')
@section('title', 'department')
@section('admin::content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update department</h4>
                        <form action="{{ url('admin/update-department/' . $data->dept_id) }}" method="POST"
                            class="forms-sample" id="userForm">
                            @csrf
                            @method('PUT')
                            <div class="d-flex row justify-content-between ">
                                <div class="col-md-6">
                                    @if ($data)
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Department Name</label>
                                            <input type="text" value="{{ $data->dept_name }}" class="form-control"
                                                name="name" value="" id="exampleInputUsername1"
                                                placeholder="Username" />
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">

                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">
                                Update
                            </button>
                            <a class="btn btn-light" href="{{ url('admin/dashboard/') }}">Cencel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
