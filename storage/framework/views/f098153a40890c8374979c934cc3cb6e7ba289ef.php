<!-- Products content -->

<?php if(!empty($result['commonContent']['categories'])): ?>
<section class="categories-content pro-content">
    <div class="container">
      <div class="products-area">
         <div class="row justify-content-center">
           <div class="col-12 col-lg-6">
             <div class="pro-heading-title">
               <h2> <?php echo app('translator')->get('website.PRODUCT CATEGORIES'); ?>
               </h2>
               <p>
                 <?php echo app('translator')->get('website.Categories Text For Home Page'); ?>
                </p>
               </div>
             </div>
         </div>
      
      </div>
    </div>
   <div class="row">
    <?php $counter = 0;?>
    <?php $__currentLoopData = $result['commonContent']['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($counter<=7): ?>
        
          <div class="col-12 col-md-6 col-lg-3 cat-banner">
            
            <figure class="categories-image">
              <a href="<?php echo e(URL::to('/shop?category='.$categories_data->slug)); ?>">
                <img class="img-fluid" src="<?php echo e(asset('').$categories_data->path); ?>" alt="<?php echo e($categories_data->name); ?>">
                <div class="categories-title">
                  <h3><?php echo e($categories_data->name); ?></h3>
                </div>
              </a>
            </figure>

          </div>

        <?php endif; ?>
        <?php $counter++;?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
  </section>
  <?php endif; ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/categories.blade.php ENDPATH**/ ?>