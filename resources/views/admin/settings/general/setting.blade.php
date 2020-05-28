@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.Setting') }}<small>{{ trans('labels.Setting') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li class="active">{{ trans('labels.Setting') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.Setting') }}</h3>
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
                                            {{ $error }}</div>
                                        @endforeach
                                        @endif

                                        {!! Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                        <h4>{{ trans('labels.generalSetting') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.Web/App Environment') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="{{$result['settings'][93]->name}}" value="Maintenance" class="flat-red" @if($result['settings'][93]->value=='Maintenance') checked @endif > &nbsp;{{ trans('labels.Maintenance') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="{{$result['settings'][93]->name}}" value="production" class="flat-red" @if($result['settings'][93]->value=='production') checked @endif >  &nbsp;{{ trans('labels.production') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="{{$result['settings'][93]->name}}" value="local" class="flat-red" @if($result['settings'][93]->value=='local') checked @endif >  &nbsp;{{ trans('labels.local') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Maintenance Text') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text($result['settings'][94]->name,  stripslashes($result['settings'][94]->value), array('class'=>'form-control', 'id'=>$result['settings'][89]->name)) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Maintenance Text detail') }}</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.website Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][102]->name, $result['settings'][102]->value, array('class'=>'form-control', 'id'=>$result['settings'][102]->name)) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Website Link Text') }}</span>
                                            </div>
                                        </div>

                                        @if($result['settings'][66]->value==1 )
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Android App Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][109]->name, $result['settings'][109]->value, array('class'=>'form-control', 'id'=>$result['settings'][109]->name)) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Android App Link') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Iphone App Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][110]->name, $result['settings'][110]->value, array('class'=>'form-control', 'id'=>$result['settings'][110]->name)) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Iphone App Link') }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.AppName') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][18]->name, $result['settings'][18]->value, array('class'=>'form-control', 'id'=>$result['settings'][18]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.AppNameText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.NewProductDuration') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][20]->name, $result['settings'][20]->value, array('class'=>'form-control', 'id'=>$result['settings'][20]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.NewProductDurationText') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.Google Map API') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Google Map API') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][103]->name, $result['settings'][103]->value, array('class'=>'form-control', 'id'=>$result['settings'][103]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.Google Map API Text') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.InqueryEmails') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ContactUsEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][3]->name, $result['settings'][3]->value, array('class'=>'form-control', 'id'=>$result['settings'][3]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.ContactUsEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.OrderEmail') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OrderEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][70]->name, $result['settings'][70]->value, array('class'=>'form-control', 'id'=>$result['settings'][70]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.OrderEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.Orders') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Free Shipping On Min Order Price') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][82]->name, $result['settings'][82]->value, array('class'=>'form-control', 'id'=>$result['settings'][82]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.Free Shipping On After Order Price Text') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Min Order Price') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][100]->name, $result['settings'][100]->value, array('class'=>'form-control', 'id'=>$result['settings'][100]->name)) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.Min Order Price Text') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.OurInfo') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.PhoneNumber') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][11]->name, $result['settings'][11]->value, array('class'=>'form-control', 'id'=>$result['settings'][11]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.PhoneNumberText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Address') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][4]->name, $result['settings'][4]->value, array('class'=>'form-control', 'id'=>$result['settings'][4]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.AddressText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.City') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][5]->name, $result['settings'][5]->value, array('class'=>'form-control', 'id'=>$result['settings'][5]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.CityText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][6]->name, $result['settings'][6]->value, array('class'=>'form-control', 'id'=>$result['settings'][6]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.StateText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Zip') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][7]->name, $result['settings'][7]->value, array('class'=>'form-control', 'id'=>$result['settings'][7]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.ZipText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][8]->name, $result['settings'][8]->value, array('class'=>'form-control', 'id'=>$result['settings'][8]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.CountryContactUs') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Latitude') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][9]->name, $result['settings'][9]->value, array('class'=>'form-control', 'id'=>$result['settings'][9]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.latitudeText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Longitude') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text($result['settings'][10]->name, $result['settings'][10]->value, array('class'=>'form-control', 'id'=>$result['settings'][10]->name)) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.LongitudeText') }}</span>
                                            </div>
                                        </div>

                                    </div>



                                    <!-- /.box-body -->
                                    <div class="box-footer text-center">
                                        <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
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

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
