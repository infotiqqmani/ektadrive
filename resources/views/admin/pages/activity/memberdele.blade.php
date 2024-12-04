@extends('admin::layout.app')
@section('title', 'users')
@section('admin::content')
    <style>
        table thead tr th {
            /* background-color: #e91e63 !important;

                                                                                                                                                color: white !important;
                                                                                                                                                font-weight: 700; */
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
                                Members List who Deleted Files
                            </h1>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> User Name </th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($usersWithDeletedItems as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }} <i class="bi bi-arrow-down-short"></i></td>

                                        <td class="d-flex align-items-center">
                                            <a href="{{ url('admin/activity/member/delete/' . $user->id) }}"
                                                class="d-flex align-items-center text-decoration-none text-black">
                                                @if ($user->profile_img && imageExists('public/' . $user->profile_img))
                                                    <img src="{{ asset('storage/' . $user->profile_img) }}"
                                                        alt="Profile Image" class="img-fluid"
                                                        style="width: 40px; height: 40px; border-radius: 50%;">
                                                @else
                                                    <?php
                                                    $name = $user->name;
                                                    $initial = strtoupper(substr($name, 0, 1));
                                                    ?>
                                                    <div class="profile-initial bg-success"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: #ccc; border-radius: 50%; font-size: 24px; color: #fff; margin-top:-7px; font-weight:700">
                                                        {{ $initial }}
                                                    </div>
                                                @endif
                                                <span class="mx-2">{{ $user->name }}</span>
                                            </a>
                                        </td>

                                        <td>{{ $user->department->dept_name ?? '' }}</td>

                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a class="text-decoration-none text-black d-block"
                                                href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                        </td>

                                        <td><a href="{{ url('admin/activity/member/delete/' . $user->id) }}"
                                                class=" btn p-0 m-0 text-decoration-none text-black">View
                                                Files</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

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
