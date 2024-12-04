@if (Session::has('error'))
    <p>Error</p>
    <p>{{ Session::get('error') }}</p>
@endif
@if (Session::has('success'))
    <p>Success</p>
    <p>{{ Session::get('Success') }}</p>
@endif
