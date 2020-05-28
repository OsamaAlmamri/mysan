
        <header id="stickyHeader" class="header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="container">

                <div class="row align-items-center">
                    <div class="col-12 col-lg-2">
                        <div class="logo">
                          <a href="{{ URL::to('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom" title="@lang('website.logo')">
                            @if($result['commonContent']['setting'][77]->value=='name')
                            <?=stripslashes($result['commonContent']['setting'][78]->value)?>
                            @endif

                            @if($result['commonContent']['setting'][77]->value=='logo')
                            <img class="img-fluid" src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
                            @endif
                            </a>

                          </div>
                    </div>
                    <div class="col-12 col-lg-7" style="position: static;">
                      <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">

                        <div class="navbar-collapse">
                          <ul class="navbar-nav">
                            @foreach($result['commonContent']["menus"] as $menus)
                            <li class="nav-item dropdown">
{{--                              <a class="nav-link @if(array_key_exists("childs",$menus)) dropdown-toggle @endif" @if($menus->type == 0)target="_blank"@endif  @if($menus->type == 0) href="{{$menus->external_link}}" @elseif($menus->type == 1) href="{{url($menus->link)}}" @else href="#" @endif >--}}
{{--                                {{$menus->name}}--}}
{{--                              </a>--}}
{{--                              @if(array_key_exists("childs",$menus))--}}
{{--                              <div class="dropdown-menu">--}}
{{--                                @foreach($menus->childs as $me)--}}
{{--                                <a class="dropdown-item" @if($me->type == 0)target="_blank"@endif  @if($me->type == 0) href="{{$me->external_link}}" @elseif($me->type == 1) href="{{url($me->link)}}" @else href="#" @endif  >--}}
{{--                                  {{$me->name}}--}}
{{--                                </a>--}}
{{--                                @endforeach--}}
{{--                              </div>--}}
{{--                              @endif--}}
                            </li>
                            @endforeach

                          </ul>
                        </div>
                      </nav>
                    </div>
                    <div class="col-12 col-lg-3">
                        <ul class="pro-header-right-options">

                              <li class="dropdown search-field">
                                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAccountButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-search"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownAccountButton">
                                    <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
                                          <div class="search-field-module">
                                              <input type="text" class="form-control" id="inlineFormInputGroup0" name="search" placeholder="@lang('website.Search entire store here')...">
                                              <button class="btn" type="submit">
                                                  <i class="fas fa-search"></i>
                                              </button>
                                          </div>
                                        </form>

                                  </div>
                                </li>
                            <li class="dropdown profile-tags">
                              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAccountButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-user"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownAccountButton">
                                <?php if(auth()->guard('customer')->check()){ ?>
                                  <a class="dropdown-item" href="{{url('profile')}}">@lang('website.Profile')</a>
                                  <a class="dropdown-item" href="{{url('wishlist')}}">@lang('website.Wishlist')</a>
                                  <a class="dropdown-item" href="{{url('compare')}}">@lang('website.Compare')&nbsp;(<span id="compare">0</span>)</a>
                                  <a class="dropdown-item" href="{{url('orders')}}">@lang('website.Orders')</a>
                                  <a class="dropdown-item" href="{{url('logout')}}">@lang('website.Logout')</a>
                                <?php }else{ ?>
                                  <a class="dropdown-item" href="{{url('login')}}">@lang('website.Login/Register')</a>
                                <?php } ?>

                              </div>
                            </li>
                            <li>
                              <a href="{{ URL::to('/wishlist')}}" class="btn btn-light" >
                                  <i class="far fa-heart"></i>
                                  <span class="badge badge-secondary total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>
                              </a>
                            </li>

                            <li class="dropdown head-cart-content-fixed">
                              @include('web.headers.cartButtons.cartButtonFixed')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
          </div>
        </header>
