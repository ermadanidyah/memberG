<!DOCTYPE html>
<html lang="en">
<!-- head -->
@include('dashboard.include.head')
<!-- end head -->

<body>
    <div class="wrapper">
        <!-- sidebar -->
        @include('dashboard.include.sidebar')
        <div class="main">
            <!-- navbar -->
            @include('dashboard.include.navbar')
            <main class="content">
                <!-- content -->
                @yield('content')
            </main>
            <!-- footer -->
            @include('dashboard.include.footer')
        </div>
    </div>
    <!-- script -->
    @include('dashboard.include.script')
    @yield('lib-script')
    @yield('page-script')
</body>

</html>