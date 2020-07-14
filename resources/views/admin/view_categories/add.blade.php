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

                                                {!! Form::hidden('oldImage', $viewCategory->image , array('id'=>'oldImage')) !!}
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
                                            <div class="form-group" id="imageselected">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}
                                                    <span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                                <!-- Modal -->
                                                    <div class="modal fade" id="Modalmanufactured" tabindex="-1"
                                                         role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" id="closemodal"
                                                                            aria-label="Close"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <h3 class="modal-title text-primary"
                                                                        id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                                </div>
                                                                <div class="modal-body manufacturer-image-embed">
                                                                    @if(isset($allimage))
                                                                        <select
{{--                                                                            @if(!isset($viewCategory)) field-validate @endif--}}
                                                                            class="image-picker show-html "
                                                                            name="image_id" id="select_img">
                                                                            <option value=""></option>
                                                                            @foreach($allimage as $key=>$image)
                                                                                <option
                                                                                    data-img-src="{{asset($image->path)}}"
                                                                                    class="imagedetail"
                                                                                    data-img-alt="{{$key}}"
                                                                                    value="{{$image->id}}"> {{$image->id}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{url('admin/media/add')}}" target="_blank"
                                                                       class="btn btn-primary pull-left">{{ trans('labels.Add Image') }}</a>
                                                                    <button type="button"
                                                                            class="btn btn-default refresh-image"><i
                                                                            class="fa fa-refresh"></i></button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="selected"
                                                                            data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="imageselected">
                                                        @if(isset($viewCategory))
                                                            {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                        @else
                                                            {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                        @endif
                                                        <br>
                                                        <div id="selectedthumbnail"
                                                             class="selectedthumbnail col-md-5"></div>
                                                        <div class="closimage">
                                                            <button type="button" class="close pull-left image-close "
                                                                    id="image-close"
                                                                    style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; "
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryImageText') }}</span>
                                                </div>
                                            </div>
                                            @if($old_image !=null)
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                    <div class="col-sm-10 col-md-4">
                                                    <span class="help-block "
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                                        <br>
                                                        <img src="{{asset($old_image)}}"
                                                             alt=""
                                                             width=" 100px">
                                                    </div>
                                                </div>
                                            @endif


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
                                                <label for="view_categories_content"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.view_categories_content') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!!Form ::select('content',['products'=>trans('labels.view_type_products'), 'categories'=>trans('labels.view_type_categories')],null,['class' => 'select2 form-control', 'id' => 'view_categories_content'])!!}
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_type_categoriesText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_categories_parent"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.view_categories_parent') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!!Form ::select('parent',['0'=>trans('labels.view_categories_parent_0'), '1'=>trans('labels.view_categories_parent_1')],null,['class' => 'select2 form-control', 'id' => 'view_categories_parent'])!!}
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_categories_parentText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_products_view_categories"
                                                 @if($content!='products') style="display: none" @endif>
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }}</label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="products[]" multiple
                                                            class="form-control select2 ">
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

                                            <div class="form-group" id="div_categories_view_categories"
                                                 @if($content!='categories') style="display: none" @endif>
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label">{{ trans('labels.IncludeCategories') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="categories[]" multiple
                                                            class="form-control select2">
                                                        @foreach($result['categories'] as $categories)
                                                            <option value="{{ $categories->id }}"
                                                                    @if(in_array($categories->id,$old_products)) selected="" @endif >{{ $categories->name_ar }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.view_categoriesCategoriesText') }}</span>
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
