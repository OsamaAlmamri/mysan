@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1> {{ trans('labels.Bouquets') }} <small>...</small></h1>

@endsection
@section('btn_add')
    <div class="box-tools pull-left">
        <a href="{{ route('bouquets.create') }}" type="button"
           class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
    </div>
@endsection
@section('header')
    <li class="active"> {{ trans('labels.Bouquets') }}</li>
@endsection

@section('custom_scripts')

    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        width: "100%",
                        responsive: true,
                        searching: true,
                        language: language,
                        pageLength: 10,
                        'createdRow': function (row, data, dataIndex) {
                            $(row).addClass('row1');
                            $(row).attr('data-id', data.bouquet_id);
                            $(row).attr('width', "100%");
                        },
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        buttons: [],
                        ajax: {
                            url: '{{ route("bouquets.filter2") }}',
                            data: {
                                _token: "{{csrf_token()}}",
                                from_date: from_date,
                                to_date: to_date,
                            }
                        }, columns: [
                            {
                                name: 'btn_sort',
                                data: 'btn_sort',
                                title: '{{trans('labels.btn_sort')}}'
                            },
                            {
                                title: '{{trans('labels.Name')}}',
                                data: 'bouquet_name_ar',
                                name: 'bouquet_name_ar',
                            },

                            {
                                title: '{{trans('labels.Image')}}',
                                data: 'btn_image',
                                name: 'btn_image',
                            },

                            {
                                title: '{{trans('labels.Price')}}',
                                data: 'bouquet_price',
                                name: 'bouquet_price',
                            },
                            {
                                title: '{{trans('labels.count')}}',
                                data: 'count',
                                name: 'count',
                            },
                            {
                                title: '{{trans('labels.sold_count')}}',
                                data: 'sold_count',
                                name: 'sold_count',
                            },
                            {
                                title: '{{trans('labels.expiry_date')}}',
                                data: 'expiry_date',
                                name: 'expiry_date',
                            }, {
                                title: '{{trans('labels.free_shipping')}}',
                                data: 'free_shipping',
                                name: 'free_shipping',
                            render:function (data) {
                                    return (data==0)?"لا":"نعم"

                            }
                            },
                            {
                                title: '{{trans('labels.created_at')}}',
                                data: 'created_at',
                                name: 'created_at',
                            },
                            {
                                title: '{{trans('labels.updated_at')}}',
                                data: 'updated_at',
                                name: 'updated_at',
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
    <?php $controler = 'bouquets.changeOrder' ?>
    @include('admin.sortFiles.scripts')
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
