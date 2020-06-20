<?php if(count($result['commonContent']['homepagebanners'])>0): ?>
<div class="tri-banners-content pro-content">   
  <?php $__currentLoopData = ($result['commonContent']['homepagebanners']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
    <?php if($homeBanners->banner_name=='banners_1'): ?>   
    <div class="fullwidth-banner" style="background-image: url('<?php echo e(asset("").$homeBanners->image_path); ?>') ">
      <div class="parallax-banner-text">
        <?php 
          print stripslashes($homeBanners->text);
        ?>
      </div>
    </div> 
    <?php endif; ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
</div>
<?php endif; ?>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/sec_ad_banner.blade.php ENDPATH**/ ?>