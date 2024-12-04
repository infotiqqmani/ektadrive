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
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Shared files between Users</h4>
                            <i class="text-success mdi mdi-share-all mdi-24px pe-5"></i>
                        </div>
                        <table class="table table-striped">
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
                                    $printedFolders = [];
                                @endphp
                                @foreach ($sharedItems as $item)
                                    @if ($item->file && $item->file->folder)
                                        @php
                                            $folderId = $item->file->folder_id;
                                        @endphp

                                        @if (!isset($printedFolders[$folderId]))
                                            @php
                                                $printedFolders[$folderId] = [];
                                            @endphp
                                        @endif

                                        @if (!in_array($item->userTo->name, $printedFolders[$folderId]))
                                            @php
                                                $printedFolders[$folderId][] = $item->userTo->name;
                                            @endphp
                                            <tr>
                                                <td>{{ $iteration++ }}</td>
                                                <td class="d-flex justify-content-start">
                                                    <a class="text-decoration-none text-black"
                                                        href="{{ url('admin/activity/shared/folder/list/' . $folderId) }}">
                                                        <i class="mdi mdi-folder mdi-18px"></i>
                                                        &nbsp;&nbsp;
                                                        <span class="text-black">
                                                            @if (isset($item->file->folder))
                                                                {{ $item->file->folder->folder_name }}
                                                            @endif
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>{{ $item->userFrom->name }}</td>
                                                <td>{{ $item->userTo->name }}</td>
                                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                                <td class="d-flex justify-content-between align-items-center">
                                                    <a class="text-end btn m-0 p-0 text-danger text-decoration-none"
                                                        href="{{ url('admin/activity/shared/folder/list/' . $folderId) }}">Open</a>

                                                    <form method="post"
                                                        action="{{ url('admin/shared-folder/delete/' . $folderId) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" value="{{ $folderId }}" name="folderId">
                                                        <input type="hidden" value="{{ $item->share_to }}"
                                                            name="shareToId">
                                                        <button
                                                            class="text-end btn ms-3 p-0 text-danger text-decoration-none"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
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
