<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} @yield('title')</title>

    <!-- plugins:css -->
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('AdminAssets/assets/dist/assets/images/favicon.png') }}" />

    {{-- progress bar links for the teamlead --}}

    <!-- Include Axios and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include NProgress for the progress bar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    {{-- --------- --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div class="container-scroller">
        @include('teamlead.partial.header')
        <div class="container-fluid page-body-wrapper">
            @include('teamlead.partial.sidebar')
            <div class="main-panel">
                @yield('teamlead::content')
                @include('teamlead.partial.footermain')
            </div>
        </div>
    </div>
    @include('teamlead.partial.footer')
</body>

</html>
