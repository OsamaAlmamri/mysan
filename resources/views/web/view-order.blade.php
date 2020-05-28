@extends('web.layout')
@section('content')

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ URL::to('/orders')}}">@lang('website.orders')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Order information')</li>
          </ol>
      </div>
    </nav>
</div> 

<!--My Order Content -->
<section class="order-two-content pro-content">
  <div class="container">
    <div class="page-heading-title">
        <h2>   @lang('website.Order information')
        </h2>
     
        </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12 col-lg-3 ">
      <div class="heading">
          <h2>
              @lang('website.My Account')
          </h2>
          <hr >
        </div>

      <ul class="list-group">
          <li class="list-group-item">
              <a class="nav-link" href="{{ URL::to('/profile')}}">
                  <i class="fas fa-user"></i>
                @lang('website.Profile')
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="{{ URL::to('/wishlist')}}">
                  <i class="fas fa-heart"></i>
               @lang('website.Wishlist')
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="{{ URL::to('/orders')}}">
                  <i class="fas fa-shopping-cart"></i>
                @lang('website.Orders')
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="{{ URL::to('/shipping-address')}}">
                  <i class="fas fa-map-marker-alt"></i>
               @lang('website.Shipping Address')
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="{{ URL::to('/logout')}}">
                  <i class="fas fa-power-off"></i>
                @lang('website.Logout')
              </a>
          </li>
        </ul>
    </div>
    <div class="col-12 col-lg-9 ">
      

        <div class="row">
          <div class="col-12 col-md-5">
              <div class="heading">
                  <h2>
                   
                        @lang('website.orderID')&nbsp;{{$result['orders'][0]->orders_id}}
                   
                  </h2>
                  <hr >
                </div>

              <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6">@lang('website.orderStatus')</td>
                        @if($result['orders'][0]->orders_status_id == '1')
                          <td class="col-6 col-md-6">
                            <span class="badge badge-primary">{{$result['orders'][0]->orders_status}}</span>
                          </td>
                        @elseif($result['orders'][0]->orders_status_id == '2')
                        <td class="col-6 col-md-6">
                            <span class="badge badge-success">{{$result['orders'][0]->orders_status}}</span>
                        </td>
                        @elseif($result['orders'][0]->orders_status_id == '3')
                        <td class="col-6 col-md-6">
                            <span class="badge badge-danger">{{$result['orders'][0]->orders_status}}</span>
                        </td>
                        @else
                        <td class="col-6 col-md-6">
                          <span class="badge badge-warning">{{$result['orders'][0]->orders_status}}</span>
                        </td>
                        @endif
                      </tr>
                      <tr class="d-flex">
                          <td class="col-6 col-md-6">Order Date</td>
                          <td  class="underline col-6 col-md-6" align="left">{{ date('d/m/Y', strtotime($result['orders'][0]->date_purchased))}}</td>
                        </tr>
                    </tbody>
              </table>

          </div>
          <div class="col-12 col-md-7">
              <div class="heading">
                  <h2>
                
                      Shipping Details
                 
                  </h2>
                  <hr >
                </div>

              <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="address col-12 col-md-6">{{$result['orders'][0]->delivery_name}}</td>


                      </tr>
                      <tr class="d-flex">
                          <td  class="address col-12 col-md-12">{{$result['orders'][0]->delivery_street_address}}, {{$result['orders'][0]->delivery_city}}, {{$result['orders'][0]->delivery_state}},
                          {{$result['orders'][0]->delivery_postcode}},  {{$result['orders'][0]->delivery_country}}</td>

                        </tr>
                    </tbody>
              </table>

          </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-5">
                <div class="heading">
                    <h2>
                    
                        @lang('website.Billing Detail')
                   
                    </h2>
                    <hr >
                  </div>

                <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="address col-12">{{$result['orders'][0]->billing_name}}</td>
                      </tr>
                      <tr  class="d-flex">
                          <td class="address col-12">{{$result['orders'][0]->billing_street_address}}, {{$result['orders'][0]->billing_city}}, {{$result['orders'][0]->billing_state}},
                          {{$result['orders'][0]->billing_postcode}},  {{$result['orders'][0]->billing_country}}</td>
                        </tr>
                    </tbody>
              </table>

            </div>
            <div class="col-12 col-md-7">
                <div class="heading">
                    <h2>
                     
                         @lang('website.Payment/Shipping Method')
                      
                    </h2>
                    <hr >
                  </div>

                <table class="table order-id">
                    <tbody>
                        <tr class="d-flex">
                          <td class="col-6">@lang('website.Shipping Method')</td>
                          <td class="col-6">{{$result['orders'][0]->shipping_method}}</td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-6">@lang('website.Payment Method')</td>
                            <td class="underline col-6">{{$result['orders'][0]->payment_method}}</td>
                          </tr>
                      </tbody>
                </table>

            </div>
          </div>

        <table class="table items">

  
          <tbody>
            <?php
                $price = 0;
            ?>
            @if(count($result['orders']) > 0)
                @foreach( $result['orders'][0]->products as $products)
                <?php
                    $price+= $products->final_price;
                ?>
            <tr class="d-flex responsive-lay">
              <td class="col-12 col-md-2">
                <img class="img-fluid order-img" src="{{asset('').$products->image}}" alt="{{$products->products_name}}" class="mr-3">
              </td>
              <td class="col-12 col-md-3 item-detail-left">
                <div class="text-body">
                      <h4>{{$products->products_name}}<br>
                  <small>
                         @if(count($products->attributes) >0)
                            <ul>
                              @foreach($products->attributes as $attributes)
                                  <li>{{$attributes->products_options}}<span>{{$attributes->products_options_values}}</span></li>
                              @endforeach
                            </ul>
                          @endif
                  </small></h4>

                </div>

                  </div>
              </td>
              <td class="tag-color col-12 col-md-3">{{Session::get('symbol_left')}}{{$products->final_price/$products->products_quantity*session('currency_value')}}{{Session::get('symbol_right')}}</td>
              <td class="col-12 col-md-2">
                  <div class="input-group">
                      <input name="quantity[]" type="text" readonly value="{{$products->products_quantity}}" class="form-control qty" min="1" max="300">

                  </div>
              </td>
              <td  class="tag-s col-12 col-md-2">{{Session::get('symbol_left')}}{{$products->final_price*session('currency_value')}}{{Session::get('symbol_right')}}</td>
            </tr>
            @endforeach
        @endif


          </tbody>
        </table>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                @if(count($result['orders'][0]->statusess)>0)
                    <div style="border-radius:5px;"class="card">
                        <div style="background: none;" class="card-header">
                          @lang('website.Comments')
                        </div>
                        <div class="card-body">
                        @foreach($result['orders'][0]->statusess as $key=>$statusess)
                            @if(!empty($statusess->comments))
                                @if(++$key==1)
                                  <h6>@lang('website.Order Comments'): {{ date('d/m/Y', strtotime($statusess->date_added))}}</h6>

                                @else
                                  <h6>@lang('website.Admin Comments'): {{ date('d/m/Y', strtotime($statusess->date_added))}}</h6>
                                @endif
                                <p class="card-text">{{$statusess->comments}}</p>
                            @endif
                        @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>


      <!-- ............the end..... -->
    </div>
  </div>
</div>
</section>

@endsection
