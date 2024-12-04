<style>
    .nav-profile-image {
        max-width: 100px;
        /* Adjust the maximum width as needed */
        max-height: 100px;
        /* Adjust the maximum height as needed */
        object-fit: cover;
        border-radius: 50%;
    }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('teamlead.dashboard') }}" class="nav-link">
                <div class="nav-profile-image">

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
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span
                        class="text-success text-small">{{ Auth::check() && Auth::user()->role == 2 ? 'Team Lead' : '' }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/dashboard/') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/teams/') }}">
                <span class="menu-title">My Teams</span>
                <i class="mdi mdi-microsoft-teams menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/my-folders/') }}">
                <span class="menu-title">My Folders</span>
                <i class="mdi mdi-folder menu-icon" style="font-size: 20px;"></i>
            </a>
        </li> --}}



        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/folder/add?id='.@$_GET['id']) }}">
                <span class="menu-title">Add New Folder</span>
                <i class="mdi mdi-folder-plus menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/file/add?id='.@$_GET['id']) }}">
                <span class="menu-title">Upload Files</span>
                <i class="mdi mdi-plus menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/my-folders/') }}">
                <span class="menu-title">My Drive</span>
                <i class="mdi mdi-folder-google-drive menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ url('teamlead/shared/') }}">
                <span class="menu-title">Shared With Me</span>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="menu-title">Designation</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/forms/basic_elements.html">Form Elements</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">User Pages</span>

                <i class="mdi mdi-lock menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
            </a>
        </li> --}}
    </ul>
</nav>
