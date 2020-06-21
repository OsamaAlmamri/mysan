<div class="row ">
  <div class="col-12 col-md-6">
    <div class="row ">
      <div id="quickViewCarousel" class="carousel slide" data-ride="carousel">
          <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">                
                <img class="img-fluid" src="<?php echo e(asset('').$result['detail']['product_data'][0]->image_path); ?>" alt="image">
              </div>

              <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($images->image_type == 'ACTUAL'): ?>

                <div class="carousel-item">                    
                  <img class="img-fluid" src="<?php echo e(asset('').$images->image_path); ?>" alt="image">
                </div>

                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="prev">
                <span class="fas fa-angle-left "></span>
            </a>
            <a class="carousel-control-next btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="next">
                <span class="fas fa-angle-right "></span>
            </a>
          
        </div>
    </div>

  </div>

    <div class="col-12 col-lg-6">
   
      <div class="pro-description">
        <div class="badges">
          <?php 
              $current_date = date("Y-m-d", strtotime("now"));

              $string = substr($result['detail']['product_data'][0]->products_date_added, 0, strpos($result['detail']['product_data'][0]->products_date_added, ' '));
              $date=date_create($string);
              date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

              $after_date = date_format($date,"Y-m-d");

              if($after_date>=$current_date){
                print '<span class="badge badge-info">';
                print __('website.New');
                print '</span>';
              }
            ?>

          <?php if($result['detail']['product_data'][0]->is_feature == 1): ?>
          <span class="badge badge-success"><?php echo app('translator')->get('website.Featured'); ?></span>     
          <?php endif; ?>
          
          <?php
          $discount_percentage = 0;
          if(!empty($result['detail']['product_data'][0]->discount_price)){
            $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
          }
          $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');

          if(!empty($result['detail']['product_data'][0]->discount_price)){

          if(($orignal_price+0)>0){
            $discounted_price = $orignal_price-$discount_price;
            $discount_percentage = $discounted_price/$orignal_price*100;
          }else{
            $discount_percentage = 0;
            $discounted_price = 0;
          }
          
          ?>             
          
          <?php }
          
          ?>
          <?php if($discount_percentage>0): ?>
          <span class="badge badge-danger"><?php echo (int)$discount_percentage; ?>%</span>
          <?php endif; ?>
        </div>
          <h3 class="pro-title"><?php echo e($result['detail']['product_data'][0]->products_name); ?></h3>
    
    <div class="pro-price">                     
      <?php

      if(!empty($result['detail']['product_data'][0]->discount_price)){
        $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
      }
      if(!empty($result['detail']['product_data'][0]->flash_price)){
        $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
      }
      $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');
      
       if(!empty($result['detail']['product_data'][0]->discount_price)){

        if(($orignal_price+0)>0){
        $discounted_price = $orignal_price-$discount_price;
        $discount_percentage = $discounted_price/$orignal_price*100;
        $discounted_price = $result['detail']['product_data'][0]->discount_price;

       }else{
         $discount_percentage = 0;
         $discounted_price = 0;
       }
      }
      else{
        $discounted_price = $orignal_price;
      }
      ?>
      <?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?>
      <ins> <?php echo e(Session::get('symbol_left')); ?><?php echo e($flash_price+0); ?><?php echo e(Session::get('symbol_right')); ?></ins>
      <del><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></del>
      <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?>
      <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?></ins>
      <del><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></del>
      <?php else: ?>
      <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></ins>
      <?php endif; ?>
      </h2>
                         
      </div>

    <div class="pro-infos">
        <div class="pro-single-info"><b><?php echo app('translator')->get('website.Product ID'); ?> :</b><?php echo e($result['detail']['product_data'][0]->products_id); ?></div>
        <div class="pro-single-info pro-catgory"><b><?php echo app('translator')->get('website.Categroy'); ?>  :</b>
          <?php $__currentLoopData = $result['detail']['product_data'][0]->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(url('shop?category='.$category->categories_slug)); ?>"><?php echo e($category->categories_name); ?></a>  &nbsp;&nbsp;
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>     

        <div class="pro-single-info"><b><?php echo app('translator')->get('website.Available'); ?> :</b>

          <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
            <?php if($result['detail']['product_data'][0]->defaultStock == 0): ?>
            <span class="text-secondary"><?php echo app('translator')->get('website.Out of Stock'); ?></span>
            <?php else: ?>
            <span class="text-secondary"><?php echo app('translator')->get('website.In stock'); ?></span>
            <?php endif; ?>
          <?php endif; ?>
        </div>

        <?php if($result['detail']['product_data'][0]->products_min_order>0): ?>
              <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
            <div class="pro-single-info" id="min_max_setting"><b><?php echo app('translator')->get('website.Min Order Limit:'); ?> </b><a href="#"><?php echo e($result['detail']['product_data'][0]->products_min_order); ?></a></div>
              <?php elseif($result['detail']['product_data'][0]->products_type == 1): ?>
                <div class="pro-single-info" id="min_max_setting"></div>
              <?php endif; ?>
          <?php endif; ?>
    </div>

    <div class="popup-detail-info">
      <p>
      <?php 
        $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
        echo stripslashes($descriptions);
      ?>
      </p>
    </div>

    <form name="attributes" id="add-Product-form" method="post" >
      <input type="hidden" name="products_id" value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">

      <input type="hidden" name="products_price" id="products_price" value="<?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?> <?php echo e($result['detail']['product_data'][0]->flash_price+0); ?> <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?><?php echo e($result['detail']['product_data'][0]->discount_price+0); ?><?php else: ?><?php echo e($result['detail']['product_data'][0]->products_price+0); ?><?php endif; ?>">

      <input type="hidden" name="checkout" id="checkout_url" value="<?php if(!empty(app('request')->input('checkout'))): ?> <?php echo e(app('request')->input('checkout')); ?> <?php else: ?> false <?php endif; ?>" >

      <input type="hidden" id="max_order" value="<?php if(!empty($result['detail']['product_data'][0]->products_max_stock)): ?> <?php echo e($result['detail']['product_data'][0]->products_max_stock); ?> <?php else: ?> 0 <?php endif; ?>" >
       <?php if(!empty($result['cart'])): ?>
        <input type="hidden"  name="customers_basket_id" value="<?php echo e($result['cart'][0]->customers_basket_id); ?>" >
       <?php endif; ?>


    <?php if(count($result['detail']['product_data'][0]->attributes)>0): ?>
    <?php
        $index = 0;
    ?>
      <?php $__currentLoopData = $result['detail']['product_data'][0]->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
          $functionValue = 'function_'.$key++;
      ?>
      <input type="hidden" name="option_name[]" value="<?php echo e($attributes_data['option']['name']); ?>" >
      <input type="hidden" name="option_id[]" value="<?php echo e($attributes_data['option']['id']); ?>" >
      <input type="hidden" name="<?php echo e($functionValue); ?>" id="<?php echo e($functionValue); ?>" value="0" >
      <input id="attributeid_<?=$index?>" type="hidden" value="">
      <input id="attribute_sign_<?=$index?>" type="hidden" value="">
      <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
      <div class="pro-options">
            <div class="box mb-3">
              <label><?php echo e($attributes_data['option']['name']); ?></label>
              <div class="select-control ">
              <select name="<?php echo e($attributes_data['option']['id']); ?>" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "<?php echo e($attributes_data['option']['id']); ?>">
                <?php if(!empty($result['cart'])): ?>
                  <?php
                   $value_ids = array();
                    foreach($result['cart'][0]->attributes as $values){
                        $value_ids[] = $values->options_values_id;
                    }
                  ?>
                    <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(!empty($result['cart'])): ?>
                     <option <?php if(in_array($values_data['id'],$value_ids)): ?> selected <?php endif; ?> attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                     <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>                  
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  

  
    
    <div class="pro-counter" <?php if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ): ?> style="display: none" <?php endif; ?>>
        <div class="input-group item-quantity">                    
            
            <input type="text" readonly name="quantity" class="form-control qty" value="<?php if(!empty($result['cart'])): ?> <?php echo e($result['cart'][0]->customers_basket_quantity); ?> <?php else: ?> <?php if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order): ?> <?php echo e($result['detail']['product_data'][0]->products_min_order); ?> <?php else: ?> 1 <?php endif; ?> <?php endif; ?>" min="<?php if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order): ?> <?php echo e($result['detail']['product_data'][0]->products_min_order); ?> <?php else: ?> 1 <?php endif; ?>" max="<?php if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock): ?><?php echo e($result['detail']['product_data'][0]->products_max_stock); ?><?php else: ?><?php echo e($result['detail']['product_data'][0]->defaultStock); ?><?php endif; ?>">              
            <span class="input-group-btn">
                <button type="button" class="quantity-plus1 btn qtyplus">
                    <i class="fas fa-plus"></i>
                </button>
            
                <button type="button" class="quantity-minus1 btn qtyminus">
                    <i class="fas fa-minus"></i>
                </button>
            </span>
          </div>
          <?php if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ): ?>
            <?php else: ?>
              <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
                  <?php if($result['detail']['product_data'][0]->defaultStock == 0): ?> 
                    <button class="btn btn-lg swipe-to-top  btn-danger " type="button"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                  <?php else: ?>
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                  <?php endif; ?>
              <?php else: ?>
                    <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                    <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" hidden type="button"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
              <?php endif; ?>
            <?php endif; ?>
            <?php if($result['detail']['product_data'][0]->products_type == 2): ?>
            <a href="<?php echo e($result['detail']['product_data'][0]->products_url); ?>" target="_blank" class="btn btn-secondary btn-lg swipe-to-top"><?php echo app('translator')->get('website.External Link'); ?></a>
          <?php endif; ?>
  
    </div>

    
  </form>

  
    
    </div>     

  </div>

</div>


<script>
<?php if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1): ?>
  getQuantity();
  cartPrice();
<?php endif; ?>
</script>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/common/modal1.blade.php ENDPATH**/ ?>