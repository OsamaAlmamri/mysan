<?php echo $__env->make('web.headers.fixedHeader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- //header style One -->
<header id="headerOne" class="header-area header-nine header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4">

            <div class="navbar-lang">
              <?php if(count($languages) > 1): ?>
              <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    <?php echo e(session('language_name')); ?>

                  </button>
                  <div class="dropdown-menu" >
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a onclick="myFunction1(<?php echo e($language->languages_id); ?>)" class="dropdown-item" href="#">
                      <?php echo e($language->name); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
              </div>
              <?php echo $__env->make('web.common.scripts.changeLanguage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>
              <?php if(count($currencies) > 1): ?>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    <?php echo e(session('currency_code')); ?>

                  </button>
                  <div class="dropdown-menu">
                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a onclick="myFunction2(<?php echo e($currency->id); ?>)" class="dropdown-item" href="#">
                      <span><?php echo e($currency->code); ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <?php echo $__env->make('web.common.scripts.changeCurrency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>
            </div>
        </div>
        <div class="col-12 col-md-8">
          <ul class="link-list">
            <li class="">
              <div class="link-item">
                <div class="avatar">

                  <?php
                    if(auth()->guard('customer')->check()){
                      if(auth()->guard('customer')->user()->avatar == null){ ?>
                      <img class="img-fluid" src="<?php echo e(asset('web/images/miscellaneous/avatar.jpg')); ?>">
                    <?php }else{ ?>
                      <img class="img-fluid" src="<?php echo e(auth()->guard('customer')->user()->avatar); ?>">
                    <?php
                          }
                        }
                  ?>

                </div>
                <span><?php if(auth()->guard('customer')->check()){ ?><?php echo app('translator')->get('website.Welcome'); ?> <?php echo e(auth()->guard('customer')->user()->first_name); ?> &nbsp;! <?php }?> </span>
              </div>
            </li>

            <?php if(auth()->guard('customer')->check()){ ?>
            <li class="link-item"> <a href="<?php echo e(url('profile')); ?>" ><?php echo app('translator')->get('website.Profile'); ?></a> </li>
            <li class="link-item"> <a href="<?php echo e(url('wishlist')); ?>" ><?php echo app('translator')->get('website.Wishlist'); ?> <span class="total_wishlist"> (<?php echo e($result['commonContent']['total_wishlist']); ?>)</span></a> </li>
            <li class="link-item"> <a href="<?php echo e(url('compare')); ?>" ><?php echo app('translator')->get('website.Compare'); ?>&nbsp;(<span id="compare"><?php echo e($count); ?></span>)</a> </li>
            <li class="link-item"> <a href="<?php echo e(url('orders')); ?>" ><?php echo app('translator')->get('website.Orders'); ?></a> </li>
            <li class="link-item"> <a href="<?php echo e(url('shipping-address')); ?>" ><?php echo app('translator')->get('website.Shipping Address'); ?></a> </li>
            <li class="link-item"> <a href="<?php echo e(url('logout')); ?>"><?php echo app('translator')->get('website.Logout'); ?></a> </li>
            <?php }else{ ?>
              <li class="link-item"> <a href="<?php echo e(URL::to('/login')); ?>"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.Login/Register'); ?></a> </li>

            <?php } ?>
          </ul>

        </div>
      </div>
    </div>
  </div>
    <div class="header-navbar logo-nav bg-menu-bar">
      <div class="container">
        <nav id="navbar_1_2" class="navbar navbar-expand-lg  bg-nav-bar">
            <a href="<?php echo e(URL::to('/')); ?>" class="logo" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.logo'); ?>">
            <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
            <?=stripslashes($result['commonContent']['setting'][78]->value)?>
            <?php endif; ?>

            <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
            <img class="img-fluid" src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
            <?php endif; ?>
            </a>
          <div class=" navbar-collapse">
              <ul class="navbar-nav ">
                <?php $__currentLoopData = $result['commonContent']["menus"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item dropdown">





























                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <li class="nav-item ">
                    <a class="btn btn-secondary" href="<?php echo e(url('shop?type=special')); ?>"><?php echo app('translator')->get('website.SPECIAL DEALS'); ?></a>
                  </li>

              </ul>
            </div>

        </nav>
      </div>
    </div>
    <div class="header-maxi bg-header-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-lg-6">
            <form class="form-inline" action="<?php echo e(URL::to('/shop')); ?>" method="get">
              <div class="search-field-module">
                  <input type="hidden" name="category" class="category-value" value="">
                  <?php echo $__env->make('web.common.HeaderCategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <button class="btn btn-secondary swipe-to-top dropdown-toggle header-selection" type="button" id="headerOneCartButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get("website.Choose Any Category"); ?>">
                  <?php echo app('translator')->get("website.Choose Any Category"); ?>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                    <?php    productCategories(); ?>
                </div>
                <div class="search-field-wrap">
                    <input  type="search" name="search" placeholder="<?php echo app('translator')->get('website.Search entire store here'); ?>..." data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Search Products'); ?>" alue="<?php echo e(app('request')->input('search')); ?>">
                    <button class="btn btn-secondary swipe-to-top" data-toggle="tooltip"
                    data-placement="bottom" title="<?php echo app('translator')->get('website.Search Products'); ?>">
                    <i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12 col-lg-4">
            <ul class="top-right-list">
              <li class="phone-header">
                  <a href="#">
                      <i class="fas fa-phone"></i>
                      <span class="block">
                        <span class="title"><?php echo app('translator')->get('website.Call Us Now'); ?></span>
                        <span class="items"><?php echo e($result['commonContent']['setting'][11]->value); ?></span>
                      </span>
                  </a>
                </li>
                <li class="cart-header dropdown head-cart-content">
                  <?php echo $__env->make('web.headers.cartButtons.cartButton1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </li>
          </ul>
          </div>
        </div>
      </div>
    </div>

</header>





<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/headers/headerOne.blade.php ENDPATH**/ ?>