@section('dataTablesCss')
    {{--    <link href="{!! asset('admin/newLibs/data-table/css/buttons.dataTables.min.css') !!}" media="all" rel="stylesheet"--}}
    {{--          type="text/css"/>--}}
    {{--    <link href="{!! asset('admin/newLibs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') !!}"--}}
    {{--          media="all" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{!! asset('admin/newLibs/data-table/extensions/responsive/css/responsive.dataTables.css') !!}"--}}
    {{--          media="all" rel="stylesheet" type="text/css"/>--}}
@endsection
@section('dataTablesJs')
    <script src="{!! asset('admin/newLibs/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/data-table/extensions/buttons/js/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/data-table/extensions/buttons/js/jszip.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-buttons/js\buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
    {{--    <script src="{!! asset('vendor/datatables/buttons.server-side.js') !!}"></script>--}}
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection

