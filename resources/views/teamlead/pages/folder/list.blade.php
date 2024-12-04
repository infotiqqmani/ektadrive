@extends('teamlead.layout.app')
@section('title', 'My Teams')
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

    <div class="content-wrapper overflow-auto">
        <div class="row">
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
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            $('#success-alert').fadeOut('slow');
                        }, 5000); // 5 seconds
                    </script>
                @endif
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h1 class="card-title pb-5 ">
                                My Department Team's
                            </h1>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th> Member Name </th>
                                    <th> Mail</th>
                                    <th> Mobile </th>
                                    <th> Depaertment </th>
                                    <th> Joining Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }} <i class="bi bi-arrow-down-short"></i></td>
                                        <td class="d-flex align-items-center">
                                            @if (Auth::check() && $user->profile_img && file_exists(public_path('profiles/' . $user->profile_img)))
                                                <img src="{{ asset('profiles/' . $user->profile_img) }}" alt="Profile Image"
                                                    class="img-fluid">
                                            @else
                                                <?php
                                                $name = Auth::user()->name;
                                                $initial = strtoupper(substr($name, 0, 1));
                                                ?>
                                                <div class="profile-initial bg-success"
                                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: #ccc; border-radius: 50%; font-size: 24px; color: #fff; margin-top:-7px; font-weight:700">
                                                    {{ $initial }}
                                                </div>
                                            @endif
                                            <span class="mx-2">{{ $user->name }}</span>
                                        </td>
                                        <td>
                                            <a class="text-decoration-none text-black d-block"
                                                href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>
                                            <a class="text-decoration-none text-black d-block"
                                                href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                        </td>
                                        <td>{{ $user->department->dept_name ?? '' }}</td>
                                        <td>{{ $user->created_at->format('d-M-Y') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-4 me-3">{{ $users->links('pagination::bootstrap-5') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
