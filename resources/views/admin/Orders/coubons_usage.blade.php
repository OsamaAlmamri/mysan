@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1>  {{ trans('labels.CouponOrders') }} <small>{{ trans('labels.ListingAllCoupons') }}...</small></h1>
@endsection
@section('header')
    <li><a href="{{ URL::to('admin/coupons/display')}}"><i class="fa fa-tablet"></i>{{ trans('labels.ListingAllCoupons') }}</a></li>

    <li class="active"> {{ trans('labels.CouponOrders') }}</li>
@endsection
@section('custom_scripts')
@endsection


