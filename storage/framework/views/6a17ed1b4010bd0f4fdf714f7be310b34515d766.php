<!-- Products content -->
<?php if($result['products']['success']==1): ?>

<section class="new-products-content pro-content" >
  <div class="container">
    <div class="products-area">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
          <div class="pro-heading-title">
            <h2> <?php echo app('translator')->get('website.NEW ARRIVAL'); ?>
            </h2>
            <p><?php echo app('translator')->get('website.Newest Products Detail'); ?>
               </p>
          </div>
        </div>
      </div>
      <div class="row">      
        <?php if($result['products']['success']==1): ?>
        <?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 col-lg-3">
          <!-- Product -->
          <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
   
      </div>
    </div>
  </div>  
</section>


<?php endif; ?>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/newest_product.blade.php ENDPATH**/ ?>