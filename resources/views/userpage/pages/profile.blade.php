@extends('userpage.layout.app')

@section('title', 'myprofile')

@section('content')
    <style>
        #flash-message {
            transition: opacity 0.5s ease-in-out;
        }

        .redd {
            background-color: #e91e63 !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div id="flash-message" class="col-md-6 text-center">
                @if (session('status'))
                    <div id="flash-message" class="alert alert-{{ session('status')['type'] }}">
                        {{ session('status')['message'] }}
                    </div>
                @endif

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
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
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">User Profile</h2>
                            <form class="forms-sample" action="{{ route('user.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        id="exampleInputUsername1" placeholder="Username" />
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mobile</label>
                                    <input type="text" maxlength="10" pattern="\d{10}" name="mobile"
                                        value="{{ $user->mobile }}" class="form-control" id="exampleInputPassword1"
                                        placeholder="Number" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Profile Image</label>
                                    <input type="file" name="profile_img" value="{{ $user->profile_img }}"
                                        class="form-control" id="exampleInputPassword1" />
                                </div>
                                <button type="submit" class="btn redd text-white me-2">
                                    Update
                                </button>

                                <a class="btn btn-light" href="{{ route('user.dashboard') }}">
                                    Cancel
                                </a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Remove flash message after 3 seconds
        setTimeout(function() {
            document.getElementById('flash-message').remove();
        }, 3000);
    </script>

@endsection
