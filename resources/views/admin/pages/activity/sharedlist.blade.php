@extends('admin::layout.app')
@section('title', 'users')
@section('admin::content')

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

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Shared files between Users</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th>Items</th>
                                    <th>Shared By</th>
                                    <th>Shared To</th>
                                    <th>Shared Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $iteration = 1;
                                @endphp
                                @foreach ($sharedItems as $item)
                                    <!-- Check if the item is a file and does not belong to any folder -->
                                    @if ($item->file && !$item->file->folder_id)
                                        <tr>
                                            <td>{{ $iteration++ }}</td>
                                            <td class="d-flex align-items-center">
                                                <i class="mdi mdi-file-document mdi-18px"></i>
                                                &nbsp;&nbsp;
                                                <span>{{ $item->file->file_name }}</span>
                                            </td>
                                            <td>{{ $item->userFrom->name }}</td>
                                            <td>{{ $item->userTo->name }}</td>
                                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="#">View</a> |
                                                <a href="#">Delete</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="mt-3 pe-4">
                        {{ $sharedItems->links('pagination::bootstrap-5') }}
                    </div> --}}
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
