@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1> {{ trans('labels.Products') }} <small>{{ trans('labels.ListingAllProducts') }}...</small></h1>

@endsection
@section('btn_add')
    <div class="box-tools pull-left">
        <a href="{{ URL::to('admin/products/add') }}" type="button"
           class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
    </div>
@endsection
@section('filters')
    @include('admin.common.filters.categories_date')
@endsection
@section('header')
    <li class="active"> {{ trans('labels.Products') }}</li>
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
                            url: '{{ route("products.filter2") }}',
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
                                title: '{{trans('labels.Additional info')}}',
                                data: 'info',
                                name: 'info',
                            }, {
                                title: '{{trans('labels.ModifiedDate')}}',
                                data: 'productupdate',
                                name: 'productupdate',
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
    <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog"
         aria-labelledby="deleteProductModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteProductModalLabel">{{ trans('labels.DeleteProduct') }}</h4>
                </div>
                {!! Form::open(array('url' =>'admin/products/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                {!! Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')) !!}
                <div class="modal-body">
                    <p>{{ trans('labels.DeleteThisProductDiloge') }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('labels.Close') }}</button>
                    <button type="submit" class="btn btn-primary"
                            id="deleteProduct">{{ trans('labels.DeleteProduct') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
