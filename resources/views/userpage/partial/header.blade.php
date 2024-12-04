<nav class="navbar activeness default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            <img style="height:120%; margin-top:10px;"
                src="{{ asset('AdminAssets/assets/dist/assets/images/logoresizeupdate.svg') }}" class=""
                alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        {{-- for the upload file --}}
        {{-- <div class="dropdown mt-3">
            <button class="btn btn-gradient-danger d-flex gap-3 pe-4 ps-4 align-items-center" type="button"
                id="dropdownMenuIconButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-plus mdi-24px"></i>
                <span style="font-size: 15px;">New</span>
            </button>
            <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuIconButton2">
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#newFolderModal">New
                    Folder</a>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#fileUploadModal">File
                    Upload</a>
            </div>
        </div> --}}





        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
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

                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black" style="font-weight: 700">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                        <i class="mdi mdi-account me-2 text-success"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                        onclick="return confirm('Do you want sure logout ?')">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>

</nav>