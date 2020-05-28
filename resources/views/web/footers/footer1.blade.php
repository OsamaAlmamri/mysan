<!-- //footer style One -->
<footer id="footerOne"  class="footer-area footer-content footer-one footer-desktop d-none d-lg-block d-xl-block">
  <div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
         
            <figure>
                
                  <a href="{{ URL::to('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom" title="@lang('website.logo')">
                      @if($result['commonContent']['setting'][77]->value=='name')
                      <?=stripslashes($result['commonContent']['setting'][78]->value)?>
                      @endif
                  
                      @if($result['commonContent']['setting'][77]->value=='logo')
                      <img class="img-fluid" src="{{asset('').$result['commonContent']['setting'][15]->value}}" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
                      @endif
                  </a>
            </figure>
            <ul class="mail">
              <li>
                <a href="mailto:{{$result['commonContent']['setting'][3]->value}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.mail')">
                <i class="fas fa-envelope"></i>{{$result['commonContent']['setting'][3]->value}}</a>
                </a>

              </li>
            </ul>
                <p>
                   @lang('website.Footer text 1')
                </p>
            
                <ul class="socials">
                  <li>
                    @if(!empty($result['commonContent']['setting'][50]->value))
                        <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-square" data-toggle="tooltip" data-placement="bottom" title="@lang('website.facebook')"></a>
                    @else
                    <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-square" data-toggle="tooltip" data-placement="bottom" title="@lang('website.facebook')"></a>
                    @endif
                  </li> 
                  <li>
                    @if(!empty($result['commonContent']['setting'][52]->value))
                        <a href="{{$result['commonContent']['setting'][52]->value}}"  class="fab tw fa-twitter-square" data-toggle="tooltip" data-placement="bottom" title="@lang('website.twitter')"></a>
                    @else
                        <a href="#" class="fab tw fa-twitter-square" data-toggle="tooltip" data-placement="bottom" title="@lang('website.twitter')"></a>
                    @endif
                  </li>

                  <li>
                    @if(!empty($result['commonContent']['setting'][51]->value))
                        <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab sk fa-google" data-toggle="tooltip" data-placement="bottom" title="@lang('website.google')"></a>
                    @else
                        <a href="#"><i class="fab sk fa-google"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.google')"></i></a>
                    @endif
                  </li>

                  <li>
                    @if(!empty($result['commonContent']['setting'][53]->value))
                        <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab ig fa-instagram" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Instagram')"></a>
                    @else
                        <a href="#" class="fab ig fa-instagram" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Instagram')"></a>
                    @endif
                  </li>                  
                </ul>
          </div>
          <div class="col-12 col-lg-2">
              <div class="single-footer">
                  <h5>                    
                    @lang('website.Quick Links')
                  </h5>
                </div>
              <div class="single-footer single-footer-left">
           
                <ul class="links-list pl-0">
                  <li> <a href="{{ URL::to('/')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Home')">@lang('website.Home')</a> </li>
                  <li> <a href="{{ URL::to('/shop')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Shop')">@lang('website.Shop')</a> </li>
                  <li> <a href="{{ URL::to('/orders')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Orders')">@lang('website.Orders')</a> </li>
                  <li> <a href="{{ URL::to('/viewcart')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Shopping Cart')">@lang('website.Shopping Cart')</a> </li>           
                  <li> <a href="{{ URL::to('/wishlist')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Wishlist')">@lang('website.Wishlist')</a> </li>   
                            
                </ul>
              </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="single-footer">
                <h5>                    
                    @lang('website.Personalization')
                </h5>
              </div>
    
          <ul class="links-list pl-0">
            @if(count($result['commonContent']['pages']))
              @foreach($result['commonContent']['pages'] as $page)
                  <li> <a href="{{ URL::to('/page?name='.$page->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$page->name}}">{{$page->name}}</a> </li>
              @endforeach
            @endif
            <li> <a href="{{ URL::to('/contact')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Contact Us')">@lang('website.Contact Us')</a> </li>

          </ul>
        </div>
      <div class="col-12 col-lg-4">
          <div class="single-footer">
              <h5>                  
                  @lang('website.Instagram Feed')
              </h5>
          </div>
          <div class="row">
          <div class="col-12">
        <div class="instagram-content">
         
                <picture>
                  <a href="https://www.instagram.com/p/B4juODoFKIU/" target="_blank">
                    <img class="img-fluid" src="{{asset('/web/images/instagram/insta_1.jpg')}}" alt="Instagram">
                  </a>
                   
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juNO3ldrZ/" target="_blank">
                    <img class="img-fluid" src="{{asset('/web/images/instagram/insta_2.jpg')}}" alt="Instagram">
                  </a>
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juMiFFPEr/" target="_blank">
                    <img class="img-fluid" src="{{asset('/web/images/instagram/insta_3.jpg')}}" alt="Instagram">
                  </a>
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juLuwFUim/" target="_blank">
                    <img class="img-fluid" src="{{asset('/web/images/instagram/insta_4.jpg')}}" alt="Instagram">
                  </a>
                </picture>
              </div>
          </div>

      
          </div>
          <div class="row">
              <div class="col-12">
                <div class="instagram-content">
            
                    <picture>
                      <a href="https://www.instagram.com/p/B4juK4ylYYJ/" target="_blank">
                        <img class="img-fluid" src="{{asset('/web/images/instagram/insta_5.jpg')}}" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juJ7_FIW6/" target="_blank">
                        <img class="img-fluid" src="{{asset('/web/images/instagram/insta_6.jpg')}}" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juI9PFjpz/" target="_blank">
                        <img class="img-fluid" src="{{asset('/web/images/instagram/insta_7.jpg')}}" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juHvcFg-2/" target="_blank">
                        <img class="img-fluid" src="{{asset('/web/images/instagram/insta_8.jpg')}}" alt="Instagram">
                      </a>
                    </picture>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  <div class="container-fluid p-0">
    <div class="copyright-content">
        <div class="container">
          <div class="row align-items-center">
              <div class="col-12">
                <div class="footer-info">
                    ©&nbsp;@lang('website.Copy Rights'). <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>
                    &nbsp;•&nbsp;
                    <a href="{{url('/page?name=term-services')}}">@lang('website.Terms')</a>
                </div>
                  
              </div>
          </div>
        </div>
      </div>
  </div>
</footer>

