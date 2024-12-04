<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav pt-4">
        <li class="nav-item nav-profile">
            {{-- <a href="{{ route('user.dashboard') }}" class="nav-link"> --}}
                {{-- <div class="nav-profile-image">

                    @if (Auth::check() && Auth::user()->profile_img && file_exists(public_path('profiles/' . Auth::user()->profile_img)))
                        <img src="{{ asset('profiles/' . Auth::user()->profile_img) }}" alt="Profile Image"
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

                </div> --}}
                {{-- <div style="font-size:13px;  white-space: normal;" class="nav-profile-text d-flex flex-column"> --}}
                    
                    {{-- <span class="text-secondary text-small">Department:&nbsp;
                        <br> --}}

                    {{-- <span class="text-success">
                        {{ Auth::user()->department ? Auth::user()->department->dept_name : 'No department assigned' }}
                    </span> --}}
                    {{-- </span> --}}

                {{-- </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
            {{-- </a> --}}
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('user/dashboard/') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('user/folder/add?id='.@$_GET['id']) }}">
                <span class="menu-title">Add New Folder</span>
                <i class="mdi mdi-folder-plus menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('user/file/add?id='.@$_GET['id']) }}">
                <span class="menu-title">Upload Files</span>
                <i class="mdi mdi-plus menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('user/folders/') }}">
                <span class="menu-title">My Drive</span>
                <i class="mdi mdi-folder-google-drive menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('user/shared/') }}">
                <span class="menu-title">Share with me</span>
                <i class="mdi mdi-file-account-outline menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>


    </ul>
</nav>
