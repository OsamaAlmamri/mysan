@extends('admin.dataTable_layaout')
@section('btn_add')
    <div class="box-header">
        <div class="box-tools pull-right">
            <a href="{{ url('admin/customers/add')}}" type="button"
               class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
        </div>
        <br>
    </div>
@endsection
@section('header_h1')
    <h1> {{ trans('labels.Customers') }} <small>{{ trans('labels.ListingAllCustomers') }}...</small></h1>
@endsection
@section('header')
    <li class="active"> {{ trans('labels.Customers') }}</li>
@endsection
@section('custom_scripts')
@endsection
@section('modals')
    <div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteCustomerModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteCustomerModalLabel">{{ trans('labels.Delete') }}</h4>
                </div>
                {!! Form::open(array('url' =>'admin/customers/delete', 'name'=>'deleteCustomer', 'id'=>'deleteCustomer', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                {!! Form::hidden('action', 'delete', array('class'=>'form-control')) !!}
                {!! Form::hidden('users_id', '', array('class'=>'form-control', 'id'=>'users_id')) !!}
                <div class="modal-body">
                    <p>{{ trans('labels.DeleteCustomerText') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('labels.Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content notificationContent">

            </div>
        </div>
    </div>
@endsection
