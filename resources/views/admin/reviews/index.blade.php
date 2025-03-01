@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1>  {{ trans('labels.reviews') }} <small>{{ trans('labels.ListingAllReviews') }}...</small></h1>
@endsection
@section('filters')
    @include('admin.common.filters.catetegories_products_date')
@endsection
@section('header')
    <li class="active"> {{ trans('labels.reviews') }}</li>
@endsection
@section('custom_scripts')
    @include('admin.common.filters.catetegories_products_scripts')
    <script>
        $(document).ready(function () {
            var firstTime = 1;
            function load_data(product, main, sub, from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        autoWidth: false,
                        searching: true,
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
                        language: language,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        // buttons:
                        //     [],
                        ajax:
                            {
                                url: '{{ route("reviews.filter2") }}',
                                data:
                                    {
                                        _token: "{{csrf_token()}}",
                                        product: product,
                                        main: main,
                                        sub: sub,
                                        from_date: from_date,
                                        to_date: to_date,
                                    }
                            },

                        columns: [
                            {
                                title: '#',
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false

                            },
                            {
                                title: '{{trans('labels.ID')}}',
                                data: 'btn_id',
                                name: 'btn_id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },
                            {
                                title: '{{trans('labels.products_name')}}',
                                data: 'products_name',
                                name: 'products_name',
                            }, {
                                title: '{{trans('labels.user')}}',
                                data: 'user',
                                name: 'user',
                            }, {
                                title: '{{trans('labels.reviews_rating')}}',
                                data: 'reviews_rating',
                                name: 'reviews_rating',
                            },
                            {
                                title: '{{trans('labels.reviews_text')}}',
                                data: 'reviews_text',
                                name: 'reviews_text',
                            },
                            {
                                title: '{{trans('labels.Date')}}',
                                data: 'created_at',
                                name: 'created_at',
                            },
                            {
                                title: '{{trans('labels.Action')}}',
                                data: 'manage',
                                name: 'manage',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            }
                        ]
                    }
                );
            }
            $('#filter').click(function () {
                ChangeInput();
            });
            function ChangeInput() {
                var product = $('#products_list').val();
                var main = $('#main_categories').val();
                var sub = $('#subCategories').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(product, main, sub, from_date, to_date);
            }
            load_data('{{$product_id}}', 'all', 'all', null, null);
        });
    </script>
@endsection
@section('modals')
@endsection
