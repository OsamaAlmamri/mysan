<!-- //footer style Three -->
 <footer id="footerThree"  class="footer-area footer-three footer-desktop d-none d-lg-block d-xl-block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
          <a href="<?php echo e(URL::to('/')); ?>" class="logo" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.logo'); ?>">
            <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
            <?=stripslashes($result['commonContent']['setting'][78]->value)?>
            <?php endif; ?>
        
            <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
            <img class="img-fluid" src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
            <?php endif; ?>
        </a>
          <p class="peragraph">
            <?php echo e($result['commonContent']['setting'][111]->value); ?>

              
          </p>         
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="footer-block">
              <div class="single-footer single-footer-left">
                <h5><?php echo app('translator')->get('website.Our Services'); ?></h5>
                <div class="row">
                    <div class="col-12 col-lg-8">
                      <hr>
                    </div>
                  </div>
                <ul class="links-list pl-0 mb-0">
                  <li> <a href="<?php echo e(URL::to('/')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Home'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/shop')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Shop'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/orders')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Orders'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/viewcart')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Shopping Cart'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/wishlist')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Wishlist'); ?></a> </li>
                </ul>
              </div>

          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="single-footer single-footer-right">
            <h5><?php echo app('translator')->get('website.Information'); ?></h5>
            <div class="row">
                <div class="col-12 col-lg-8">
                  <hr>
                </div>
              </div>
            <ul class="links-list pl-0 mb-0">
              <?php if(count($result['commonContent']['pages'])): ?>
                  <?php $__currentLoopData = $result['commonContent']['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li> <a href="<?php echo e(URL::to('/page?name='.$page->slug)); ?>"><i class="fa fa-angle-right"></i><?php echo e($page->name); ?></a> </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
                  <li> <a href="<?php echo e(URL::to('/contact')); ?>"><i class="fa fa-angle-right"></i><?php echo app('translator')->get('website.Contact Us'); ?></a> </li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-lg-3">
          <div class="single-footer">
            <h5> <?php echo app('translator')->get('website.About Store'); ?> </h5>
            <div class="row">
              <div class="col-12 col-lg-8">
                <hr>
              </div>
            </div>
            <ul class="contact-list  pl-0 mb-0">
              <li> <i class="fas fa-map-marker"></i><span><?php echo e($result['commonContent']['setting'][4]->value); ?> <?php echo e($result['commonContent']['setting'][5]->value); ?> <?php echo e($result['commonContent']['setting'][6]->value); ?>, <?php echo e($result['commonContent']['setting'][7]->value); ?> <?php echo e($result['commonContent']['setting'][8]->value); ?></span> </li>
              <li> <i class="fas fa-phone"></i><span>(<?php echo e($result['commonContent']['setting'][11]->value); ?>)</span> </li>
              <li> <i class="fas fa-envelope"></i><span> <a href="mailto:<?php echo e($result['commonContent']['setting'][3]->value); ?>"><?php echo e($result['commonContent']['setting'][3]->value); ?></a> </span> </li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid p-0">
      <div class="social-content">
          <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-5">
                    <div class="socials">
                        <ul class="list">
                          <li>
                            <?php if(!empty($result['commonContent']['setting'][50]->value)): ?>
                                <a href="<?php echo e($result['commonContent']['setting'][50]->value); ?>" class="fab fb fa-facebook-square" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.facebook'); ?>"></a>
                            <?php else: ?>
                            <a href="<?php echo e($result['commonContent']['setting'][50]->value); ?>" class="fab fb fa-facebook-square" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.facebook'); ?>"></a>
                            <?php endif; ?>
                          </li> 
                          <li>
                            <?php if(!empty($result['commonContent']['setting'][52]->value)): ?>
                                <a href="<?php echo e($result['commonContent']['setting'][52]->value); ?>"  class="fab tw fa-twitter-square" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.twitter'); ?>"></a>
                            <?php else: ?>
                                <a href="#" class="fab tw fa-twitter-square" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.twitter'); ?>"></a>
                            <?php endif; ?>
                          </li>
        
                          <li>
                            <?php if(!empty($result['commonContent']['setting'][51]->value)): ?>
                                <a href="<?php echo e($result['commonContent']['setting'][51]->value); ?>" class="fab sk fa-google" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.google'); ?>"></a>
                            <?php else: ?>
                                <a href="#"><i class="fab sk fa-google"  data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.google'); ?>"></i></a>
                            <?php endif; ?>
                          </li>
        
                          <li>
                            <?php if(!empty($result['commonContent']['setting'][53]->value)): ?>
                                <a href="<?php echo e($result['commonContent']['setting'][53]->value); ?>" class="fab ig fa-instagram" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Instagram'); ?>"></a>
                            <?php else: ?>
                                <a href="#" class="fab ig fa-instagram" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Instagram'); ?>"></a>
                            <?php endif; ?>
                          </li>    
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                  <?php if(!empty($result['commonContent']['setting'][118]) and $result['commonContent']['setting'][118]->value==1): ?>              

                  <div class="newsletter">
                    <div class="block">
                      <h5><?php echo app('translator')->get('website.Subscribe for Newsletter'); ?></h5>                                      
                      <form class="form-inline mailchimp-form" action="<?php echo e(url('subscribeMail')); ?>" >
                          <div class="search-field-module"> 

                            <div class="search-field-wrap">
                              <input type="email" name="email" class="email" placeholder="<?php echo app('translator')->get('website.Your email address here'); ?>">
                              <button type="submit" class="btn btn-secondary swipe-to-top" data-toggle="tooltip" 
                              data-placement="bottom" title="<?php echo app('translator')->get('website.Search Products'); ?>">
                              <?php echo app('translator')->get('website.Subscribe'); ?></button>
                              <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                              <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php endif; ?>

                </div>
                </div>
              </div>  

                    </div>
                </div>


    
    <div class="container-fluid p-0">
        <div class="copyright-content">
            <div class="container">
              <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <div class="footer-image">
                        <img class="img-fluid" src="<?php echo e(asset('web/images/miscellaneous/payments.png')); ?>">
                    </div>

                  </div>
                  <div class="col-12 col-md-6">
                    <div class="footer-info">
                        © <?php echo app('translator')->get('website.Copy Rights'); ?>.  <a href="<?php echo e(url('/page?name=refund-policy')); ?>"><?php echo app('translator')->get('website.Privacy'); ?></a>&nbsp;&bull;&nbsp;<a href="<?php echo e(url('/page?name=term-services')); ?>"><?php echo app('translator')->get('website.Terms'); ?></a>
                    </div>

                  </div>
              </div>
            </div>
          </div>
    </div>
</footer>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/footers/footer3.blade.php ENDPATH**/ ?>