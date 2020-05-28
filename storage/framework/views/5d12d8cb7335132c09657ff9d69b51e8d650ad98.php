<!-- //footer style One -->
<footer id="footerOne"  class="footer-area footer-content footer-one footer-desktop d-none d-lg-block d-xl-block">
  <div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
         
            <figure>
                
                  <a href="<?php echo e(URL::to('/')); ?>" class="logo" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.logo'); ?>">
                      <?php if($result['commonContent']['setting'][77]->value=='name'): ?>
                      <?=stripslashes($result['commonContent']['setting'][78]->value)?>
                      <?php endif; ?>
                  
                      <?php if($result['commonContent']['setting'][77]->value=='logo'): ?>
                      <img class="img-fluid" src="<?php echo e(asset('').$result['commonContent']['setting'][15]->value); ?>" alt="<?=stripslashes($result['commonContent']['setting'][79]->value)?>">
                      <?php endif; ?>
                  </a>
            </figure>
            <ul class="mail">
              <li>
                <a href="mailto:<?php echo e($result['commonContent']['setting'][3]->value); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.mail'); ?>">
                <i class="fas fa-envelope"></i><?php echo e($result['commonContent']['setting'][3]->value); ?></a>
                </a>

              </li>
            </ul>
                <p>
                   <?php echo app('translator')->get('website.Footer text 1'); ?>
                </p>
            
                <ul class="socials">
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
          <div class="col-12 col-lg-2">
              <div class="single-footer">
                  <h5>                    
                    <?php echo app('translator')->get('website.Quick Links'); ?>
                  </h5>
                </div>
              <div class="single-footer single-footer-left">
           
                <ul class="links-list pl-0">
                  <li> <a href="<?php echo e(URL::to('/')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Home'); ?>"><?php echo app('translator')->get('website.Home'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/shop')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Shop'); ?>"><?php echo app('translator')->get('website.Shop'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/orders')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Orders'); ?>"><?php echo app('translator')->get('website.Orders'); ?></a> </li>
                  <li> <a href="<?php echo e(URL::to('/viewcart')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Shopping Cart'); ?>"><?php echo app('translator')->get('website.Shopping Cart'); ?></a> </li>           
                  <li> <a href="<?php echo e(URL::to('/wishlist')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Wishlist'); ?>"><?php echo app('translator')->get('website.Wishlist'); ?></a> </li>   
                            
                </ul>
              </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="single-footer">
                <h5>                    
                    <?php echo app('translator')->get('website.Personalization'); ?>
                </h5>
              </div>
    
          <ul class="links-list pl-0">
            <?php if(count($result['commonContent']['pages'])): ?>
              <?php $__currentLoopData = $result['commonContent']['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li> <a href="<?php echo e(URL::to('/page?name='.$page->slug)); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo e($page->name); ?>"><?php echo e($page->name); ?></a> </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <li> <a href="<?php echo e(URL::to('/contact')); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->get('website.Contact Us'); ?>"><?php echo app('translator')->get('website.Contact Us'); ?></a> </li>

          </ul>
        </div>
      <div class="col-12 col-lg-4">
          <div class="single-footer">
              <h5>                  
                  <?php echo app('translator')->get('website.Instagram Feed'); ?>
              </h5>
          </div>
          <div class="row">
          <div class="col-12">
        <div class="instagram-content">
         
                <picture>
                  <a href="https://www.instagram.com/p/B4juODoFKIU/" target="_blank">
                    <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_1.jpg')); ?>" alt="Instagram">
                  </a>
                   
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juNO3ldrZ/" target="_blank">
                    <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_2.jpg')); ?>" alt="Instagram">
                  </a>
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juMiFFPEr/" target="_blank">
                    <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_3.jpg')); ?>" alt="Instagram">
                  </a>
                </picture>
                <picture>
                  <a href="https://www.instagram.com/p/B4juLuwFUim/" target="_blank">
                    <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_4.jpg')); ?>" alt="Instagram">
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
                        <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_5.jpg')); ?>" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juJ7_FIW6/" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_6.jpg')); ?>" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juI9PFjpz/" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_7.jpg')); ?>" alt="Instagram">
                      </a>
                    </picture>
                    <picture>
                      <a href="https://www.instagram.com/p/B4juHvcFg-2/" target="_blank">
                        <img class="img-fluid" src="<?php echo e(asset('/web/images/instagram/insta_8.jpg')); ?>" alt="Instagram">
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
                    ©&nbsp;<?php echo app('translator')->get('website.Copy Rights'); ?>. <a href="<?php echo e(url('/page?name=refund-policy')); ?>"><?php echo app('translator')->get('website.Privacy'); ?></a>
                    &nbsp;•&nbsp;
                    <a href="<?php echo e(url('/page?name=term-services')); ?>"><?php echo app('translator')->get('website.Terms'); ?></a>
                </div>
                  
              </div>
          </div>
        </div>
      </div>
  </div>
</footer>

<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/footers/footer1.blade.php ENDPATH**/ ?>