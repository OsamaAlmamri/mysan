@extends('admin.dataTable_layaout')
@section('btn_add')
    <div class="box-header">
        <div class="box-tools pull-right">
            <a href="{{ URL::to('admin/manufacturers/add') }}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
        </div>
        <br>
    </div>
@endsection
@section('header_h1')
    <h1> {{ trans('labels.Manufacturer') }} <small>{{ trans('labels.ListingAllManufacturers') }}...</small> </h1>
@endsection
@section('header')
    <li class=" active">{{ trans('labels.Manufacturer') }}</li>
@endsection
@section('custom_scripts')
@endsection
@section('modals')
    <!-- deleteManufacturerModal -->
    <div class="modal fade" id="manufacturerModal" tabindex="-1" role="dialog" aria-labelledby="deleteManufacturerModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteManufacturerModalLabel">{{ trans('labels.DeleteManufacturer') }}</h4>
                </div>
                {!! Form::open(array('url' =>'admin/manufacturers/delete', 'name'=>'deleteManufacturer', 'id'=>'deleteManufacturer', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                {!! Form::hidden('manufacturers_id',  '', array('class'=>'form-control', 'id'=>'manufacturers_id')) !!}
                <div class="modal-body">
                    <p>{{ trans('labels.DeleteManufacturerText') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
