<!DOCTYPE html>
<html>

<head>
    <title>Backend Dashboard</title>
    <!-- Use asset() to generate the correct URL -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/backend/css/style.css') }}" rel="stylesheet">
</head>

<body class="show-sidebar">
    <div id="header">
        <div class="hide-menu top_header tw-ml-1">

            @include('backend.partials.navbar')
        </div>
    </div>
    <div class="alert_wrapper">
    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error message -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <div class="main_wrapper">
        @include('backend.partials.aside')

        <div id="wrapper" class="main-content mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Use asset() to generate the correct URL for JS files -->
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/backend/js/style.js') }}"></script>
    <!-- <script src="{{ asset('asset/js/dataTables.bootstrap5.min.js') }}"></script> -->
    @yield('page.scripts')   

</body>

</html>