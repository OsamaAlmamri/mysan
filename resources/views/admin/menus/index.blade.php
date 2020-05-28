@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (menu header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Menus') }} <small>{{ trans('labels.ListingAllMenus') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.Menus') }} </li>
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
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/addmenus') }}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                            </br>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">

                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@sortablelink('id', trans('labels.ID') )</th>
                                            <th>@sortablelink('name', trans('labels.Name') )</th>
                                            <th>@sortablelink('name', trans('labels.Sub_Menus') )</th>
                                            <th>@sortablelink('sort_order', trans('labels.sort_order') )</th>
                                            <th>@sortablelink('external_link', trans('labels.external_link') )</th>
                                            <th>@sortablelink('link', trans('labels.link') )</th>
                                            <th>@sortablelink('page', trans('labels.page') )</th>

                                            <th>{{ trans('labels.Status') }}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result["menus"])>0)
                                            @foreach ($result["menus"] as $menu)

                                                <tr>
                                                    <td>{{ $menu->id }}</td>
                                                    <td>
                                                        {{ $menu->name }}
                                                    </td>
                                                    <td>
                                                      @foreach ($result["submenus"] as $menuu)
                                                      @if($menu->id == $menuu->id)
                                                      @if(array_key_exists("childs",$menuu))
                                                      <?php
                                                      $array = (array) $menuu->childs;
                                                      $key = "sub_sort_order";
                                                          $sorter=array();
                                                          $ret=array();
                                                          reset($array);
                                                          foreach ($array as $ii => $va) {
                                                            $va = (array) $va;

                                                              $sorter[$ii]=$va[$key];
                                                          }
                                                          asort($sorter);
                                                          foreach ($sorter as $ii => $va) {
                                                              $ret[$ii]=$array[$ii];
                                                          }
                                                          $array=$ret;
                                                       ?>
                                                      <ol>
                                                      @foreach($array as $me)
                                                      <li><a href="editmenu/{{ $me->id }}"><strong>{{ $me->name }}</strong> (Order:{{$me->sub_sort_order}})</a></li><br>
                                                      @endforeach
                                                      </ol>
                                                      @endif
                                                      @endif
                                                      @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $menu->sort_order }}
                                                    </td>
                                                    <td>
                                                        {{ $menu->external_link }}
                                                    </td>
                                                    <td>
                                                        {{ $menu->link }}
                                                    </td>
                                                    <td>
                                                      <?php $page = DB::table('pages_description')->where('page_id',$menu->page_id)->where('language_id',1)->first(); if($page){$page_name = $page->name;}else{$page_name = '';} ?>
                                                        {{ $page_name }}
                                                    </td>
                                                    <td>
                                                        @if($menu->status==0)
                                                            <span class="label label-warning">
										{{ trans('labels.InActive') }}
									</span>
                                                        @else
                                                                {{ trans('labels.InActive') }}
                                                        @endif
                                                        &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                        @if($menu->status==1)
                                                            <span class="label label-success">
										{{ trans('labels.Active') }}
									</span>
                                                        @else
                                                                {{ trans('labels.Active') }}
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editmenu/{{ $menu->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" href="deletemenu/{{ $menu->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

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
