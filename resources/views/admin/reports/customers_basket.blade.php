@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1> {{ trans('labels.customers_basket') }} <small>{{ trans('labels.customers_basket') }}...</small>
    </h1>
@endsection
@section('filters')
    <div class="row">
        <div class=" col-md-3 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon">{{trans('labels.fromDate')}}</span>
                <input type="date" class="form-control" name="start" value="{{isset($start)?$start:''}}"
                       id="from_date">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon">{{trans('labels.toDate')}}</span>
                <input type="date" class="form-control" name="end" value="{{isset($end)?$end:''}}" required
                       id="to_date">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="input-group ">
                <button type="button" name="filter" id="filter"
                        class="btn btn-primary btn-ms waves-effect waves-light">{{trans('labels.filter')}} <i
                        class="fa fa-filter"></i></button>
            </div>
        </div>
    </div>
@endsection
@section('header')
    <li class="active">{{ trans('labels.customers_basket') }}</li>
@endsection

@section('custom_scripts')
    @include('admin.common.filters.catetegories_products_scripts')
    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        autoWidth: false,
                        searching: true,
                        language: language,
                        pageLength: 10,
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        buttons: [],
                        ajax: {
                            url: '{{ route("reports.customers_basketFilter") }}',
                            data: {
                                _token: "{{csrf_token()}}",
                                from_date: from_date,
                                reportType: '{{$reportType}}',
                                to_date: to_date,
                            }
                        }
                        , columns: [
                            {
                                title: '#',
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                title: '{{trans('labels.customer')}}',
                                data: 'customer',
                                name: 'customer',
                            },
                            {
                                title: '{{trans('labels.all_price')}}',
                                data: 'all_price',
                                name: 'all_price',
                            },
                            {
                                title: '{{trans('labels.all_quantity')}}',
                                data: 'all_quantity',
                                name: 'all_quantity',
                            }, {
                                title: '{{trans('labels.all_productsType')}}',
                                data: 'all_productsType',
                                name: 'all_productsType',
                            }, {
                                title: '{{trans('labels.first_date_added')}}',
                                data: 'first_date_added',
                                name: 'first_date_added',
                            }, {
                                title: '{{trans('labels.last_date_added')}}',
                                data: 'last_date_added',
                                name: 'last_date_added',
                            }, {
                                title: '{{trans('labels.last_basket_notification_date')}}',
                                data: 'last_basket_notification_date',
                                name: 'last_basket_notification_date',
                            },
                            {
                                title: '{{trans('labels.Action')}}',
                                data: 'manage',
                                name: 'manage',
                                orderable: false,
                                exportable: false,
                                searchable: false
                            }


                        ]
                    }
                )
                ;
            }

            $('#filter').click(function () {
                ChangeInput();
            });

            function ChangeInput() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(from_date, to_date);
            }

            load_data(null, null);
        });
    </script>
@endsection
@section('modals')
@endsection
