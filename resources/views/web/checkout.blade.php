@extends('web.layout')
@section('content')

<!-- checkout Content -->
<section class="checkout-area">

@if(session::get('paytm') == 'success')
@php Session(['paytm' => 'sasa']); @endphp
<script>
jQuery(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready
 jQuery("#update_cart_form").submit();
});

</script>
@endif

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('website.Checkout')</a></li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">
                @if(session('step')==0)
                      @lang('website.Shipping Address')
                    @elseif(session('step')==1)
                      @lang('website.Billing Address')
                    @elseif(session('step')==2)
                      @lang('website.Shipping Methods')
                    @elseif(session('step')==3)
                      @lang('website.Order Detail')
                    @endif
              </a>
            </li>
          </ol>
      </div>
    </nav>
</div>
<section class="pro-content">

  <div class="container">
    <div class="page-heading-title">
      <h2> @lang('website.Checkout') </h2>

      </div>
  </div>
 <!-- checkout Content -->
 <section class="checkout-area">
 <div class="container">
   <div class="row">
     <div class="col-12 col-xl-9 checkout-left">
       <input type="hidden" id="hyperpayresponse" value="@if(!empty(session('paymentResponse'))) @if(session('paymentResponse')=='success') {{session('paymentResponse')}} @else {{session('paymentResponse')}}  @endif @endif">
       <div class="alert alert-danger alert-dismissible" id="paymentError" role="alert" style="display:none;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           @if(!empty(session('paymentResponse')) and session('paymentResponse')=='error') {{session('paymentResponseData') }} @endif
       </div>
         <div class="row">
           <div class="checkout-module">
             <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0)  @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">
                    <span class="d-flex d-lg-none">1</span>
                    <span class="d-none d-lg-flex">@lang('website.Shipping Address')</span></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >@lang('website.Billing Address')</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2)  @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif> @lang('website.Shipping Methods')</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>@lang('website.Order Detail')</a>
                   </li>
               </ul>
               <ul class="nav nav-pills mb-3 checkoutd-nav d-flex d-lg-none" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">1</a>
                 </li>
                 <li class="nav-item second">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >2</a>
                 </li>
                 <li class="nav-item third">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif>3</a>
                 </li>
                 <li class="nav-item fourth">
                   <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>4</a>
                   </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade @if(session('step') == 0) show active @endif" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                   <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/checkout_shipping_address')}}" method="post">
                     <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <div class="form-row">
                      <div class="form-group">
                        <label for=""> @lang('website.First Name')</label>
                        <input type="text"  required class="form-control field-validate" id="firstname" name="name" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->name}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                      </div>

                      <?php if(Session::get('guest_checkout') == 1){ ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Email')</label>
                        <input type="text" required class="form-control field-validate" id="email" name="email" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->email}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Email">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your email')</span>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <label for=""> @lang('website.Company')</label>
                        <input type="text" required class="form-control field-validate" id="company" aria-describedby="companyHelp" placeholder="Enter Your Company Name" name="company" value="@if(!empty(session('shipping_address'))) {{session('shipping_address')->company}}@endif">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                      </div>

                      <div class="form-group">
                        <label for=""> @lang('website.Address')</label>
                        <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="@lang('website.Please enter your address')" value="@if(!empty(session('shipping_address'))) {{session('shipping_address')->street}}@endif">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                      </div>
                      <div class="form-group">
                        <label for=""> @lang('website.Country')</label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                              <option value="" selected>@lang('website.Select Country')</option>
                              @if(!empty($result['countries']))
                                @foreach($result['countries'] as $countries)
                                    <option value="{{$countries->countries_id}}" @if(!empty(session('shipping_address'))) @if(session('shipping_address')->countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                @endforeach
                              @endif
                              </select>
                        </div>
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                      </div>
                      <div class="form-group">
                        <label for=""> @lang('website.State')</label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_zone_id"  name="zone_id" aria-describedby="stateHelp">
                              <option value="">@lang('website.Select State')</option>
                                @if(!empty($result['zones']))
                                @foreach($result['zones'] as $zones)
                                    <option value="{{$zones->zone_id}}" @if(!empty(session('shipping_address'))) @if(session('shipping_address')->zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                @endforeach
                              @endif

                                <option value="-1" @if(!empty(session('shipping_address'))) @if(session('shipping_address')->zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                              </select>
                        </div>
                          <small id="stateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                          <label for=""> @lang('website.City')</label>
                            <input required type="text" class="form-control field-validate" id="city" name="city" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->city}}@endif" placeholder="Enter Your City">
                            <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                        </div>

                        <div class="form-group">
                          <label for=""> @lang('website.Phone')</label>
                          <input required type="text" class="form-control" id="delivery_phone" aria-describedby="numberHelp" placeholder="@lang('website.Enter Your Phone Number')" name="delivery_phone" value="@if(!empty(session('shipping_address'))){{session('shipping_address')->delivery_phone}}@endif">
                          <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                        </div>

                      </div>
                      <div class="form-row">
                        <div class="form-group">
                          <button type="submit"  class="btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                        </div>
                      </div>
                   </form>
                 </div>
                 <div class="tab-pane fade @if(session('step') == 1) show active @endif"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">
                     <form name="signup" enctype="multipart/form-data" action="{{ URL::to('/checkout_billing_address')}}" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                       <div class="form-row">
                         <div class="form-group">
                            <label for=""> @lang('website.First Name')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_firstname" name="billing_name" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_name}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                           </div>

                           <div class="form-group">
                            <label for=""> @lang('website.Company')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_company" name="billing_company" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_company}}@endif" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your company name')</span>
                           </div>

                           <div class="form-group">
                            <label for=""> @lang('website.Address')</label>
                             <input type="text" class="form-control same_address" id="exampleInputAddress1" aria-describedby="addressHelp" placeholder="Enter Your Address" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.Country')</label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif>
                                   <option value=""  >@lang('website.Select Country')</option>
                                   @if(!empty($result['countries']))
                                     @foreach($result['countries'] as $countries)
                                         <option value="{{$countries->countries_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                     @endforeach
                                   @endif
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.State')</label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" name="billing_zone_id" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif id="billing_zone_id" aria-describedby="stateHelp">
                                   <option value="" >@lang('website.Select State')</option>
                                   @if(!empty($result['zones']))
                                     @foreach($result['zones'] as $key=>$zones)
                                         <option value="{{$zones->zone_id}}" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == $zones->zone_id) selected @endif @endif >{{$zones->zone_name}}</option>
                                     @endforeach
                                   @endif
                                     <option value="-1" @if(!empty(session('billing_address'))) @if(session('billing_address')->billing_zone_id == 'Other') selected @endif @endif>@lang('website.Other')</option>
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your state')</span>
                           </div>
                           <div class="form-group">
                            <label for=""> @lang('website.City')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                           </div>

                             <div class="form-group">
                              <label for=""> @lang('website.Phone')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                             </div>
                            </div>
                             <div class="form-row">
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))) @if(session('billing_address')->same_billing_address==1) checked @endif @else checked  @endif > @lang('website.Same shipping and billing address')
                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>
                             </div>
                             <div class="form-row">
                              <div class="form-group">
                               <button type="submit"  class="btn swipe-to-top btn-secondary"><span>@lang('website.Continue')</span></button>
                              </div>
                             </div>
                       </form>
                 </div>
                 <div class="tab-pane fade  @if(session('step') == 2) show active @endif" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p>@lang('website.Please select a prefered shipping method to use on this order')</p></div>
                             </div>

                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/checkout_payment_method')}}">
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                @if(!empty($result['shipping_methods'])>0)
                                    <input type="hidden" name="mehtod_name" id="mehtod_name">
                                    <input type="hidden" name="shipping_price" id="shipping_price">

                                     @foreach($result['shipping_methods'] as $shipping_methods)
                                        <div class="heading">
                                            <h2>{{$shipping_methods['name']}}</h2>
                                            <hr>
                                        </div>
                                        <div class="form-check">

                                            <div class="form-row">
                                                @if($shipping_methods['success']==1)
                                                <ul class="list"style="list-style:none; padding: 0px;">
                                                    @foreach($shipping_methods['services'] as $services)
                                                     <?php
                                                         if($services['shipping_method']=='upsShipping')
                                                            $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                                         else{
                                                            $method_name=$services['name'];
                                                            }
                                                        ?>
                                                        <li>
                                                        <input class="shipping_data" id="{{$method_name}}" type="radio" name="shipping_method" value="{{$services['shipping_method']}}" shipping_price="{{$services['rate']}}"  method_name="{{$method_name}}" @if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0)
                                                        @if(session('shipping_detail')->mehtod_name == $method_name) checked @endif
                                                        @elseif($shipping_methods['is_default']==1) checked @endif
                                                        @if($shipping_methods['is_default']==1) checked @endif
                                                        >


                                                         <label for="{{$method_name}}">{{$services['name']}} --- {{Session::get('symbol_left')}}{{$services['rate']* session('currency_value')}}{{Session::get('symbol_right')}}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                    <ul class="list"style="list-style:none; padding: 0px;">
                                                        <li>@lang('website.Your location does not support this') {{$shipping_methods['name']}}.</li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @lang('website.Please select your shipping method')
                                </div>

                                <div class="row">
                                  <div class="col-12 col-sm-12">
                                  <button type="submit"class="btn swipe-to-top btn-secondary">@lang('website.Continue')</button>
                                  </div>
                                </div>
                              </form>

                 </div>
                 <div class="tab-pane fade @if(session('step') == 3) show active @endif" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">
                               <?php
                                   $price = 0;
                               ?>
                               <form method='POST' id="update_cart_form" action='{{ URL::to('/place_order')}}' >
                                 {!! csrf_field() !!}

                                       <table class="table top-table">

                                           @foreach( $result['cart'] as $products)
                                           <?php
                                              $orignal_price = $products->final_price * session('currency_value');
                                              $price+= $orignal_price * $products->customers_basket_quantity;
                                           ?>

                                           <tbody>

                                            <tr class="d-flex">
                                              <td class="col-12 col-md-3" >
                                                <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                    <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                </a>
                                              </td>
                                              <td class="col-12 col-md-5 justify-content-start">
                                                  <div class="item-detail">
                                                      <span class="pro-info">
                                                        @foreach($products->categories as $key=>$category)
                                                            {{$category->categories_name}}@if(++$key === count($products->categories)) @else, @endif
                                                        @endforeach
                                                      </span>
                                                      <h5 class="pro-title">

                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                                          {{$products->products_name}}
                                                        </a>

                                                      </h5>

                                                      <div class="item-attributes">
                                                        @if(isset($products->attributes))
                                                          @foreach($products->attributes as $attributes)
                                                            <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                                          @endforeach
                                                        @endif
                                                      </div>
                                                      <div class="item-controls">

                                                          <button  type="button" class="btn" >
                                                            <a  href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><span class="fas fa-pencil-alt"></span></a>
                                                        </button>
                                                        <button  type="button" class="btn" >
                                                            <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"><span class="fas fa-times"></span></a>
                                                        </button>
                                                      </div>
                                                    </div>
                                                </td>
                                                <?php
                                                    $orignal_price = $products->final_price * session('currency_value');
                                                ?>
                                              <td class="item-price col-12 col-md-2"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                              <td class="col-12 col-md-1">
                                                  <div class="input-group item-quantity">
                                                    <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">
                                                  </div>
                                              </td>
                                              <td class="align-middle item-total col-12 col-md-1 justify-content-end">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</td>
                                            </tr>

                                           </tbody>
                                           @endforeach
                                       </table>
                                                   <?php
                                                      if(!empty(session('coupon_discount'))){
                                                        $coupon_amount = session('currency_value') * session('coupon_discount');
                                                      }else{
                                                        $coupon_amount = 0;
                                                      }

                                                      if(!empty(session('tax_rate'))){
                                                        $tax_rate = session('currency_value') * session('tax_rate');
                                                      }else{
                                                        $tax_rate = 0;
                                                      }

                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                           $shipping_price = session('shipping_detail')->shipping_price;
                                                           $shipping_name = session('shipping_detail')->mehtod_name;
                                                       }else{
                                                           $shipping_price = 0;
                                                           $shipping_name = '';
                                                       }

                                                      // dd($price,$tax_rate,$shipping_price);
                                                       $tax_rate = number_format((float)$tax_rate, 2, '.', '');
                                                       $coupon_discount = number_format((float)$coupon_amount, 2, '.', '');
                                                       $total_price = ($price+$tax_rate+($shipping_price*session('currency_value')))-$coupon_discount;
                                                       session(['total_price'=>($total_price)]);

                                                    ?>
                               </form>

                               <div class="col-12 col-sm-12">
                                    <div class="row">
                                        <div class="heading">
                                            <h4>@lang('website.orderNotesandSummary')</h4>

                                          </div>

                                      <div class="form-group" style="width:100%; padding:0;">
                                        <label for="exampleFormControlTextarea1">@lang('website.Please write notes of your order')</label>
                                          <textarea name="comments" id="exampleFormControlTextarea1"  class="form-control" id="order_comments" rows="3">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
                                        </div>
                                    </div>

                                </div>

                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading">
                                           <h2>@lang('website.Payment Methods')</h2>
                                           <hr>
                                         </div>

                                         <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            @lang('website.Please select your payment method')
                                         </div>


                                         <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/order_detail')}}">
                                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                                         <div class="form-group" style="width:100%; padding:0;">
                                          <label for="exampleFormControlTextarea1" style="width:100%; margin-bottom:30px;">@lang('website.Please select a prefered payment method to use on this order')</label>

                                          @foreach($result['payment_methods'] as $payment_methods)

                                            @if($payment_methods['active']==1)
                                                <input id="payment_currency" type="hidden" onClick="paymentMethods();" name="payment_currency" value="{{$payment_methods['payment_currency']}}">
                                              @if($payment_methods['payment_method']=='braintree')

                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">


                                                <div class="form-check form-check-inline">
                                                    <input id="{{$payment_methods['payment_method']}}_label" type="radio" onClick="paymentMethods();" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label"><img src="{{asset('web/images/miscellaneous').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}"></label>
                                                </div>
                                              @else
                                                  <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                                  <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">
                                                  <div class="form-check form-check-inline">
                                                    <input onClick="paymentMethods();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label"><img width="100px" src="{{asset('web/images/miscellaneous/').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}"></label>
                                                  </div>
                                              @endif
                                            @endif

                                          @endforeach

                                        </div>
                                         </form>

                                           <div class="button">

                                                           <!--- paypal -->
                                                           <div id="paypal_button" class="payment_btns" style="display: none"></div>

                                                           <button id="braintree_button" style="display: none" class="btn btn-dark payment_btns" data-toggle="modal" data-target="#braintreeModel" >@lang('website.Order Now')</button>

                                                           <button id="stripe_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#stripeModel" >@lang('website.Order Now')</button>

                                                           <button id="cash_on_delivery_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>
                                                           <button id="razor_pay_button" class="razorpay-payment-button btn btn-dark payment_btns"  style="display: none"  type="button">@lang('website.Order Now')</button>
                                                           <a href="{{ URL::to('/store_paytm')}}/{{$total_price}}" id="pay_tm_button" class="btn btn-dark payment_btns"  style="display: none"  type="button">@lang('website.Order Now')</a>

                                                           <button id="instamojo_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#instamojoModel">@lang('website.Order Now')</button>

                                                           <a href="{{ URL::to('/checkout/hyperpay')}}" id="hyperpay_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</a>

                                          </div>
                                       </div>
                                       <!-- The braintree Modal -->
                                       <div class="modal fade" id="braintreeModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="checkout" method="post" action="{{ URL::to('/place_order')}}">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.BrainTree Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body">
                                                         <div id="payment-form"></div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="submit" class="btn btn-dark">@lang('website.Pay') {{Session::get('symbol_left')}}{{number_format((float)$total_price+0, 2, '.', '')}}{{Session::get('symbol_right')}}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The instamojo Modal -->
                                       <div class="modal fade" id="instamojoModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="instamojo_form" method="post" action="">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                 <input type="hidden" name="amount" value="{{number_format((float)$total_price+0, 2, '.', '')}}">
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">@lang('website.Instamojo Payment')</h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                  <div class="modal-body">
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Full Name')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="firstName" id="firstName" placeholder="@lang('website.Full Name')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your full name')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="email_id" id="email_id" placeholder="@lang('website.Email')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your email address')</span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Phone Number')</label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="phone_number" id="insta_phone_number" placeholder="@lang('website.Phone Number')" class="form-control">
                                    										<span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                                    								 </div>
                                    								</div>

                                                        <div class="alert alert-danger alert-dismissible" id="insta_mojo_error" role="alert" style="display: none">
                                                           <span class="sr-only">@lang('website.Error'):</span>
                                                           <span id="instamojo-error-text"></span>
                                                       </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" id="pay_instamojo" class="btn btn-dark">@lang('website.Pay') {{$web_setting[19]->value}}{{number_format((float)$total_price+0, 2, '.', '')}}</button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The stripe Modal -->
                                       <div class="modal fade" id="stripeModel">
                                           <div class="modal-dialog">
                                               <div class="modal-content">

                                               <main>
                                               <div class="container-lg">
                                                   <div class="cell example example2">
                                                       <form>
                                                         <div class="row">
                                                           <div class="field">
                                                             <div id="example2-card-number" class="input empty"></div>
                                                             <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">@lang('website.Card number')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                         <div class="row">
                                                           <div class="field half-width">
                                                             <div id="example2-card-expiry" class="input empty"></div>
                                                             <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label">@lang('website.Expiration')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                           <div class="field half-width">
                                                             <div id="example2-card-cvc" class="input empty"></div>
                                                             <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label">@lang('website.CVC')</label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                       <button type="submit" class="btn btn-dark" data-tid="elements_examples.form.pay_button">@lang('website.Pay') {{$web_setting[19]->value}}{{number_format((float)$total_price+0, 2, '.', '')}}</button>

                                                         <div class="error" role="alert"><svg xmlns="https://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                                             <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                                             <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                                           </svg>
                                                           <span class="message"></span></div>
                                                       </form>
                                                                   <div class="success">
                                                                     <div class="icon">
                                                                       <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                                         <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                                                         <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                                                       </svg>
                                                                     </div>
                                                                     <h3 class="title" data-tid="elements_examples.success.title">@lang('website.Payment successful')</h3>
                                                                     <p class="message"><span data-tid="elements_examples.success.message">@lang('website.Thanks You Your payment has been processed successfully')</p>
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </main>
                                                   </div>
                                             </div>
                                         </div>

                                   </div>

                 </div>
               </div>
         </div>
         </div>
     </div>

     <div class="col-12 col-xl-3 checkout-right cart-page-one cart-area">
      <table class="table right-table">
        <thead>
          <tr>
            <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">@lang('website.SubTotal')</th>
            <td align="right">{{Session::get('symbol_left')}}{{$price+0}}{{Session::get('symbol_right')}}</td>

          </tr>
          <tr>
            <th scope="row">@lang('website.Discount')</th>
            <td align="right">{{Session::get('symbol_left')}}{{number_format((float)$coupon_discount, 2, '.', '')+0*session('currency_value')}}{{Session::get('symbol_right')}}</td>

          </tr>
          <tr>
              <th scope="row">@lang('website.Tax')</th>
              <td align="right">{{Session::get('symbol_left')}}{{$tax_rate*session('currency_value')}}{{Session::get('symbol_right')}}</td>

            </tr>
            <tr>
                <th scope="row">@lang('website.Shipping Cost')</th>
                <td align="right">{{Session::get('symbol_left')}}{{$shipping_price*session('currency_value')}}{{Session::get('symbol_right')}}</td>

              </tr>
          <tr class="item-price">
            <th scope="row">@lang('website.Total')</th>
            <td align="right" >{{Session::get('symbol_left')}}{{number_format((float)$total_price+0, 2, '.', '')+0*session('currency_value')}}{{Session::get('symbol_right')}}</td>

          </tr>

        </tbody>

      </table>

       </div>
   </div>
 </div>
