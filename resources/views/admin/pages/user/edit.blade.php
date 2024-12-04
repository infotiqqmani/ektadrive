@extends('admin::layout.app')
@section('title', 'user')
@section('admin::content')
    <style>
        .redd {
            background-color: #e91e63 !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="row">
            <div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Member Details</h4>
                        <form action="{{ url('admin/user/update_user/' . $data->id) }}" method="POST" class="forms-sample"
                            id="userForm">
                            @csrf
                            @method('PUT')
                            <div class="d-flex row justify-content-between ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $data->name }}" id="exampleInputUsername1" placeholder="Username" />

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $data->email }}" id="exampleInputEmail1" placeholder="Email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mobile</label>
                                        <input type="text" maxlength="10" pattern="\d{10}" name="mobile"
                                            class="form-control" value="{{ $data->mobile }}" id="exampleInputPassword1"
                                            placeholder="Password" />
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Change Password (optional)</label>
                                        <input type="password" name="new_password" class="form-control"
                                            id="exampleInputConfirmPassword1" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1"> Confirm Password (optional)</label>
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            id="exampleInputConfirmPassword1" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Department</label>

                                        <select name="team" class="form-select form-select-lg"
                                            id="exampleFormControlSelect1">

                                            @forelse ($dept as $da)
                                                <option value="{{ $da->id }}"
                                                    {{ $da->id == $data->dept_id ? 'selected' : '' }}>{{ $da->dept_name }}
                                                </option>
                                            @empty
                                                <td>
                                                    No Information to Display
                                                </td>
                                            @endforelse

                                        </select>

                                    </div>

                                    <div class="form-group">

                                    </div>

                                    <div class="form-group">
                                        <div class="form-check form-check-danger">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="team_lead_checkbox"
                                                    {{ $data->team_lead == 1 ? 'checked' : '' }}
                                                    class="form-check-input" />
                                                Team Lead
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn redd text-white me-2">
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
<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
        $('#error-alert').fadeOut('slow');
    }, 5000); // 5 seconds
</script>
