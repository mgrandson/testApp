<!DOCTYPE html>
<html lang="es-ES">

@include('layouts.head')


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Top Menu -->
        @include('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebarleft')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        @ include('layouts.sidebarright')
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    @include('layouts.script')
    @yield('script')
</body>

</html>
