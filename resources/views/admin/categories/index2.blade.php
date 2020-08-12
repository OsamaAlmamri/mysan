@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1> {{ trans('labels.Categories') }} <small>{{ trans('labels.ListingAllMainCategories') }}...</small></h1>

@endsection
@section('btn_add')
    <div class="box-tools pull-left">
        <a href="{{ URL::to('admin/categories/add')}}"
           type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNewCategory') }}</a>

    </div>
@endsection
@section('filters')
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon">{{trans('labels.Categories')}}</span>
                {!!Form ::select('subCategories',getCategoriesToSelect(),'',['class' => 'select2 form-control', 'id' => 'subCategories'])!!}
            </div>
        </div>

        <div class="col-md-4 col-xs-6">
            <div class="input-group ">
                <button type="button" name="filter" id="filter"
                        class="btn btn-primary btn-ms waves-effect waves-light">{{trans('labels.filter')}} <i
                        class="fa fa-filter"></i></button>
            </div>
        </div>
    </div>
    <br>


@endsection
@section('header')
    <li class="active">{{ trans('labels.MainCategories') }}</li>
@endsection

@section('custom_scripts')
    @include('admin.common.active')
    <script>
        Active("{{route('categories.active')}}");
    </script>
    <script>
        $(document).ready(function () {
            var firstTime = 1;
            function load_data( sub) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        autoWidth: false,
                        searching: true,
                        language: language,
                        "createdRow": function (row, data, dataIndex) {
                            $(row).addClass('row1');
                            $(row).attr('data-id', data.id);
                            $(row).attr('width', "100%");
                        },
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
                            url: '{{ route("categories.filter2") }}',
                            data: {
                                _token: "{{csrf_token()}}",
                                sub: sub,

                            }
                        }
                        , columns: [
                            {
                                name: 'btn_sort',
                                data: 'btn_sort',
                                title: '{{trans('labels.btn_sort')}}'
                            },
                            {
                                title: '{{trans('labels.ID')}}',
                                data: 'id',
                                name: 'id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },

                            {
                                title: '{{trans('labels.Name')}}',
                                data: 'name',
                                name: 'name',
                                // 'render': function (data, type, row) {
                                //     return (data == '1') ? 'نعم ' : 'لا';
                                // }
                            },
                            {
                                title: '{{trans('labels.Image')}}',
                                data: 'btn_image',
                                name: 'btn_image',
                            },

                            {
                                title: '{{trans('labels.AddedLastModifiedDate')}}',
                                data: 'info',
                                name: 'info',
                            },
                            {
                                title: '{{trans('labels.Status')}}',
                                data: 'status',
                                name: 'status',
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


            var sub = $('#subCategories').val();
            function ChangeInput() {
                var sub = $('#subCategories').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(sub);
            }

            load_data(sub);
        });
    </script>
    <?php $controler = 'categories.changeOrder' ?>
    @include('admin.sortFiles.scripts')
@endsection
@section('modals')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                </div>
                {!! Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')) !!}
                <div class="modal-body">
                    <p>{{ trans('labels.DeleteText') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                    <button type="submit" class="btn btn-primary" id="deleteBanner">{{ trans('labels.Delete') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
