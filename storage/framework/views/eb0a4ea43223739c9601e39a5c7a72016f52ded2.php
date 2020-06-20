<!-- //banner one -->
<div class="banner-one">
    <div class="container">
      <div class="group-banners">
          <div class="row">
            <?php if(count($result['commonContent']['homeBanners'])>0): ?>
             <?php $__currentLoopData = ($result['commonContent']['homeBanners']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($homeBanners->type==3 or $homeBanners->type==4 or $homeBanners->type==5): ?>
                <div class="col-12 col-md-4">
                  <figure class="banner-image ">
                    <a href="<?php echo e($homeBanners->banners_url); ?>"><img class="img-fluid" src="<?php echo e(asset('').$homeBanners->path); ?>" alt="Banner Image"></a>
                  </figure>
                </div>
              <?php endif; ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
        </div>
    </div>
</div>


<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/banners/banner1.blade.php ENDPATH**/ ?>