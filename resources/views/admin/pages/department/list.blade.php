@extends('admin::layout.app')
@section('title', 'department')
@section('admin::content')
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
            <div>
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div id="error-alert" class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-12 stretch-card">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h1 class="card-title pb-5 ">
                                Members List
                            </h1>
                            <div>
                                <a class="btn btn-outline-danger redd bg-primary btn-fw text-white"
                                    href="{{ url('admin/add-department/') }}">Add New
                                    Department</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead class="bg-success">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Department Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->dept_name }}</td>
                                        <td>
                                            <a href={{ url('admin/delete-department/' . $data->id) }}
                                                class="text-danger text-decoration-none"
                                                onclick="return confirm('Do you want to remove this ?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 me-4">{{ $datas->links('pagination::bootstrap-5') }}</div>
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
