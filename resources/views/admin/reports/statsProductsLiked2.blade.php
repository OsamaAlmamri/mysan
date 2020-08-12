@extends('admin.dataTable_layaout')
@section('header_h1')

@endsection
@section('filters')
    @include('admin.common.filters.categories_date')
@endsection
@section('header')
@endsection

@section('custom_scripts')
    @include('admin.common.filters.catetegories_products_scripts')
    <script>
        $(document).ready(function () {
            var firstTime = 1;
            function load_data(main, sub, from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        autoWidth: false,
                        responsive: true,
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
                            url: '{{ route("statsProductsPurchased.filter2") }}',
                            data: {
                                _token: "{{csrf_token()}}",
                                main: main,
                                sub: sub,
                                from_date: from_date,
                                to_date: to_date,
                            }
                        }
                        ,   columns: [
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
                                // 'render': function (data, type, row) {
                                //     return (data == '1') ? 'نعم ' : 'لا';
                                // }
                            },

                           {
                                title: '{{trans('labels.Liked')}}',
                                data: 'products_liked',
                                name: 'products_liked',
                            },

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
