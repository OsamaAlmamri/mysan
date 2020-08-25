@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.AddImages') }} <small>{{ trans('labels.AddProductImages') }}...</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                @if(isset($products_type) and $products_type=='bouquet')
                    <li><a href="{{ route('bouquets.index')}}"><i
                                class="fa fa-database"></i> {{ trans('labels.Bouquets') }}</a></li>
                @else
                    <li><a href="{{ URL::to('admin/products/images/display')."/$products_id" }}">
                            <i class="fa fa-database"></i>{{ trans('labels.ListingAllProductsImages') }}</a></li>
                @endif
                <li class="active">{{ trans('labels.AddImages') }}</li>


            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('labels.ListingAllProductsImages') }} </h3>
                            <div class="box-tools pull-right">
                                <a type="button" class="btn btn-block btn-primary"
                                   href="{{route('products.images.add',['id'=>$products_id,'type'=>$products_type]) }}">
                                    {{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            @include('admin.common.messages')
                            <div class="row">
                                @if (count($result['products_images']) > 0)
                                    @foreach($result['products_images'] as $products_image)
                                        <div class="col-xs-4 col-md-2 margin-bottomset">
                                            <div class="thumbnail">
                                                <div class="caption">
                                                    <a class="badge bg-light-blue editProductImagesModal"
                                                       href="{{url('admin/products/images/editproductimage/')}}/{{$products_image->id}}}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a products_id='{{ $products_image->products_id }}'
                                                       id="{{ $products_image->id }}"
                                                       class="badge bg-red deleteProductImagesModal"><i
                                                            class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                </div>
                                                <img width="200px" height="300px" src="{{asset($products_image->path)}}"
                                                     alt="...">
                                                Sort Order : {{ $products_image->sort_order}}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-xs-12 text-right">
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <a href="{{ URL::to("admin/products/display")}}"
                                   class="btn btn-default">{{ trans('labels.Save_And_complete') }}</a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- deleteProductImageModal -->
            <div class="modal fade" id="deleteProductImageModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteProductImageModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content deleteImageEmbed">
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
