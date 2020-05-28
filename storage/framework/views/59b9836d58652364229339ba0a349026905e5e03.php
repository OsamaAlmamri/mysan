<?php if($result['special']['success']==1 or $result['top_seller']['success']==1 or $result['most_liked']['success']==1 ): ?>

<section class="tabs-content pro-content" >
  <div class="container">
    <div class="products-area">
       <div class="row justify-content-center">
         <div class="col-12 col-lg-6">
           <div class="pro-heading-title">
             <h2>  <?php echo app('translator')->get('website.WELCOME TO STORE'); ?>
             </h2>
             <p> 
               <?php echo app('translator')->get('website.WELCOME TO STORE DETAIL'); ?>
              </p>
             </div>
           </div>
       </div>
    
    </div>
  </div>
  <div class="tabs-main">
    <div class="container">
      <div class="row">
         <div class="col-md-12 p-0">
             <div class="nav" role="tablist" id="tabCarousel">
               
                 <?php if($result['top_seller']['success']==1): ?>
                  <a class="nav-link btn  active show" data-toggle="tab" href="#featured" role="tab" ><span data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.TopSales'); ?>"><?php echo app('translator')->get('website.TopSales'); ?></span></a>
                 <?php endif; ?>
                 <?php if($result['special']['success']==1): ?>
                  <a class="nav-link btn"  data-toggle="tab" href="#special" role="tab" aria-controls="special" aria-selected="true" ><span data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Special'); ?>"><?php echo app('translator')->get('website.Special'); ?></span></a> 
                 <?php endif; ?>
                 <?php if($result['most_liked']['success']==1): ?>
                 <a class="nav-link btn" data-toggle="tab"  href="#liked" role="tab" aria-controls="liked" aria-selected="true" ><span data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.MostLiked'); ?>"><?php echo app('translator')->get('website.MostLiked'); ?></span></a> 
                 <?php endif; ?>

                </div> 
           <!-- Tab panes -->
           <div class="tab-content">

            <?php if($result['top_seller']['success']==1): ?>

            <div role="tabpanel" class="tab-pane fade active show" id="featured">
              <div class="tab-carousel-js">
                  

                    <?php $__currentLoopData = $result['top_seller']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slick ">
                      <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="">
                      <div class="product">
                        <article>
                         <div class="btn-all">
                          <a href="<?php echo e(url('/shop?type=topseller')); ?>" class="btn btn-secondary swipe-to-top"><?php echo app('translator')->get('website.View All'); ?></a>
                         </div>                              
                        </article>
                      </div>
                    </div>

              </div>
            <!-- 1st tab --> 
          </div>


            <?php endif; ?>

            <?php if($result['special']['success']==1): ?> 
            
            <div role="tabpanel" class="tab-pane fade" id="special">
              <div class="tab-carousel-js ">
                  

                    <?php $__currentLoopData = $result['special']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slick ">
                      <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="">
                      <div class="product">
                        <article>
                         <div class="btn-all">
                          <a href="<?php echo e(url('/shop?type=special')); ?>" class="btn btn-secondary swipe-to-top"><?php echo app('translator')->get('website.View All'); ?></a>
                         </div>                              
                        </article>
                      </div>
                    </div>                  

              </div>
            <!-- 2nd tab --> 
          </div>

          
            <?php endif; ?>


            <?php if($result['most_liked']['success']==1): ?>
             <div role="tabpanel" class="tab-pane fade" id="liked">
                 <div class="tab-carousel-js">
                     
                     
                      <?php $__currentLoopData = $result['most_liked']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="slick">
                        <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      </div> 
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <div class="">
                      <div class="product">
                        <article>
                         <div class="btn-all">
                          <a href="<?php echo e(url('/shop?type=mostliked')); ?>" class="btn btn-secondary swipe-to-top"><?php echo app('translator')->get('website.View All'); ?></a>
                         </div>                              
                        </article>
                      </div>
                    </div>

               <!-- 3rd tab -->
             </div>
             
            <?php endif; ?>
             
           </div>
         </div>
      </div>
    </div>
 
 </div>  
</section>

<?php endif; ?>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/product-sections/tab.blade.php ENDPATH**/ ?>