<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} @yield('title')</title>
    <!-- plugins:css -->
    {{--  --}}
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet"
        href="a{{ asset('AdminAssets/assets/dist/ssets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('AdminAssets/assets/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->

    <link rel="stylesheet" href="{{ asset('AdminAssets/style.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('AdminAssets/assets/dist/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('AdminAssets/assets/dist/assets/images/favicon.png') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
</head>

<body>
    <div class="container-scroller">
        @include('admin::partial.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin::partial.sidebar')

            <div class="main-panel">
                @yield('admin::content')



                @include('admin::partial.footermain')
            </div>

        </div>

    </div>
    @include('admin::partial.footer')
</body>

</html>
