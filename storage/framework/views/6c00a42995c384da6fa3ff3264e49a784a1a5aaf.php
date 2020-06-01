<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>

              <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
                <li class="breadcrumb-item active"><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
                <li class="breadcrumb-item active"><a href="<?php echo e(URL::to('/shop?category='.$result['sub_category_slug'])); ?>"><?php echo e($result['sub_category_name']); ?></a></li>
              <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
                <li class="breadcrumb-item active"><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
              <?php endif; ?>
              <li class="breadcrumb-item active"><?php echo e($result['detail']['product_data'][0]->products_name); ?></li>
          </ol>
      </div>
    </nav>
</div> 

<section class="pro-content">
  <div class="container">
    <div class="page-heading-title">
        <h2> <?php echo e($result['detail']['product_data'][0]->products_name); ?> 
        </h2>         
    </div>
</div>

<section class="product-page">
  <div class="container"> 
    <div class="row">
      <div class="col-12 col-lg-6  ">
          <div class="slider-wrapper pd2">
              <div class="slider-for">
                
                <a class="slider-for__item ex1 fancybox-button" href="<?php echo e(asset('').$result['detail']['product_data'][0]->default_images); ?>" data-fancybox-group="fancybox-button">
                  <img src="<?php echo e(asset('').$result['detail']['product_data'][0]->default_images); ?>" alt="Zoom Image" />
                </a>
            
                <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($images->image_type == 'LARGE'): ?>

                  <a class="slider-for__item ex1 fancybox-button" href="<?php echo e(asset('').$images->image_path); ?>" data-fancybox-group="fancybox-button" >
                    <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image" />
                  </a>
                  
                  <?php elseif($images->image_type == 'ACTUAL'): ?>
                  <a class="slider-for__item ex1 fancybox-button" href="<?php echo e(asset('').$images->image_path); ?>" data-fancybox-group="fancybox-button">
                    <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image" />
                  </a>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            
              <div class="slider-nav">
                <div class="slider-nav__item">
                  <img src="<?php echo e(asset('').$result['detail']['product_data'][0]->default_thumb); ?>" alt="Zoom Image"/>
                </div>
            
                <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($images->image_type == 'THUMBNAIL'): ?>
                    <div class="slider-nav__item">
                      <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                    </div>
                  <?php elseif($images->image_type == 'MEDIUM'): ?>
                  <div class="slider-nav__item">
                    <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                  </div>
                  <?php elseif($images->image_type == 'LARGE'): ?>
                  <div class="slider-nav__item">
                    <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                  </div>
                  <?php elseif($images->image_type == 'ACTUAL'): ?>
                  <div class="slider-nav__item">
                    <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                  </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
      </div>
      <div class="col-12 col-lg-6 d-none">
        <div class="general-product" data-aos="fade-up"
        data-aos-anchor-placement="top-bottom">
          <div class="container">
              <div class="product-m-carousel-js">
                <div class="col-12 col-md-12 col-lg-6">
                  <div class="product">
                    <article>
                      <img src="<?php echo e(asset('').$result['detail']['product_data'][0]->default_images); ?>" class="img-fluid" alt="blogImage">
                        <div class="over"></div>
                    </article>
                  </div>
                </div>

                <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($images->image_type == 'LARGE'): ?>

                  <div class="col-12 col-md-12 col-lg-6">
                    <div class="product">
                      <article>
                        <img src="<?php echo e(asset('').$images->image_path); ?>" class="img-fluid" alt="blogImage">
                          <div class="over"></div>
                      </article>
                    </div>
                  </div>
                  
                  <?php elseif($images->image_type == 'ACTUAL'): ?>
                  <div class="col-12 col-md-12 col-lg-6">
                    <div class="product">
                      <article>
                        <img src="<?php echo e(asset('').$images->image_path); ?>" class="img-fluid" alt="blogImage">
                          <div class="over"></div>
                      </article>
                    </div>
                  </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                </div>  
          </div>
        </div>  
      </div>
      <div class="col-12 col-lg-6">
          <div class="row">
              <div class="col-12 col-md-12">
                <div class="badges">

                  <?php 
                  //dd($result['detail']['product_data'][0]->flash_start_date);
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
                <?php if($result['detail']['product_data'][0]->is_feature == 1): ?>
                <span class="badge badge-success"><?php echo app('translator')->get('website.Featured'); ?></span>     
                <?php endif; ?>
                
                
              </div>

                <h5 class="pro-title"><?php echo e($result['detail']['product_data'][0]->products_name); ?></h5>
          
          <div class="price">                     
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
            <sub class="total_price"><?php echo e(Session::get('symbol_left')); ?><?php echo e($flash_price+0); ?><?php echo e(Session::get('symbol_right')); ?></sub>
            <span><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?> </span> 
            <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?>
            <price class="total_price"><?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?></price>
            <span><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?> </span> 
            <?php else: ?>
            <price class="total_price"><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></price>
            <?php endif; ?>
                               
            </div>

            <div class="pro-rating">
              <fieldset class="disabled-ratings">                                           
                <label class = "full <?php if($result['detail']['product_data'][0]->rating >= 5): ?> active <?php endif; ?>" for="star_5" title="<?php echo app('translator')->get('website.awesome_5_stars'); ?>"></label>
                <label class = "full <?php if($result['detail']['product_data'][0]->rating >= 4): ?> active <?php endif; ?>" for="star_4" title="<?php echo app('translator')->get('website.pretty_good_4_stars'); ?>"></label>                                          
                <label class = "full <?php if($result['detail']['product_data'][0]->rating >= 3): ?> active <?php endif; ?>" for="star_3" title="<?php echo app('translator')->get('website.pretty_good_3_stars'); ?>"></label>                                          
                <label class = "full <?php if($result['detail']['product_data'][0]->rating >= 2): ?> active <?php endif; ?>" for="star_2" title="<?php echo app('translator')->get('website.meh_2_stars'); ?>"></label>
                 <label class = "full <?php if($result['detail']['product_data'][0]->rating >= 1): ?> active <?php endif; ?>" for="star1" title="<?php echo app('translator')->get('website.meh_1_stars'); ?>"></label>
              </fieldset>                                          
              <a href="#review" class="btn-link"><?php echo e($result['detail']['product_data'][0]->total_user_rated); ?> <?php echo app('translator')->get('website.Reviews'); ?> </a>
            </div>

          <div class="pro-infos">
              <div class="pro-single-info"><b><?php echo app('translator')->get('website.Product ID'); ?> :</b><?php echo e($result['detail']['product_data'][0]->products_id); ?></div>
              <div class="pro-single-info"><b><?php echo app('translator')->get('website.Categroy'); ?>  :</b>
                <?php
                $cates = '';  
                ?>
                <?php $__currentLoopData = $result['detail']['product_data'][0]->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                  <?php
                    $cates =  "<a href=".url('shop?category='.$category->categories_name).">".$category->categories_name."</a>";
                  ?>  
                  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php 
                echo $cates;
                ?>
                </div>
              
              <div class="pro-single-info"><b><?php echo app('translator')->get('website.Available'); ?> :</b>

                <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
                  <?php if($result['detail']['product_data'][0]->defaultStock == 0): ?>
                  <span class="text-secondary"><?php echo app('translator')->get('website.Out of Stock'); ?></span>
                  <?php else: ?>
                  <span class="text-secondary"><?php echo app('translator')->get('website.In stock'); ?></span>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if($result['detail']['product_data'][0]->products_type == 1): ?>
                <span class="text-secondary variable-stock"></span>
                <?php endif; ?>

                <?php if($result['detail']['product_data'][0]->products_type == 2): ?>
                <span class="text-secondary"><?php echo app('translator')->get('website.External'); ?></span>
                <?php endif; ?>
              </div>

              <?php if($result['detail']['product_data'][0]->products_min_order>0): ?>
                    <?php if($result['detail']['product_data'][0]->products_type == 0): ?>
                  <div class="pro-single-info" id="min_max_setting"><b><?php echo app('translator')->get('website.Min Order Limit:'); ?> :</b><a href="#"><?php echo e($result['detail']['product_data'][0]->products_min_order); ?></a></div>
                    <?php elseif($result['detail']['product_data'][0]->products_type == 1): ?>
                      <div class="pro-single-info" id="min_max_setting"></div>
                    <?php endif; ?>
                 
                <?php endif; ?>
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
          <div class="pro-options row">
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
            
              <div class="attributes col-12 col-md-4 box">
                  <label class=""><?php echo e($attributes_data['option']['name']); ?></label>
                  <div class="select-control">
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
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php endif; ?>
        
      
         <?php if(!empty($result['detail']['product_data'][0]->flash_start_date)): ?>
          <div class="countdown pro-timer" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Countdown Timer'); ?>" id="counter_<?php echo e($result['detail']['product_data'][0]->products_id); ?>" >                               
            <span class="days">0<small><?php echo app('translator')->get('website.Days'); ?> </small></span>
            <span class="hours">0<small><?php echo app('translator')->get('website.Hours'); ?></small></span>
            <span class="mintues">0<small><?php echo app('translator')->get('website.Minutes'); ?></small></span>
            <span class="seconds">0<small><?php echo app('translator')->get('website.Seconds'); ?></small></span>
          </div>
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

          <div class="pro-sub-buttons">
              <div class="buttons">
                  <button class="btn btn-link is_liked" products_id="<?=$result['detail']['product_data'][0]->products_id?>" style="padding-left: 0;"><i class="fas fa-heart"></i> <?php echo app('translator')->get('website.Add to Wishlist'); ?> </button>
                  <button type="button" class="btn btn-link" onclick="myFunction3(<?php echo e($result['detail']['product_data'][0]->products_id); ?>)"><i class="fas fa-align-right"></i><?php echo app('translator')->get('website.Add to Compare'); ?></button>
              
              </div>
              <!-- AddToAny BEGIN -->
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_email"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
              
          </div>
          
          </div>
        </div>
          <div class="row">
              <div class="col-12 col-md-12">
                <div class="nav nav-pills" role="tablist">
                  <a class="nav-link nav-item  active" href="#description" id="description-tab" data-toggle="pill" role="tab"><?php echo app('translator')->get('website.Descriptions'); ?></a> 
                  <a class="nav-link nav-item" href="#review" id="review-tab" data-toggle="pill" role="tab" ><?php echo app('translator')->get('website.Reviews'); ?></a>
                </div> 
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active show" id="description" aria-labelledby="description-tab">
                    <?=stripslashes($result['detail']['product_data'][0]->products_description)?>                        
                  </div>  
                  <div role="tabpanel" class="tab-pane fade " id="review" aria-labelledby="review-tab">
                    <div class="reviews">
                      <?php if(isset($result['detail']['product_data'][0]->reviewed_customers)): ?>
                        <div class="review-bubbles">
                            <h2>
                              <?php echo app('translator')->get('website.Customer Reviews'); ?>
                            </h2>                            
                              <?php $__currentLoopData = $result['detail']['product_data'][0]->reviewed_customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="review-bubble-single">
                                  <div class="review-bubble-bg">
                                      <div class="pro-rating">
                                        <fieldset class="disabled-ratings">                                           
                                          <label class = "full <?php if($rev->reviews_rating >= 5): ?> active <?php endif; ?>" for="star_5" title="<?php echo app('translator')->get('website.awesome_5_stars'); ?>"></label>
                                          <label class = "full <?php if($rev->reviews_rating >= 4): ?> active <?php endif; ?>" for="star_4" title="<?php echo app('translator')->get('website.pretty_good_4_stars'); ?>"></label>                                          
                                          <label class = "full <?php if($rev->reviews_rating >= 3): ?> active <?php endif; ?>" for="star_3" title="<?php echo app('translator')->get('website.pretty_good_3_stars'); ?>"></label>                                          
                                          <label class = "full <?php if($rev->reviews_rating >= 2): ?> active <?php endif; ?>" for="star_2" title="<?php echo app('translator')->get('website.meh_2_stars'); ?>"></label>
                                           <label class = "full <?php if($rev->reviews_rating >= 1): ?> active <?php endif; ?>" for="star1" title="<?php echo app('translator')->get('website.meh_1_stars'); ?>"></label>
                                        </fieldset>                                          
                                      </div>
                                      <h4><?php echo e($rev->customers_name); ?></h4>
                                      <span><?php echo e(date("d-M-Y", strtotime($rev->created_at))); ?></span>
                                      <p><?php echo e($rev->reviews_text); ?></p>
                                  </div>
                                  
                              </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        </div>
                        <?php endif; ?>
                        <?php if(Auth::guard('customer')->check()): ?>
                        <div class="write-review">
                          <form id="idForm">
                            <?php echo e(csrf_field()); ?>

                            <input value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>" type="hidden" name="products_id">
                          <h2><?php echo app('translator')->get('website.Write a Review'); ?></h2>
                          <div class="write-review-box">
                              <div class="from-group row mb-3">
                                  <div class="col-12"> <label for="inlineFormInputGroup2"><?php echo app('translator')->get('website.Rating'); ?></label></div>
                                  <div class="pro-rating col-12">

                                    <fieldset class="ratings">
                                      
                                      <input type="radio" id="star5" name="rating" value="5" class="rating"/>
                                      <label class = "full" for="star5" title="<?php echo app('translator')->get('website.awesome_5_stars'); ?>"></label>

                                      <input type="radio" id="star4" name="rating" value="4" class="rating"/>
                                      <label class="full" for="star4" title="<?php echo app('translator')->get('website.pretty_good_4_stars'); ?>"></label>

                                      <input type="radio" id="star3" name="rating" value="3" class="rating"/>
                                      <label class = "full" for="star3" title="<?php echo app('translator')->get('website.pretty_good_3_stars'); ?>"></label>

                                      <input type="radio" id="star2" name="rating" value="2" class="rating"/>
                                      <label class="full" for="star2" title="<?php echo app('translator')->get('website.meh_2_stars'); ?>"></label>

                                      <input type="radio" id="star1" name="rating" value="1" class="rating"/>
                                      <label class = "full" for="star1" title="<?php echo app('translator')->get('website.meh_1_stars'); ?>"></label> 
                                    
                                  </fieldset>                                     
                                      
                                  </div>
                              </div>                              
                             
                                <div class="from-group row mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup3"><?php echo app('translator')->get('website.Review'); ?></label></div>
                                    <div class="input-group col-12">                                      
                                      <textarea name="reviews_text" id="reviews_text" class="form-control" id="inlineFormInputGroup3" placeholder="<?php echo app('translator')->get('website.Write Your Review'); ?>"></textarea>
                                    </div>
                                </div>

                                <div class="alert alert-danger" hidden id="review-error" role="alert">
                                 <?php echo app('translator')->get('website.Please enter your review'); ?>
                                </div>

                                <div class="from-group">
                                    <button type="submit" id="review_button" disabled class="btn btn-secondary swipe-to-top"><?php echo app('translator')->get('website.Submit'); ?></button>                                    
                                </div>
                          </div>
                          
                        </form>
                        </div>
                        <?php endif; ?>
                    </div>

                      
                  </div> 
              </div>
          </div>      
      
        </div>

      </div>
    </div>
  </div>
