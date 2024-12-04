@extends('userpage.layout.app')
@section('title', 'user')

@section('content')
    <div class="content-wrapper overflow-auto">
        <div class="row">

            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">

                            <h3 class="pb-5 ">
                                User Dashboard
                            </h3>

                        </div>

                        <div class="d-flex justify-content-around">
                            <div class="d-flex">
                                <h4>Your Name: </h4>
                                <h5 class="text-bold ps-3">{{ $users->name }}</h5>
                            </div>
                            <div class="d-flex">
                                <h4>Your Department: </>
                                    <h5 class="text-bold ps-3">{{ $users->department->dept_name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
