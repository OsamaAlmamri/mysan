

<section class="boxes-content">
  
    <div class="container">
      <div class="info-boxes-content">         
        <div class="row">

            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box first">
                    <div class="panel">
                        <h3 class="fas fa-truck"></h3>
                        <div class="block">
                            <h4 class="title"><?php echo app('translator')->get('website.bannerLabel1'); ?></h4>
                            <p><?php echo app('translator')->get('website.bannerLabel1Text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box">
                    <div class="panel">
                        <h3 class="fas fa-money-bill-alt"></h3>
                        <div class="block">
                            <h4 class="title"><?php echo app('translator')->get('website.bannerLabel2'); ?></h4>
                            <p><?php echo app('translator')->get('website.bannerLabel2Text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
              <div class="info-box">
                  <div class="panel">
                      <h3 class="fas fa-life-ring"></h3>
                      <div class="block">
                          <h4 class="title"><?php echo app('translator')->get('website.bannerLabel3'); ?></h4>
                          <p><?php echo app('translator')->get('website.hotline'); ?>&nbsp;:&nbsp;(<?php echo e($result['commonContent']['setting'][11]->value); ?>)</p>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box last">
                    <div class="panel">
                        <h3 class="fas fa-credit-card"></h3>
                        <div class="block">
                            <h4 class="title"><?php echo app('translator')->get('website.bannerLabel4'); ?></h4>
                            <p><?php echo app('translator')->get('website.bannerLabel4Text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/info_boxes.blade.php ENDPATH**/ ?>