@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('labels.Edit') }} {{$result['methods']['method_detail'][1]['name']}}<small>{{ trans('labels.Edit') }} {{$result['methods']['method_detail'][1]['name']}}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i>
                    {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/paymentmethods/index')}}"><i class="fa fa-dashboard"></i>
                    {{ trans('labels.PaymentSetting') }}</a></li>
            <li class="active">{{ trans('labels.Edit') }} {{$result['methods']['method_detail'][1]['name']}}</li>
        </ol>
    </section>
    

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.Edit') }} {{$result['methods']['method_detail'][1]['name']}}</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if (count($errors) > 0)
                                @if($errors->any())
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    {{$errors->first()}}
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <form enctype="multipart/form-data" class='form-validate'
                                            action="{{ URL::to('admin/paymentmethods/update')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="shippingEnvironment"
                                                        class="col-sm-2 col-md-2 control-label"
                                                        style="">{{ trans('labels.Enviroment') }}</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <label class=" control-label">
                                                            <input type="radio" name="enviroment" value="0"
                                                                class="flat-red"
                                                                @if($result['methods']['payment_methods']->enviroment==0) checked
                                                            @endif > &nbsp;{{ trans('labels.Sanbox') }}
                                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                        <label class=" control-label">
                                                            <input type="radio" name="enviroment" value="1"
                                                                class="flat-red"
                                                                @if($result['methods']['payment_methods']->enviroment==1) checked
                                                            @endif > &nbsp;{{ trans('labels.Live') }}
                                                        </label>
                                                        <span class="help-block"
                                                            style="font-weight: normal;font-size: 11px;margin-bottom: 0; display: none">{{ trans('labels.BraintreeAccountTypeText') }}</span>
                                                        <br>
                                                    </div>
                                                </div>
                                                </br>
                                                </br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                @foreach($result['methods']['method_keys'] as $res)
                                                
                                                @if($res->keyname != 'paymentcurrency')
                                                <div class="col-xs-6" style="margin-bottom: 10px;">
                                                    <div class="form-group">
                                                        <label for="name"
                                                            class="col-sm-2 col-md-4 control-label">{{ trans('labels.'.$res->keyname) }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input type="text" name="<?php echo 'field_' .$res->key; ?>"
                                                                id="braintree_merchant_id" value="{{$res->value}}"
                                                                class="form-control field-validate">
                                                            <span class="help-block"
                                                                style="font-weight: normal;font-size: 11px;margin-bottom: 0; display: none">{{ trans('labels.MerchantIDText') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>

                                            <hr>
                                            <h4>{{ trans('labels.Translation') }}</h4>
                                            <hr>
                                            <div class="row">
                                                @foreach($result['methods']['method_detail'] as $detail)
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="name"
                                                            class="col-sm-2 col-md-4 control-label">{{ trans('labels.Name') }}
                                                            ({{ $detail['language_name'] }}) </label>
                                                            <div class="col-sm-10 col-md-8">
                                                            <input type="text" name="name_<?=$detail['languages_id']?>"
                                                                class="form-control field-validate"
                                                                value="{{$detail['name']}}">
                                                            <span class="help-block"
                                                                style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.paymentmethodname') }}
                                                                ({{ $detail['language_name'] }})</span>
                                                            <span
                                                                class="help-block hidden" style="display: none">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="row">
                                                <div class="box-footer text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary payment-checkbox">{{ trans('labels.Submit') }}
                                                    </button>
                                                    <a href="{{ URL::to('admin/paymentmethods/index')}}" type="button"
                                                        class="btn btn-default">{{ trans('labels.back') }}</a>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /.box-footer -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection