<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
<head>
    @include('admin.common.meta')
    @yield('dataTablesCss')
    @yield('css')

</head>
<!-- ./end of meta -->

<body class=" hold-transition skin-blue sidebar-mini">
<!-- wrapper -->
<div class="wrapper">

    <!-- header contains top navbar -->
@include('admin.common.header')
<!-- ./end of header -->

    <!-- left sidebar -->
@include('admin.common.sidebar')
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
@yield('content')
<!-- ./end of dynamic content -->

    <!-- right sidebar -->
@include('admin.common.controlsidebar')
<!-- ./right sidebar -->
    @include('admin.common.footer')
</div>
<!-- ./wrapper -->
<!-- all js scripts including custom js -->
@include('admin.common.libs')
@yield('dataTablesJs')
@yield('scripts')

@yield('dataTableImport')
@include('admin.common.scripts')
<!-- ./end of js scripts -->
@stack('js')
@stack('css')
</body>
</html>
