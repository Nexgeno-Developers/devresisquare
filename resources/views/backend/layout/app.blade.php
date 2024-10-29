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
    @if (session('success'))
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
    @endif
    <div id="header">
        <div class="hide-menu tw-ml-1"><i class="fa fa-align-left"></i>Toggle side bar</div>
        @include('backend.partials.navbar')
    </div>

    @include('backend.partials.aside')

    <div id="wrapper" class="main-content container mt-4">
        @yield('content')
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