</section>


<section class="product-content pro-content">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="pro-heading-title">
                <h2> <?php echo app('translator')->get('website.Related Products'); ?>
                </h2>
                <p> 
                  <?php echo app('translator')->get('website.Related Products Text'); ?>
                </div>
          </div>
    
        </div>
  </div>
  <div class="general-product">
    <div class="container p-0">
        <div class="product-carousel-js">      
              <?php $__currentLoopData = $result['simliar_products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($result['detail']['product_data'][0]->products_id != $products->products_id): ?>                     
                <div class="slik">
                  <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>  
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
          </div>  
    </div>
  </div>  



  <script>

    jQuery(document).ready(function(e) {
    
      <?php if(!empty($result['detail']['product_data'][0]->flash_start_date)): ?>
         <?php if( date("Y-m-d",$result['detail']['product_data'][0]->server_time) >= date("Y-m-d",$result['detail']['product_data'][0]->flash_start_date)): ?>
          var product_div_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = 'product_div_<?php echo e($result['detail']['product_data'][0]->products_id); ?>';
        var  counter_id_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = 'counter_<?php echo e($result['detail']['product_data'][0]->products_id); ?>';
        var inputTime_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = "<?php echo e(date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)); ?>";
    
        // Set the date we're counting down to
        var countDownDate_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = new Date(inputTime_<?php echo e($result['detail']['product_data'][0]->products_id); ?>).getTime();
    
        // Update the count down every 1 second
        var x_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = setInterval(function() {
    
          // Get todays date and time
          var now = new Date().getTime();
    
          // Find the distance between now and the count down date
          var distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = countDownDate_<?php echo e($result['detail']['product_data'][0]->products_id); ?> - now;
    
          // Time calculations for days, hours, minutes and seconds
          var days_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = Math.floor(distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> / (1000 * 60 * 60 * 24));
          var hours_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = Math.floor((distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = Math.floor((distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> % (1000 * 60 * 60)) / (1000 * 60));
          var seconds_<?php echo e($result['detail']['product_data'][0]->products_id); ?> = Math.floor((distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> % (1000 * 60)) / 1000);
          var days_text = "<?php echo app('translator')->get('website.Days'); ?>";
          // Display the result in the element with id="demo"
          document.getElementById(counter_id_<?php echo e($result['detail']['product_data'][0]->products_id); ?>).innerHTML = "<span class='days'>"+days_<?php echo e($result['detail']['product_data'][0]->products_id); ?> + "<small><?php echo app('translator')->get('website.Days'); ?></small></span> <span class='hours'>" + hours_<?php echo e($result['detail']['product_data'][0]->products_id); ?> + "<small><?php echo app('translator')->get('website.Hours'); ?></small></span> <span class='mintues'> "
          + minutes_<?php echo e($result['detail']['product_data'][0]->products_id); ?> + "<small><?php echo app('translator')->get('website.Minutes'); ?></small></span> <span class='seconds'>" + seconds_<?php echo e($result['detail']['product_data'][0]->products_id); ?> + "<small><?php echo app('translator')->get('website.Seconds'); ?></small></span> ";
    
          // If the count down is finished, write some text
          if (distance_<?php echo e($result['detail']['product_data'][0]->products_id); ?> < 0) {
          clearInterval(x_<?php echo e($result['detail']['product_data'][0]->products_id); ?>);
          //document.getElementById(counter_id_<?php echo e($result['detail']['product_data'][0]->products_id); ?>).innerHTML = "EXPIRED";
          document.getElementById('product_div_<?php echo e($result['detail']['product_data'][0]->products_id); ?>').remove();
          }
        }, 1000);
           <?php endif; ?>
       <?php endif; ?>
    
  
    });
    </script>

    
    
</section><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/details/detail1.blade.php ENDPATH**/ ?>