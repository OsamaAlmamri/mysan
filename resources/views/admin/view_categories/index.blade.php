@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.view_categories') }} <small>{{ trans('labels.ListingAllView_categories') }}
                    ...</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.view_categories') }}</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            {{--<h3 class="box-title">{{ trans('labels.ListingAllCoupons') }} </h3>--}}


                            <div class="box-tools ">
                                <a href="{{ URL::to('admin/view_categories/create')}}" type="button"
                                   class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                            <br>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            @include('admin.common.messages')
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@sortablelink('id', trans('labels.ID') )</th>
                                            <th>@sortablelink('name_ar', trans('labels.name_ar') )</th>
                                            <th>@sortablelink('name_en', trans('labels.name_en') )</th>
                                            <th>@sortablelink('sort', trans('labels.sort') )</th>
                                            <th>@sortablelink('parent', trans('labels.parent') )</th>
                                            <th>@sortablelink('content', trans('labels.content') )</th>
                                            <th>{{ trans('labels.Image') }}</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if($coupons !== null)
                                            @foreach ($coupons as $key=>$coupan)
                                                <tr>
                                                    <td>{{ $coupan->id }}</td>
                                                    <td>{{ $coupan->name_ar }}</td>
                                                    <td>{{ $coupan->name_en }} </td>
                                                    <td>{{ $coupan->sort }} </td>
                                                    <td>{{ ($coupan->parent==0)?trans('labels.no'):trans('labels.yes') }} </td>
                                                    <td>{{ ($coupan->content=='products')?trans('labels.view_type_products'):trans('labels.view_type_categories') }} </td>
                                                    <td><img src="{{asset($coupan->imagePath->imagesTHUMBNAIL->path)}}" alt="" width=" 100px"></td>

                                                    <td><a data-toggle="tooltip" data-placement="bottom"
                                                           title="{{ trans('labels.Edit') }}"
                                                           href="{{ url('admin/view_categories/'.$coupan->id.'/edit')}}"
                                                           class="badge bg-light-blue"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom"
                                                           title="{{ trans('labels.Delete') }}" id="deleteCoupans_id"
                                                           coupans_id="{{ $coupan->id }}"
                                                           class="badge bg-red"><i class="fa fa-trash"
                                                                                   aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8"><strong>{{ trans('labels.NoRecordFound') }}</strong>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        {{--{{ $result['coupons']->links() }}--}}
                                        {{--'vendor.pagination.default'--}}
                                        {!! $coupons->appends(\Request::except('page'))->render() !!}

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- deleteCoupanModal -->
            <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteCoupanModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="deleteCoupanModalLabel">{{ trans('labels.DeleteView_categories') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/view_categories/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteView_categoriesText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"
                                    id="deleteCoupanBtn">{{ trans('labels.Delete') }} </button>
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
