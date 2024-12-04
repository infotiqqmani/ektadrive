@extends('teamlead.layout.app')
@section('title', 'Storage M')
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
        @if (session('status'))
            <div class="alert alert-{{ session('status')['type'] }}">
                {{ session('status')['message'] }}
            </div>
        @endif
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item d-flex gap-2" aria-current="page">
                        <h4>
                            Department -
                            </h3>
                            <h5 class="text-success">{{ $dept->dept_name }}</h5>
                    </li>
                </ul>
            </nav>
        </div>
        <div>
            <h3>Team Lead Dashboard</h3>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">
                            My Total Teams <i class="mdi mdi-microsoft-teams menu-icon mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-3">{{ $members }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">
                            My Total Files
                            <i class="mdi mdi-folder-account mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-3">{{ $teamLeadFolderCount + 1 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">
                            Total Shared file With Me
                            <i class="mdi mdi-share-all menu-icon mdi-24px float-end"></i>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="content-wrapper overflow-auto">
        <div>
            <h2>Team Lead Dashboard</h2>
        </div>
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
                                Team Lead Department Members
                            </h1>
                            <div class="d-flex">
                                <h4 class="px-3">Team Lead: </h4>
                                <h5 class="text-success">{{ $teamLead->name }}</h5>
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

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
