<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> --}}
</head>

<body>
    <div class="container-scroller">
        @include('userpage.partial.header')
        <div class="container-fluid page-body-wrapper">
            @include('userpage.partial.sidebar')
            <div class="main-panel">
                @yield('content')
                @include('userpage.partial.footermain')
            </div>
        </div>
    </div>
    @include('userpage.partial.footer')
</body>

</html>
