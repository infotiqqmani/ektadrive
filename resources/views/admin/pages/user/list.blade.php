@extends('admin::layout.app')
@section('title', 'users')
@section('admin::content')
    <style>
        table thead tr th {
            background-color: #e91e63 !important;
            /* color: #e91e63 !important; */
            color: white !important;
            font-weight: 700;
        }

        .redd {
            background-color: #e91e63 !important;
        }
    </style>
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
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h1 class="card-title pb-5 ">
                                User Member List
                            </h1>
                            <div>
                                <a class="btn btn-outline-danger redd bg-danger btn-fw text-white"
                                    href="{{ url('admin/user/add/') }}">Add New
                                    Member</a>
                                {{-- <button type="button" class="btn btn-outline-primary btn-fw">Primary</button> --}}
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Mobile</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }} <i class="bi bi-arrow-down-short"></i></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->department->dept_name ?? '' }} </td>
                                        @if ($user->team_lead == 1)
                                            <td class="text-success">Team Lead</td>
                                        @else
                                            <td>Member</td>
                                        @endif

                                        <td>
                                            <form method="POST"
                                                action="{{ url('admin/user/update-status/' . $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn m-0 p-0 {{ $user->status == '1' ? 'text-success' : 'text-danger ' }}">
                                                    {{ $user->status == '1' ? 'Active' : 'suspended' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/user/edit-user/' . $user->id) }}"
                                                class=" btn  m-0 p-0 text-primary text-decoration-none">Edit</a>
                                            <a href="{{ url('admin/user/delete-user/' . $user->id) }}"
                                                class=" btn m-0 p-0 text-danger text-decoration-none"
                                                onclick="return confirm('Do you want to remove this ?') ">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-4 me-3">{{ $users->links('pagination::bootstrap-5') }}</div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    <script>
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
            $('#error-alert').fadeOut('slow');
        }, 5000); // 5 seconds
    </script>
