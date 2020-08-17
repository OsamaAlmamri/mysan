@extends('admin.dataTable_layaout')
@section('header_h1')
    <h1>  {{ trans('labels.view_categories') }} <small>{{ trans('labels.ListingAllView_categories') }}
            ...</small></h1>
@endsection
@section('header')
    <li class="active"> {{ trans('labels.view_categories') }}</li>
@endsection
@section('btn_add')

    <div class="box-header">
        <div class="box-tools pull-right">
            <a href="{{ URL::to('admin/view_categories/create')}}" type="button"
               class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>        </div>
        <br>
    </div>
@endsection
@section('modals')
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

@endsection

@section('custom_scripts')
<?php $controler = 'view_categories.changeOrder' ?>
@include('admin.sortFiles.scripts')
@endsection
