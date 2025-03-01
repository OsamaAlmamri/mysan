@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Bouquets') }} <small>{{ trans('labels.Bouquets') }}...</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ route('bouquets.index')}}"><i
                            class="fa fa-database"></i> {{ trans('labels.Bouquets') }}</a></li>

                <li class="active">{{ trans('labels.Add Bouquet') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.Add Bouquet') }} </h3>
                        </div>
                        <div class="box-body">
                            @include('admin.common.messages')
                            @if(isset($bouquet))
                                {!! Form::model($bouquet, ['route' => ['bouquets.update', $bouquet->bouquet_id], 'method' => 'put','id' => 'addewinventoryfrom','class' => 'form-horizontal form-validate', 'files' => true]) !!}

                                {!! Form::hidden('oldImage', $bouquet->default_image , array('id'=>'oldImage')) !!}
                            @else
                                {!! Form::open(array('route' =>'bouquets.store', 'method'=>'post', 'id' => 'addewinventoryfrom',  'class' => 'form-horizontal form-validate', 'files' => true)) !!}
                            @endif
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- Left col -->
                                                <div class="col-md-6">
                                                    <!-- MAP & BOX PANE -->
                                                    <!-- /.box -->
                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-info">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title">{{ trans('labels.Add Bouquet Products') }}</h3>
                                                                    <div class="box-tools pull-right">

                                                                    </div>
                                                                </div>
                                                                <!-- /.box-header -->
                                                                <div class="box-body">

                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">{{ trans('labels.Products') }}
                                                                            <span style="color:red;">*</span> </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <select
                                                                                class="form-control field-validate select2 product-type"
                                                                                id="select_product_id"
                                                                                name="products_id">
                                                                                <option
                                                                                    value="">{{ trans('labels.Choose Product') }}</option>
                                                                                @foreach ($result['products'] as $pro)
                                                                                    <option
                                                                                        value="{{$pro->products_id}}">{{$pro->products_name}}</option>
                                                                                @endforeach
                                                                            </select><span class="help-block"
                                                                                           style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.Product Type Text') }}.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div id="attribute" style="display:none">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">
                                                                            {{ trans('labels.Current Stock') }}
                                                                        </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <p id="current_stocks" style="width:100%">
                                                                                0</p><br>


                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">
                                                                            {{ trans('labels.Total Purchase Price') }}
                                                                        </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <p class="purchase_price_content"
                                                                               style="width:100%">{{ $result['currency'][19]->value }}
                                                                                <span id="total_purchases">0</span></p>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">{{ trans('labels.count') }}
                                                                            <span style="color:red;">*</span></label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <input type="number" id="products_count"
                                                                                   name="count" value="1" min="1"
                                                                                   class="form-control number-validate">
                                                                            <span class="help-block"
                                                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.Enter Bouquet Products count') }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.users-list -->
                                                                </div>
                                                            @if(count($result['products'])> 0)
                                                                @if(count($result['attributes'])>0 and $result['products'][0]->products_type==1 or $result['products'][0]->products_type==0)
                                                                    <!-- /.box-body -->
                                                                        <div class="box-footer text-center">
                                                                            <button type="submit"
                                                                                    id="btn_add_bouquets_products"
                                                                                    class="btn btn-primary pull-right">{{ trans('labels.Add') }}</button>
                                                                        </div>
                                                                @endif
                                                            @endif

                                                            <!-- /.box-footer -->
                                                            </div>
                                                            <!--/.box -->
                                                        </div>

                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- MAP & BOX PANE -->

                                                    <!-- /.box -->
                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-danger">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title">{{ trans('labels.Bouquet Products') }}</h3>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th> المنتج</th>
                                                                            <th>الكمية</th>
                                                                            <th>السمات</th>
                                                                            <th>حذف</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody style="text-align: right;"
                                                                               id="products_list_table">
                                                                        @isset($bouquet)
                                                                            @foreach($products as $k=>$product)
                                                                                <tr id="product_n_{{$k}}">
                                                                                    <td>
                                                                                        <input type="hidden"
                                                                                               name="products[{{$k}}][products_id]"
                                                                                               value="{{$product->products_id}}"> {{$product->product}}
                                                                                        <div
                                                                                            class="print-error-msg alert-danger"
                                                                                            id="modal_error_products."></div>
                                                                                    </td>
                                                                                    <td width='10%'>
                                                                                        <input type="number" min="1"
                                                                                               name="products[{{$k}}][quantity]"
                                                                                               value="{{$product->quantity}}">
                                                                                        <div
                                                                                            class="print-error-msg alert-danger"
                                                                                            id="modal_error_products."></div>
                                                                                    </td>
                                                                                    <td width='50%'>

                                                                                        @foreach($product->options as $k=>$option)
                                                                                            <input type="hidden"
                                                                                                   name="products[{{$k}}][options][{{$option->option_id}}][option_id]"
                                                                                                   value={{$option->option_id}}>
                                                                                            <input type="hidden"
                                                                                                   name="products[{{$k}}][options][{{$option->option_id}}][attribute_id]"
                                                                                                   value={{$option->attribute_id}}>
                                                                                            {{$option->option_name}}
                                                                                            ( {{$option->attribute_name}}
                                                                                            ),
                                                                                        @endforeach

                                                                                    </td>
                                                                                    <td>
                                                                                        <button
                                                                                            onclick="deleteOneProduct({{$k}})">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endisset
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                            <!--/.box -->
                                                        </div>

                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label">{{ trans('labels.Usage Limit For Bouquet') }} </label>
                                        <div class="col-sm-10 col-md-8">
                                            {!! Form::number('count',  '1', array('class'=>'form-control ','min'=>1, 'placeholder'=>trans('labels.Unlimited'), 'id'=>'usage_limit'))!!}
                                            <span class="help-block"
                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Usage Limit For Bouquet count') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label">{{ trans('labels.BouquetExpiryDate') }}</label>
                                        <div class="col-sm-10 col-md-8">
                                            {!! Form::text('expiry_date',   isset($bouquet)?dateFormat($bouquet->expiry_date ):'', array('class'=>'form-control field-validate datepicker', 'id'=>'datepicker', 'readonly'=>'readonly'))!!}
                                            <span
                                                class="help-block hidden">{{ trans('labels.BouquetExpiryDate') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label">{{ trans('labels.BouquetPrice') }}
                                            <span style="color:red;">*</span></label>
                                        <div class="col-sm-10 col-md-8">
                                            {!! Form::number('bouquet_price',  '1', array('class'=>'form-control ','min'=>1, 'placeholder'=>trans('labels.BouquetPrice'), 'id'=>'usage_limit'))!!}
                                            <span class="help-block"
                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductPriceText') }}
                                                        </span>
                                            <span
                                                class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label">{{ trans('labels.AllowFreeShipping') }}</label>
                                        <div class="col-sm-10 col-md-8" style="padding-top: 7px;">
                                            <label style="margin-bottom:0">
                                                {!! Form::checkbox('free_shipping', 1, null, ['class' => 'minimal']) !!}
                                            </label>
                                            &nbsp; {{ trans('labels.AllowBouquetFreeShippingText') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                           @include("admin.common.image_to_select")
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tabbable tabs-left">
                                        <ul class="nav nav-tabs">
                                            @foreach(getLanguage() as $key=>$languages)
                                                <li class="@if($key==0) active @endif"><a
                                                        href="#product_{{$languages->languages_id}}"
                                                        data-toggle="tab">{{$languages->name}}<span
                                                            style="color:red;">*</span></a></li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach(getLanguage() as $key=>$languages)
                                                <div style="margin-top: 15px;"
                                                     class="tab-pane @if($key==0) active @endif"
                                                     id="product_{{$languages->languages_id}}">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="name"
                                                                   class="col-sm-2 col-md-3 control-label">{{ trans('labels.BouquetName') }}
                                                                <span style="color:red;">*</span>
                                                                ({{ $languages->name }})</label>
                                                            <div class="col-sm-10 col-md-8">
                                                                <input type="text"
                                                                       @isset($bouquet) value="{{($languages->languages_id==1)?$bouquet->bouquet_name_en:$bouquet->bouquet_name_ar}}"
                                                                       @endisset
                                                                       name="bouquet_name_{{$languages->languages_id}}"
                                                                       class="form-control field-validate">
                                                                <span class="help-block"
                                                                      style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.EnterProductNameIn') }} {{ $languages->name }} </span>
                                                                <span
                                                                    class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name"
                                                                   class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }}
                                                                <span style="color:red;">*</span>
                                                                ({{ $languages->name }})</label>
                                                            <div class="col-sm-10 col-md-8">
                                                                <textarea id="editor{{$languages->languages_id}}"
                                                                          name="bouquet_description_{{$languages->languages_id}}"
                                                                          class="form-control" rows="5">
                                                                          @isset($bouquet) {!! ($languages->languages_id==1)?$bouquet->bouquet_description_en:$bouquet->bouquet_description_ar  !!} @endisset
                                                                </textarea>
                                                                <span class="help-block"
                                                                      style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.EnterProductDetailIn') }} {{ $languages->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <button type="submit"
                                        class="btn btn-primary pull-right">{{ trans('labels.Add') }}</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </section>
        <!-- /.row -->
        <!-- Main row -->
    </div>
    <!-- /.row -->
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    <script type="text/javascript">
        $(function () {

            //for multiple languages
            @foreach(getLanguage() as $languages)
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor{{$languages->languages_id}}');
            @endforeach
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
@endsection
