<?php $__env->startSection('content'); ?>

<section class="pro-content empty-content">
  <div class="container">
      
      <div class="row">
        <div class="col-12">
            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 ><?php echo app('translator')->get('website.Thank You'); ?></h1>
              <p>
                <?php echo app('translator')->get('website.You have successfully place your order'); ?>
                 <a href="<?php echo e(url('/orders')); ?>" class="btn-link"><b><?php echo app('translator')->get('website.Order page'); ?></b></a>.
              </p>
            </div>
          </p>
        </div>
      </div>
    
  </div>  
  
  
</section> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/thankyou.blade.php ENDPATH**/ ?>