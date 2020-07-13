@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(isset($viewCategory))
                    <small>{{ trans('labels.EditViewCategory') }}...</small>
                @else
                    <small>{{ trans('labels.AddViewCategory') }}...</small>
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/view_categories')}}"><i
                            class="fa fa-tablet"></i>{{ trans('labels.ListingAllView_categories') }}</a></li>
                <li class="active"> @if(isset($viewCategory))
                        {{ trans('labels.EditViewCategory') }}
                    @else
                        {{ trans('labels.AddViewCategory') }}
                    @endif</li>
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
                            <h3 class="box-title">
                            @if(isset($viewCategory))
                                {{ trans('labels.EditViewCategory') }}
                            @else
                                {{ trans('labels.AddViewCategory') }}
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @include('admin.common.messages')


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>
                                        @if(count($result['message'])>0)
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                {{ $result['message'] }}
                                            </div>
                                        @endif

                                        <div class="box-body">
                                            @if(isset($viewCategory))
                                                {!! Form::model($viewCategory, ['route' => ['view_categories.update', $viewCategory->id], 'method' => 'put','class' => 'form-horizontal form-validate', 'files' => true]) !!}

                                            @else
                                                {!! Form::open(array('route' =>'view_categories.store', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'files' => true)) !!}
                                            @endif
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.name_ar') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('name_ar', null, array('class'=>'form-control field-validate', 'id'=>'name_ar'))!!}
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_categories_name_ar') }}</span>
                                                    <span
                                                        class="help-block hidden">{{ trans('labels.view_categories_name_ar') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.name_en') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('name_en',  null, array('class'=>'form-control field-validate', 'id'=>'name_en'))!!}
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_categories_name_en') }}</span>
                                                    <span
                                                        class="help-block hidden">{{ trans('labels.view_categories_name_en') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.view_categories_sort') }}
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::number('sort', null, array('class'=>'form-control field-validate', 'id'=>'sort'))!!}
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    	{{ trans('labels.view_categories_sortText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }}</label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="products[]" multiple
                                                            class="form-control select2 field-validate">
                                                        @foreach($result['products'] as $products)
                                                            <option
                                                                value="{{ $products->products_id }}"
                                                                @if(in_array($products->products_id,$old_products)) selected="" @endif >{{ $products->products_name }} {{ $products->products_model }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_categories_products') }}</span>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit"
                                                        class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/view_categories')}}" type="button"
                                                   class="btn btn-default">{{ trans('labels.back') }}</a>
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
