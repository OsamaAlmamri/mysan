@extends('admin.dataTable_layaout')
@section('header_h1')
    @if($reportType=='inventory')
        <h1> {{ trans('labels.StatsProductsPurchased') }} <small>{{ trans('labels.StatsProductsPurchased') }}...</small>
        </h1>
    @else
        <h1> {{ trans('labels.StatsProductsLiked') }} <small>{{ trans('labels.StatsProductsLiked') }}...</small></h1>
    @endif
@endsection
@section('filters')
    @include('admin.common.filters.categories_date')
@endsection
@section('header')
    @if($reportType=='inventory')
        <li class="active">{{ trans('labels.StatsProductsPurchased') }}</li>
    @else
        <li class="active">{{ trans('labels.StatsProductsLiked') }}</li>
    @endif
@endsection

@section('custom_scripts')
    @include('admin.common.filters.catetegories_products_scripts')
    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(main, sub, from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        searching: true,
                        autoWidth: false,
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
                            url: '{{ route("reports.filter2") }}',
                            data: {
                                _token: "{{csrf_token()}}",
                                main: main,
                                sub: sub,
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
                                title: '{{trans('labels.ID')}}',
                                data: 'products_id',
                                name: 'products_id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },
                            {
                                title: '{{trans('labels.Image')}}',
                                data: 'btn_image',
                                name: 'btn_image',
                            }, {
                                title: '{{trans('labels.Category')}}',
                                data: 'categories_name',
                                name: 'categories_name',
                            },
                            {
                                title: '{{trans('labels.Name')}}',
                                data: 'products_name',
                                name: 'products_name',
                            },
                                @if("$reportType"=='like')
                            {
                                title: '{{trans('labels.Liked')}}',
                                data: 'products_liked',
                                name: 'products_liked',
                            }
                                @else
                            {
                                title: '{{trans('labels.PurchasedDate')}}',
                                data: 'created_at',
                                name: 'created_at',
                            }, {
                                title: '{{trans('labels.UpdatedDate')}}',
                                data: 'updated_at',
                                name: 'updated_at',
                            }, {
                                title: '{{trans('labels.Stock')}}',
                                data: 'stock',
                                name: 'stock',
                            }, {
                                title: '{{trans('labels.Price')}}',
                                data: 'purchase_price',
                                name: 'purchase_price',
                            }
                            @endif

                        ]
                    }
                )
                ;
            }

            $('#filter').click(function () {
                ChangeInput();
            });

            function ChangeInput() {
                var main = $('#main_categories').val();
                var sub = $('#subCategories').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(main, sub, from_date, to_date);
            }

            load_data('all', 'all', null, null);
        });
    </script>
@endsection
@section('modals')
@endsection
