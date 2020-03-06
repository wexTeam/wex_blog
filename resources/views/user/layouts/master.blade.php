<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php $setting =\App\Setting::pluck('value','name')->toArray(); @endphp
    @include('user.partials._head')
</head>
<body class="fix-header">
@include('user.partials._pre_loader')
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
@include('user.partials._nav_bar')
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
@include('user.partials._side_bar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        @yield('content')
        <!-- /.container-fluid -->
        @include('user.partials._footer')
    </div>
    <!-- /#page-wrapper -->
</div>
@include('user.partials._scripts')
</body>

</html>
