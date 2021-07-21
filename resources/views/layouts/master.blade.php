<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @yield('title')

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/daterangepicker/daterangepicker.css') }}">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    @stack('page-styles')

    @yield('css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.header')
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @if (Request::segment(1) != '')
                            <h1>{{ Request::segment(1) }}</h1>
                        @else
                            <h1>Dashboard</h1>
                        @endif
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
                            <div class="breadcrumb-item active"><a href="#">{{ Request::segment(1) }}</a></div>

                        </div>
                    </div>

                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By <a
                        href="https://kapantech.com/">Nama Perusahaan</a>
                </div>
                <div class="footer-right">
                    1.0.0
                </div>
            </footer>
        </div>
    </div>
    @stack('before-scripts')
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/daterangepicker/daterangepicker.js') }}"></script>
    <!-- JS Libraies 
        -->
    @stack('page-scripts')
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('after-scripts')
    @yield('js')
    <!-- Page Specific JS File -->
</body>

</html>
