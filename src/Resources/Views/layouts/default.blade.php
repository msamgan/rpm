<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="manages roles, permission and menus" name="rpm">
    <meta content="" name="mohd. Samgan Khan">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('Rpm/Assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('Rpm/Assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body id="page-top" class="sidebar-toggled">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" title="Home" href="{{ url('/') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-list"></i>
            </div>
            <div class="sidebar-brand-text mx-3">RPM <sup>V1</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        @include('rpm::partials.sidebar')

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div class="d-flex flex-column" id="content-wrapper">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('rpm::partials.header')
            <!-- End of Topbar -->

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('rpm::partials.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('Rpm/Assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Rpm/Assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('Rpm/Assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('Rpm/Assets/js/sb-admin-2.min.js') }}"></script>

@yield('js')

</body>

</html>
