@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.EditMenu') }} <small>{{ trans('labels.EditMenu') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/menus')}}"><i class="fa fa-gears"></i> {{ trans('labels.ListingAllMenu') }}</a></li>
                <li class="active">{{ trans('labels.EditMenu') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.EditMenu') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                    <!--<div class="box-header with-border">
                          <h3 class="box-title">{{ trans('labels.EditPage') }}</h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/updatemenu', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                            {!! Form::hidden('id',  $result['menus'][0]->id, array('class'=>'form-control', 'id'=>'id')) !!}
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Menu') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="parent_id" >
                                                      <option value="0">Leave as Parent</option>
                                                      @foreach($result['allmenus'] as $menu)
                                                        <option @if($result['menus'][0]->parent_id == $menu->id) selected @endif value="{{$menu->id}}">{{$menu->name}}</option>
                                                      @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        {{ trans('labels.ChooseMainMenu') }}</span>
                                                </div>
                                            </div>
                                            <?php
                                            if($result['menus'][0]->sort_order == null){
                                              $val = $result['menus'][0]->sub_sort_order;
                                            }
                                            else{
                                              $val = $result['menus'][0]->sort_order;
                                            }
                                             ?>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Sort_Order') }}<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input required type="number" value="{{$val}}" name="sort_order" class="form-control menu">
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>

                                            @foreach($result['description'] as $description_data)
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Name') }} ({{ $description_data['language_name'] }}) </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="menuName_<?=$description_data['languages_id']?>" class="form-control field-validate" value="{{$description_data['name']}}" >
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Name') }} ({{ $description_data['language_name'] }})</span>

                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>

                                            @endforeach
                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Type') }} </label>
                                              <div class="col-sm-10 col-md-4">
                                                <select required id="select_id" onchange="showPageSelect()" class="form-control" name="type">
                                                      <option>{{ trans('labels.Select Type') }}</option>
                                                      <option @if($result['menus'][0]->type == 0) selected @endif value="0">{{ trans('labels.External Link') }}</option>
                                                      <option @if($result['menus'][0]->type == 1) selected @endif value="1">{{ trans('labels.Link') }}</option>
                                                      <option @if($result['menus'][0]->type == 2) selected @endif value="2">{{ trans('labels.Page') }}</option>
                                                </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                              {{ trans('labels.GeneralStatusText') }}</span>
                                              </div>
                                            </div>
                                            <div class="form-group external_link @if($result['menus'][0]->type != 0) hidden @endif">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.External_Link') }}<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input value="{{$result['menus'][0]->external_link}}" name="external_link" class="form-control menu">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group link @if($result['menus'][0]->type != 1) hidden @endif">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Link') }}<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input value="{{$result['menus'][0]->link}}" name="link" class="form-control menu">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group page @if($result['menus'][0]->type != 2) hidden @endif">
                                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Page') }} </label>
                                              <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="page_id">
                                                  @foreach($result['pages'] as $page)
                                                      <option @if($result['menus'][0]->page_id == $page->page_id) selected @endif value="{{$page->page_id}}">{{ $page->name}}</option>
                                                  @endforeach
                                                </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                              {{ trans('labels.GeneralStatusText') }}</span>
                                              </div>
                                            </div>
                                            <script>
                                              function showPageSelect(){
                                                   var d = document.getElementById("select_id").value;
                                                   if(d == 0){
                                                     jQuery('.external_link').removeClass("hidden");
                                                     jQuery('.link').addClass("hidden");
                                                     jQuery('.page').addClass("hidden");
                                                   }
                                                   else if(d == 1) {
                                                     jQuery('.external_link').addClass("hidden");
                                                     jQuery('.link').removeClass("hidden");
                                                     jQuery('.page').addClass("hidden");
                                                   }
                                                   else if(d == 2) {
                                                     jQuery('.external_link').addClass("hidden");
                                                     jQuery('.link').addClass("hidden");
                                                     jQuery('.page').removeClass("hidden");
                                                   }
                                              }
                                            </script>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1"  @if($result['menus'][0]->status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                                        <option value="0"  @if($result['menus'][0]->status=='0') selected @endif>{{ trans('labels.InActive') }}</option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.StatusPageText') }}</span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/menus')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
    <script src="{!! asset('plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    <script type="text/javascript">
        $(function () {

            //for multiple languages
            @foreach($result['languages'] as $languages)
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor_{{$languages->languages_id}}');

            @endforeach

            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();

        });
    </script>
@endsection
