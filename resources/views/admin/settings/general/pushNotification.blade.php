@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.pushNotification') }} <small>{{ trans('labels.pushNotification') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.pushNotification') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.pushNotification') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Setting') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.defaultNotification') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="default_notification" id="default_notification" class="form-control">
                                                        <option @if($result['settings'][54]->value == 'fcm')
                                                                selected
                                                                @endif
                                                                value="fcm"> {{ trans('labels.fcm') }}</option>
{{--                                                        <option @if($result['settings'][54]->value == 'onesignal')--}}
{{--                                                                selected--}}
{{--                                                                @endif--}}
{{--                                                                value="onesignal"> {{ trans('labels.onesignal') }}</option>--}}
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.defaultNotificationText') }}</span>
                                                </div>
                                            </div>



                                            <div class="onesignal_content" @if($result['settings'][54]->value == 'onesignal')
                                            style="display: block;"
                                                 @endif style="display: none;">
                                                <hr>
                                                <h5>{{ trans('labels.PushNotificationOnesignal') }} </h5>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OnesignalAppid') }}</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][55]->name,  $result['settings'][55]->value, array('class'=>'form-control', 'id'=>$result['settings'][55]->name)) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                {{ trans('labels.OnesignalAppidText') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OnesignalSenderid') }}</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][56]->name,  $result['settings'][56]->value, array('class'=>'form-control', 'id'=>$result['settings'][56]->name)) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                {{ trans('labels.OnesignalSenderidText') }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="fcm_content" @if($result['settings'][54]->value == 'fcm')
                                            style="display: block;"
                                                 @endif style="display: none;">
                                                <hr>
                                                <h5>{{ trans('labels.PushNotificationSetting') }} </h5>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.AppKey') }}

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][12]->name,  $result['settings'][12]->value, array('class'=>'form-control', 'id'=>$result['settings'][12]->name)) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                {{ trans('labels.AppKeyText') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SenderId') }}

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][17]->name,  $result['settings'][17]->value, array('class'=>'form-control', 'id'=>$result['settings'][17]->name)) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.SenderIdText') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                                <hr>
                                                <h5>{{ trans('labels.customers_basket') }} </h5>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.customers_basketDaiesForNotification') }}
                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][125]->name,  $result['settings'][125]->value, array('class'=>'form-control', 'id'=>$result['settings'][12]->name)) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.repeat_customers_basketDaiesForNotification') }}
                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text($result['settings'][126]->name,  $result['settings'][126]->value, array('class'=>'form-control', 'id'=>$result['settings'][12]->name)) !!}
                                                    </div>
                                                </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                                <a href="{{ URL::to('admin/dashboard/this_month')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>

                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
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
