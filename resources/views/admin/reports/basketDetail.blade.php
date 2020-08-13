@extends('admin.dataTable_layaout')

@section('header_h1')
    <h1>  {{ trans('labels.view_customers_basket_detail') }} </small></h1>
@endsection
@section('header')
    /
    <a href="{{ route('report.show','customers_basket')}}"><i
            class="fa fa-file"></i> {{ trans('labels.customers_basket') }}</a></li>
    /
    <li class="active"> {{ trans('labels.ViewBasketDetails') }}</li>@endsection
@section('custom_scripts')
@endsection
@section('modals')
    <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog" aria-labelledby="deleteCoupanModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteCoupanModalLabel">{{ trans('labels.DeleteCoupon') }}</h4>
                </div>
                {!! Form::open(array('url' =>'admin/coupons/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')) !!}
                <div class="modal-body">
                    <p>{{ trans('labels.DeleteCouponText') }}</p>
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
@endsection

