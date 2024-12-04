@extends('admin::layout.app')
@section('admin::content')
    <style>
        .redd {
            background-color: #e91e63 !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
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

                    <div class="card-body">
                        <h4 class="card-title">Fill Member Details</h4>
                        <form action="{{ route('admin.create_user') }}" method="POST" class="forms-sample" id="userForm">
                            @csrf
                            <div class="d-flex row justify-content-between">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" id="exampleInputUsername1" placeholder="Username" />
                                        @if ($errors->has('name'))
                                            <p class="text-danger">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="exampleInputEmail1" placeholder="Email" />
                                        @if ($errors->has('email'))
                                            <p class="text-danger">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mobile</label>
                                        <input type="text" maxlength="10" pattern="\d{10}" value="{{ old('mobile') }}"
                                            name="mobile" class="form-control" id="exampleInputPassword1"
                                            placeholder="Mobile" />
                                        @if ($errors->has('mobile'))
                                            <p class="text-danger">
                                                {{ $errors->first('mobile') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" />
                                        @if ($errors->has('password'))
                                            <p class="text-danger">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Department</label>
                                        <select class="form-select form-select-lg" name="team" id="departmentSelect">
                                            <option value="">Select Department</option>
                                            @foreach ($depts as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mt-20" id="teamLeadCheckbox" style="display: none;">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="team_lead_checkbox" class="form-check-input" />
                                                Team Lead
                                            </label>
                                        </div>
                                    </div>

                                    <div id="teamLeadInfo" style="display: none;">
                                        <div class="form-group d-flex">
                                            <h5 for="teamLeadName">Team Lead:</h5>
                                            <h5 class="ms-3 " id="teamLeadName"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn text-white redd me-2">Submit</button>
                            <a class="btn btn-light" href="{{ url('admin/dashboard/') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @endsection --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- disable the notification msg  --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
                let sessionErrorAlert = document.getElementById('session-error-alert');
                if (sessionErrorAlert) {
                    sessionErrorAlert.style.display = 'none';
                }
                let sessionSuccessAlert = document.getElementById('session-success-alert');
                if (sessionSuccessAlert) {
                    sessionSuccessAlert.style.display = 'none';
                }
            }, 4000);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#departmentSelect').change(function() {
                var deptId = $(this).val();
                if (deptId) {
                    $.ajax({
                        url: '/admin/ajax/getTeamLead/' + deptId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.team_lead) {
                                $('#teamLeadInfo').show();
                                $('#teamLeadName').text(data.team_lead.name);
                                $('#teamLeadCheckbox').hide();
                            } else {
                                $('#teamLeadInfo').hide();
                                $('#teamLeadCheckbox').show();
                            }
                        }
                    });
                } else {
                    $('#teamLeadInfo').hide();
                    $('#teamLeadCheckbox').hide();
                }
            });
        });
    </script>
@endsection
