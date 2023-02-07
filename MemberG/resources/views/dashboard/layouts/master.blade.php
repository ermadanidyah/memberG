<!DOCTYPE html>
<html lang="en">
<!-- Head -->
    @include('Admin.include.head')
<!-- End Head -->
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
            @include('Admin.include.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
            @include('Admin.include.sidebar')
        <!-- End Main Sidebar Container -->
        
        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper"> --}}
            @yield('content')
        {{-- </div> --}}
        <!-- /.content-wrapper -->

        <!--Footer-->
            @include('Admin.include.footer')
        <!--End Footer-->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->
    <!--script-->
    @include('Admin.include.script')
    <!--end script-->
</body>
</html>
