@extends('admin.layout')
@section('css')
@endsection
@section('dataTablesCss')
{{--        <link href="{!! asset('admin/newLibs/data-table/css/buttons.dataTables.min.css') !!}" media="all" rel="stylesheet"--}}
{{--              type="text/css"/>--}}
{{--        <link href="{!! asset('admin/newLibs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') !!}"--}}
{{--              media="all" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{!! asset('admin/newLibs/data-table/extensions/responsive/css/responsive.dataTables.css') !!}"--}}
{{--              media="all" rel="stylesheet" type="text/css"/>--}}
@endsection
@section('dataTablesJs')
    <script src="{!! asset('admin/newLibs/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/data-table/extensions/buttons/js/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/data-table/extensions/buttons/js/jszip.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-buttons/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-buttons/js\buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('admin/newLibs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
    {{--    <script src="{!! asset('vendor/datatables/buttons.server-side.js') !!}"></script>--}}
    @if(isset($dataTableType) and  $dataTableType=='php')
        @push('js')
            {!! $dataTable->scripts() !!}
        @endpush
    @endif
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('header_h1')
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                @yield('header')
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                    @yield('btn_add')
                    <!-- /.box-header -->

                        <div class="box-body">
                            @yield('filters')
                            @include('admin.common.messages')
                            <div class="row">
                                <div class="col-xs-12">
                                    @if(isset($dataTableType) and  $dataTableType=='php')
                                        {!! $dataTable->table(['class'=>'dataTable table table-striped table-hover table table-bordered' ],true)  !!}
                                    @else
                                        <table id="orderdata"
                                               class="dataTable table table-striped table-hover table table-bordered">
                                        </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            @yield('modals')
        </section>
    </div>
@endsection
@section('scripts')
    @yield('custom_scripts')
@endsection
