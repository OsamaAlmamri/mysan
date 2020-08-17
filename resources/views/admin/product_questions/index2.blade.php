@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1>  {{ trans('labels.product_questions') }} <small>{{ trans('labels.ListingAllproduct_questions') }}...</small>
    </h1>
@endsection
@section('filters')
    @include('admin.common.filters.catetegories_products_date')
@endsection
@section('header')
    <li class="active"> {{ trans('labels.product_questions') }}</li>
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
                        searching: true,
                        autoWidth: false,
                        search: [
                            regex => true,
                        ],
                        info: false,

                        searchDelay: 350,
                        language: language,
//                         dom: 'Blftip',
                        "createdRow": function (row, data, dataIndex) {
                            $(row).addClass('row1');
                            $(row).attr('data-id', data.product_question_id);
                            $(row).attr('width', "100%");
                        },
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        buttons:
                            [],
                        ajax:
                            {
                                url: '{{ route("product_questions.filter2") }}',
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
                                name: 'btn_sort',
                                data: 'btn_sort',
                                title: '{{trans('labels.btn_sort')}}'
                            },
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
                            },
                            {
                                title: '{{trans('labels.question_text')}}',
                                data: 'text',
                                name: 'text',
                            },
                            {
                                title: '{{trans('labels.replyes')}}',
                                data: 'replyes',
                                name: 'replyes',
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

            load_data('all', 'all', 'all', null, null);
        });
    </script>
    <?php $controler = 'product_questions.changeOrder' ?>
    @include('admin.sortFiles.scripts')
@endsection
@section('modals')
@endsection
