
<?php if($result['featured']['success']==1): ?>
<section class="new-products-content pro-content" >
  <div class="container">
    <div class="products-area">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
          <div class="pro-heading-title">
            <h2> <?php echo app('translator')->get('website.Top Selling of the Week'); ?>

            </h2>
            <p>
              <?php echo app('translator')->get('website.Top Sellings Of the Week Detail'); ?></p>
          </div>
        </div>
      </div>
      <div class="row ">  
        <?php if($result['weeklySoldProducts']['success']==1): ?>
        <?php $__currentLoopData = $result['weeklySoldProducts']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key==0): ?>

          <div class="col-12 col-lg-6">

            <div class="product product-ad">
              <article>
                <div class="badges">
                  <?php
                  if(!empty($products->discount_price)){
                    $discount_price = $products->discount_price * session('currency_value');
                  }
                  $orignal_price = $products->products_price * session('currency_value');
            
                  if(!empty($products->discount_price)){
            
                  if(($orignal_price+0)>0){
                    $discounted_price = $orignal_price-$discount_price;
                    $discount_percentage = $discounted_price/$orignal_price*100;
                   }else{
                     $discount_percentage = 0;
                     $discounted_price = 0;
                  }
                  ?>
                  
                    <span class="badge badge-danger"  data-toggle="tooltip" data-placement="bottom" title="<?php echo (int)$discount_percentage; ?>% off"><?php echo (int)$discount_percentage; ?>%</span>
                    <?php }?>
                    <?php if($products->is_feature == 1): ?>
                      <span class="badge badge-success"><?php echo app('translator')->get('website.Featured'); ?></span>                                            
                                
                  <?php else: ?>
                  <?php 
                  $current_date = date("Y-m-d", strtotime("now"));
            
                  $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
                  $date=date_create($string);
                  date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));
                  $after_date = date_format($date,"Y-m-d");
                  if($after_date>=$current_date){
                    print '<span class="badge badge-info">';
                    print __('website.New');
                    print '</span>';
                  }
                  ?> 
                  <?php endif; ?>   
                </div>
                <div class="detail">
                  <span class="tag">
                    <?php 
                    $cates = '';
                    foreach($products->categories as $key=>$category){
                      $cates = trim($category->categories_name);
                    } 
                    echo $cates ;                    
                    ?>                               
                </span>
                <h5 class="title"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h5>
                <p class="discription">
                   <?php
                      $descriptions = strip_tags($products->products_description);
                      echo stripslashes($descriptions);
                    ?>
                </p>
                      
                <div class="price">                                    
                  <?php if(!empty($products->discount_price)): ?>
                    <?php echo e(Session::get('symbol_left')); ?>&nbsp;<?php echo e($discount_price+0); ?>&nbsp;<?php echo e(Session::get('symbol_right')); ?><span><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></span>
                  <?php else: ?>
                    <?php echo e(Session::get('symbol_left')); ?>&nbsp;<?php echo e($orignal_price+0); ?>&nbsp;<?php echo e(Session::get('symbol_right')); ?>

                  <?php endif; ?>   
                </div>  
               
              <div class="pro-sub-buttons">
                  <div class="buttons">
                      <button type="button" class="btn  btn-link is_liked" products_id="<?=$products->products_id?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Add to Wishlist'); ?>"><i class="fas fa-heart"></i><?php echo app('translator')->get('website.Add to Wishlist'); ?></button>
                      <button type="button" class="btn btn-link" onclick="myFunction3(<?php echo e($products->products_id); ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Add to Compare'); ?>"><i class="fas fa-align-right" ></i><?php echo app('translator')->get('website.Add to Compare'); ?></button>
                  </div>
                  </div>          
             
                 </div>
                <picture>
                    <div class="product-hover">
                    
                        <?php if($products->products_type==0): ?>
                          <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                              <?php if($products->defaultStock==0): ?>
                                  <button type="button"  class="btn btn-block btn-danger swipe-to-top" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                              <?php elseif($products->products_min_order>1): ?>
                                <a class="btn btn-block btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                              <?php else: ?>
                                  <button type="button" class="btn btn-block btn-secondary cart swipe-to-top" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                              <?php endif; ?>
                          <?php else: ?>
                              <button type="button" class="btn btn-block btn-secondary active swipe-to-top"><?php echo app('translator')->get('website.Added'); ?></button>
                          <?php endif; ?>
                      <?php elseif($products->products_type==1): ?>
                          <a class="btn btn-block btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                      <?php elseif($products->products_type==2): ?>
                          <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary swipe-to-top"><?php echo app('translator')->get('website.External Link'); ?></a>
                      <?php endif; ?>

                    </div>
                  <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
                </picture>
              
    
                 
              </article>
            </div>
          </div> 
          
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php if($result['weeklySoldProducts']['success']==1): ?>
            <?php $__currentLoopData = $result['weeklySoldProducts']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key!=0): ?>
            <?php if($key<=6): ?>

          <div class="col-12 col-sm-6 col-lg-3">
            <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>  
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
   
      </div>
    </div>
  </div>  
</section>

<?php endif; ?>
<?php /**PATH F:\sites\mysan\resources\views/web/product-sections/top.blade.php ENDPATH**/ ?>