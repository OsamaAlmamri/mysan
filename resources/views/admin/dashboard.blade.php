@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>{{ trans('labels.title_dashboard') }} {{$result['commonContent']['setting']['admin_version']}}</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->dashboard_view == 1)
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $result['total_orders'] }}</h3>
                                <p>{{ trans('labels.NewOrders') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ URL::to('admin/orders/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllOrders') }}">{{ trans('labels.viewAllOrders') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3>{{ $result['commonContent']['setting']['currency_symbol'] }}{{ $result['total_money'] }}</h3>
                                <p>{{ trans('labels.Total Money') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ URL::to('admin/products/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllProducts') }}">{{ trans('labels.viewAllProducts') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{ $result['commonContent']['setting']['currency_symbol'] }}{{ $result['profit'] }}</h3>
                                <p>{{ trans('labels.Total Money Earned') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ URL::to('admin/orders/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllOrders') }}">{{ trans('labels.viewAllOrders') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">

                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $result['outOfStock'] }} </h3>
                                <p>{{ trans('labels.outOfStock') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ URL::to('admin/outofstock')}}" class="small-box-footer" data-toggle="tooltip"
                               data-placement="bottom"
                               title="{{ trans('labels.outOfStock') }}">{{ trans('labels.outOfStock') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ $result['totalCustomers'] }}</h3>

                                <p>{{ trans('labels.customerRegistrations') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ URL::to('admin/customers/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllCustomers') }}">{{ trans('labels.viewAllCustomers') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $result['totalProducts'] }}</h3>

                                <p>{{ trans('labels.totalProducts') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ URL::to('admin/products/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllProducts') }}">{{ trans('labels.viewAllProducts') }} <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $result['total_App_visited'] }}</h3>
                                <p>{{ trans('labels.total_App_visited') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <a href="{{ URL::to('admin/devices/display')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllTotal_App_visited') }}">{{ trans('labels.viewAllTotal_App_visited') }}
                                <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3>{{ $result['total_App_visited_ios'] }}</h3>
                                <p>{{ trans('labels.total_App_visited_ios') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-apple"></i>
                            </div>
                            <a href="{{ URL::to('admin/devices/display?filter=1')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllTotal_App_visited') }}">{{ trans('labels.viewAllTotal_App_visited') }}
                                <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{ $result['total_App_visited_android'] }}</h3>
                                <p>{{ trans('labels.total_App_visited_android') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-android"></i>
                            </div>
                            <a href="{{ URL::to('admin/devices/display?filter=2')}}" class="small-box-footer"
                               data-toggle="tooltip" data-placement="bottom"
                               title="{{ trans('labels.viewAllTotal_App_visited') }}">{{ trans('labels.viewAllTotal_App_visited') }}
                                <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <!-- MAP & BOX PANE -->

                        <!-- /.box -->
                        <div class="row">
                            <!-- /.col -->

                            <div class="col-md-12">
                                <!-- USERS LIST -->
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ trans('labels.latest_customers') }}</h3>

                                        <div class="box-tools pull-right">
                                            {{--<span class="label label-danger">{{ count($result['customers']) }} {{ trans('labels.new_members') }}</span>--}}
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                    class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        @if(count($result['customers'])>0)
                                            <ul class="clearfix row" style="    list-style: none;">
                                                <?php $i = 1; ?>
                                                @foreach ($result['customers']  as $customer)
                                                    @if($i<=21)
                                                        <li class="col-md-2 col-sm-3 col-xs-4"
                                                            style="margin-top: 11px;">
                                                            <img src="{{asset('images/user.png')}}">
                                                            <a class="users-list-name"
                                                               href="{{ url('admin/customers/edit/') }}/{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</a>
                                                            <span
                                                                class="users-list-date">{{$customer->created_at}}</span>
                                                        </li>
                                                    @endif
                                                    <?php $i++; ?>
                                                    {{--@endforeach--}}
                                                @endforeach
                                            </ul>
                                        @else
                                            <p style="padding: 8px 0 0 10px;">{{ trans('labels.no_customer_exist') }}</p>
                                    @endif

                                    <!-- /.users-list -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer text-center">
                                        <a href="{{ url('admin/customers/display')}}" class="uppercase"
                                           data-toggle="tooltip" data-placement="bottom"
                                           title="View All Customers">{{ trans('labels.viewAllCustomers') }}</a>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                                <!--/.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('labels.NewOrders') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.OrderID') }}</th>
                                            <th>{{ trans('labels.CustomerName') }}</th>
                                            <th>{{ trans('labels.TotalPrice') }}</th>
                                            <th>{{ trans('labels.Status') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['orders'])>0)
                                            @foreach($result['orders'] as $total_orders)
                                                @foreach($total_orders as $key=>$orders)
                                                    @if($key<=10)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ URL::to('admin/orders/vieworder/') }}/{{ $orders->orders_id }}"
                                                                   data-toggle="tooltip" data-placement="bottom"
                                                                   title="Go to detail">{{ $orders->orders_id }}</a>
                                                            </td>
                                                            <td>{{ $orders->customers_name }}</td>
                                                            <td>{{ $result['commonContent']['setting']['currency_symbol'] }}{{ floatval($orders->total_price) }} </td>
                                                            <td>
                                                                @if($orders->orders_status_id==1)
                                                                    <span class="label label-warning"></span>
                                                                @elseif($orders->orders_status_id==2)
                                                                    <span class="label label-success">
                            @elseif($orders->orders_status_id==3)
                                                                </span>  <span class="label label-danger"></span>
                                                                @else
                                                                    <span class="label label-primary">
                            @endif
                                                                        {{ $orders->orders_status }}
                                 </span>


                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach

                                        @else
                                            <tr>
                                                <td colspan="4">{{ trans('labels.noOrderPlaced') }}</td>

                                            </tr>
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <!--<a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>-->
                                <a href="{{ URL::to('admin/orders/display') }}"
                                   class="btn btn-sm btn-default btn-flat pull-right" data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="View All Orders">{{ trans('labels.viewAllOrders') }}</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">

                        <!-- PRODUCT LIST -->

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('labels.GoalCompletion') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="progress-group">
                                    <span class="progress-text">{{ trans('labels.AddProductstoCart') }}</span>
                                    <span class="progress-number"><b>{{ $result['cart'] }}</b>/500</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua"
                                             style="width: {{ $result['cart']*100/500 }}%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                @if($result['total_orders']>0)
                                    <div class="progress-group">
                                        <span class="progress-text">{{ trans('labels.CompleteOrders') }}</span>
                                        <span class="progress-number"><b>{{ $result['compeleted_orders'] }}</b>/{{ $result['total_orders'] }}</span>
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-green"
                                                 style="width: {{ $result['compeleted_orders']*100/$result['total_orders'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                                @if($result['total_orders']>0)
                                <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">{{ trans('labels.PendingOrders') }}</span>
                                        <span class="progress-number"><b>{{ $result['pending_orders'] }}</b>/{{ $result['total_orders'] }}</span>
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-yellow"
                                                 style="width: {{ $result['pending_orders']*100/$result['total_orders'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            <!-- /.progress-group -->
                                @if($result['total_orders']>0)
                                    <div class="progress-group">
                                        <span class="progress-text">{{ trans('labels.InprocessOrders') }}</span>
                                        <span class="progress-number"><b>{{ $result['inprocess'] }}</b>/{{ $result['total_orders'] }}</span>
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-red"
                                                 style="width: {{ $result['inprocess']*100/$result['total_orders'] }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('labels.RecentlyAddedProducts') }}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="products-list product-list-in-box">
                                    @foreach($result['recentProducts'] as $recentProducts)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{asset('').$recentProducts->products_image}}" alt=""
                                                     width=" 100px" height="100px">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ URL::to('admin/products/edit') }}/{{ $recentProducts->products_id }}"
                                                   class="product-title">{{ $recentProducts->products_name }}
                                                    <span
                                                        class="label label-warning label-succes pull-right">{{ $result['commonContent']['setting']['currency_symbol'] }}{{ floatval($recentProducts->products_price) }}</span></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="{{ URL::to('admin/products/display') }}" class="uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="View All Products">{{ trans('labels.viewAllProducts') }}</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
        @endif
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    {{--<script src="{!! asset('plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>--}}

    {{--<script src="{!! asset('dist/js/pages/dashboard2.js') !!}"></script>--}}
@endsection
