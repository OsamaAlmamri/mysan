<!-- //header style Three -->
@include('web.headers.fixedHeader')
@include('web.common.HeaderCategories')


<!-- //header style Three -->
<header id="headerThree" class="header-area header-three header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_3" class="navbar navbar-expand-md navbar-dark navbar-0">
            <div class="navbar-lang">
              @if(count($languages) > 1)
              <div class="country-flag">
                <h4>@lang('website.Country')&nbsp;:
                  <span>
                    <ul>
                      @foreach($languages as $language)
                      <li><a onclick="myFunction1({{$language->languages_id}})" href="#"><img class="img-fluid" src="{{asset('').$language->image_path}}"></a></li>
                      @endforeach
                    </ul>
                  </span>
                </h4>
              </div>
              @include('web.common.scripts.changeLanguage')
              @endif
              @if(count($currencies) > 1)
              <div class="currency">
                  <h4>@lang('website.Currency')&nbsp;:
                    <span>
                      <ul>
                        @foreach($currencies as $currency)
                        <li><a href="#" onclick="myFunction2({{$currency->id}})">
                          {{$currency->code}}
                        </a></li>
                        @endforeach
                      </ul>
                    </span>
                  </h4>
                </div>
                @include('web.common.scripts.changeCurrency')
              @endif
            </div>

            <div class="navbar-collapse">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <div class="nav-avatar nav-link">
                        <div class="avatar">
                          <?php
                          if(auth()->guard('customer')->check()){
                            if(auth()->guard('customer')->user()->avatar == null){ ?>
                            <img class="img-fluid" src="{{asset('web/images/miscellaneous/avatar.jpg')}}">
                          <?php }else{ ?>
                            <img class="img-fluid" src="{{auth()->guard('customer')->user()->avatar}}">
                          <?php
                                }
                              }
                        ?>
                        </div>
                        <span><?php if(auth()->guard('customer')->check()){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                      </div>
                    </li>
                    <?php if(auth()->guard('customer')->check()){ ?>
                      <li class="nav-item"> <a class="nav-link" href="{{url('profile')}}" >@lang('website.Profile')</a> </li>
                      <li class="nav-item"> <a class="nav-link" href="{{url('wishlist')}}" >@lang('website.Wishlist')<span class="total_wishlist"> ({{$result['commonContent']['total_wishlist']}})</span></a> </li>
                      <li class="nav-item"> <a class="nav-link" href="{{url('compare')}}" >@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                      <li class="nav-item"> <a class="nav-link" href="{{url('orders')}}" >@lang('website.Orders')</a> </li>
                      <li class="nav-item"> <a class="nav-link" href="{{url('shipping-address')}}" >@lang('website.Shipping Address')</a> </li>
                      <li class="nav-item"> <a class="nav-link" href="{{url('logout')}}">@lang('website.Logout')</a> </li>
                      <?php }else{ ?>
                        <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/login')}}"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a> </li>

                      <?php } ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="header-maxi bg-header-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-sm-12 col-lg-3">
            <a href="{{ URL::to('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom" title="@lang('website.logo')">
              @if($result['commonContent']['setting'][77]->value=='name')
              <?=stripslashes($result['commonContent']['setting'][78]->value)?>
              @endif

              @if($result['commonContent']['setting'][77]->value=='logo')
              <img class="img-fluid" src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
              @endif
            </a>
          </div>
          <div class="col-12 col-sm-7 col-md-6 col-lg-5">
            <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
              <div class="search-field-module">
                <div class="search-field-wrap">
                  <input  type="search" name="search" placeholder="@lang('website.Search entire store here')..." data-toggle="tooltip" data-placement="bottom" title="@lang('website.Search Products')" alue="{{ app('request')->input('search') }}">
                  <button class="btn btn-secondary swipe-to-top" data-toggle="tooltip"
                  data-placement="bottom" title="@lang('website.Search Products')">
                  <i class="fa fa-search"></i></button>
              </div>
              </div>
            </form>
          </div>
          <div class="col-12 col-sm-5 col-md-6 col-lg-4">
            <ul class="top-right-list">
                <li class="phone-header">
                    <a href="#">
                        <i class="fas fa-phone"></i>
                        <span class="block">
                          <span class="title">@lang('website.Call Us Now')</span>
                          <span class="items">{{$result['commonContent']['setting'][11]->value}}</span>
                        </span>
                    </a>
                  </li>
                  <li class="cart-header dropdown head-cart-content">
                    @include('web.headers.cartButtons.cartButton3')
                  </li>
            </ul>
          </div>
        </div>
      </div>
  </div>
  <div class="header-navbar bg-menu-bar">
    <div class="container">
      <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">

        <div class="navbar-collapse" >
          <ul class="navbar-nav">
            @foreach($result['commonContent']["menus"] as $menus)
                <li class="nav-item dropdown">
                  <a class="nav-link @if(property_exists($menus,"childs"))dropdown-toggle @endif" @if($menus->type == 0)target="_blank"@endif  @if($menus->type == 0) href="{{$menus->external_link}}" @elseif($menus->type == 1) href="{{url($menus->link)}}" @else href="#" @endif >
                    {{$menus->name}}
                  </a>
                    @if(property_exists($menus,"childs"))
                  <div class="dropdown-menu">
                    <?php
                    $array = (array) $menus->childs;
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
                    @foreach($array as $me)
                    <a class="dropdown-item" @if($me->type == 0)target="_blank"@endif  @if($me->type == 0) href="{{$me->external_link}}" @elseif($me->type == 1) href="{{url($me->link)}}" @else href="#" @endif  >
                      {{$me->name}}
                    </a>
                    @endforeach
                  </div>
                  @endif
                </li>
                @endforeach

          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