</section>
</section>

<script>
jQuery(document).on('click', '#cash_on_delivery_button', function(e){
	jQuery("#update_cart_form").submit();
});
</script>
<script>
    $('#rzp-footer-form').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
        return false;
    })
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        jQuery("#paymentDetail").removeAttr('style');
        jQuery('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        jQuery('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        jQuery.ajax({
            method: 'post',
            url: "{!!route('dopayment')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
    }
</script>
<?php

if(!empty($result['payment_methods'][6]) and $result['payment_methods'][6]['active'] == 1){

$rezorpay_key =  $result['payment_methods'][6]['RAZORPAY_KEY'];

if(!empty($result['commonContent']['setting'][79]->value)){
  $name = $result['commonContent']['setting'][79]->value;
}else{
  $name = Lang::get('website.Ecommerce');
}

$logo = $result['commonContent']['setting'][15]->value;
 ?>
<script>
    var options = {
        key: "{{ $rezorpay_key }}",
        amount: '<?php echo (float) round($total_price, 2)*100;?>',
        name: '{{$name}}',
        image: '{{$logo}}',
        handler: demoSuccessHandler
    }
</script>
<script>
    window.r = new Razorpay(options);
    document.getElementById('razor_pay_button').onclick = function () {
        r.open()
    }
</script>

<?php
}
?>

@endsection
