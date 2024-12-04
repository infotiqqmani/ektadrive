<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
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
                        class="text-success text-small">{{ Auth::check() && Auth::user()->role == 1 ? 'Admin' : '' }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard/') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/department/') }}">
                <span class="menu-title">My Departments</span>
                <i class="mdi mdi-microsoft-teams menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/user/') }}">
                <span class="menu-title">Members</span>
                <i class="mdi mdi-account-group menu-icon" style="font-size: 20px;"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Deleted Files</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-trash-can menu-icon" style="font-size: 20px;"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/activity/teamlead/') }}">
                            Team Lead
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/activity/member/') }}">
                            Members
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth2">
                <span class="menu-title">Shared Files</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-share-all menu-icon" style="font-size: 20px;"></i>
            </a>
            <div class="collapse" id="auth2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/activity/shared/files/') }}">
                            Shared Files
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/activity/shared/folders/') }}">
                            Shared Folder
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
