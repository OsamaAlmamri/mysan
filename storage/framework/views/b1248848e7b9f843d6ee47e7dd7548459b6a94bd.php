<!-- Products content -->
<?php if($result['special']['success']==1): ?>


<section class="products-content" style="display: none">
    <div class="container">
     <div class="products-area">
        <!-- heading -->
        <div class="heading">
          <h2><?php echo app('translator')->get('website.Special Products of the Week'); ?>
           <small class="pull-right">
            <a href="<?php echo e(url('/shop?type=special')); ?>"><?php echo app('translator')->get('website.View All'); ?></a>
           </small>
          </h2>
          <hr>
        </div>
        <div class="row">
          <?php if($result['special']['success']==1): ?>
           <?php $__currentLoopData = $result['special']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key<=7): ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
              <!-- Product -->
              <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <!-- Product -->
             </div>
            <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
          <?php endif; ?>
        </div>
    </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/special.blade.php ENDPATH**/ ?>