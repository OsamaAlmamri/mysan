<?php if($result['flash_sale']['success']==1): ?>
<!-- Products content -->

<section class="pro-content pro-fs-content" >
  <div class="container"> 
    <div class="products-area ">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="pro-heading-title">
                <h2> <?php echo app('translator')->get('website.Flash Sale'); ?>
                </h2>
                <p> 
                  <?php echo app('translator')->get('website.Flash Sale Text'); ?>
                </div>
          </div>
    
        </div>
  </div>
  </div>
  <div class="general-product">
    <div class="container  p-0">
      <div class="popular-carousel-js">
        <?php $__currentLoopData = $result['flash_sale']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( date("Y-m-d", $products->server_time) >= date("Y-m-d", $products->flash_start_date)): ?>

        <div class="">
          <div class="product">
            <article>
                <div class="flash-p">
                    <div class="pro-description">
                        <div class="pro-info blink">
                          <?php echo app('translator')->get('website.Super deal of the Month'); ?>                       
                        </div>

                        <?php

                              if(!empty($products->flash_price)){
                                  $discount_price = $products->flash_price;
                              }
                              
                              $orignal_price = $products->products_price;
                              
                              if(!empty($products->flash_price)){

                                if(($orignal_price+0)>0){
                                  $discounted_price = $orignal_price-$discount_price;
                                  $discount_percentage = $discounted_price/$orignal_price*100;
                                  $discounted_price =$products->flash_price;
                                  }else{
                                    $discount_percentage = 0;
                                    $discounted_price = 0;
                                }

                            }
                          ?>

                          <span class="tag">
                            <?php 
                            $cates2='';
                              foreach($products->categories as $key=>$category){
                                $cates2 =  trim($category->categories_name);
                              }   
                              echo $cates2;                  
                            ?>                                 
                          </span>
                          <h4 class="pro-title">
                            <span><?php echo e($products->products_name); ?> </span>

                            <?php if(!empty($products->flash_price)): ?>
                            <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e(($discounted_price+0) * session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?>

                              <del><?php echo e(Session::get('symbol_left')); ?><?php echo e(($orignal_price+0) * session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></del>
                            </ins>
                            
                            <?php else: ?>
                              <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e(($orignal_price+0) *session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></ins>
                            <?php endif; ?> 
                            
                          </h4>                         
                           

                          <div class="countdown pro-timer" id="counter_<?php echo e($products->products_id); ?>" data-placement="bottom" title="<?php echo app('translator')->get('website.Countdown Timer'); ?>" >                               
                            <span class="days">0<small><?php echo app('translator')->get('website.Days'); ?> </small></span>
                            <span class="hours">0<small><?php echo app('translator')->get('website.Hours'); ?></small></span>
                            <span class="mintues">0<small><?php echo app('translator')->get('website.Minutes'); ?></small></span>
                            <span class="seconds">0<small><?php echo app('translator')->get('website.Seconds'); ?></small></span>
                          </div>

                    </div>

                    <div class="pro-thumb">                   
                      <div class="product-flash-hover">   
                          <?php if($products->products_type==0): ?>
                              <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                  <?php if($products->defaultStock==0): ?>
                                      <button type="button" class="btn btn-block btn-danger swipe-to-top" products_id="<?php echo e($products->products_id); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Out of Stock'); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                  <?php elseif($products->products_min_order>1): ?>
                                  <a class="btn btn-block btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.View Detail'); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                  <?php else: ?>
                                      <button type="button" class="btn btn-block btn-secondary cart swipe-to-top" products_id="<?php echo e($products->products_id); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Add to Cart'); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                  <?php endif; ?>
                              <?php else: ?>
                                  <button type="button" class="btn btn-block btn-secondary active swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.Added'); ?>"><?php echo app('translator')->get('website.Added'); ?></button>
                              <?php endif; ?>
                          <?php elseif($products->products_type==1): ?>
                              <a class="btn btn-block btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.View Detail'); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                          <?php elseif($products->products_type==2): ?>
                              <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.External Link'); ?>"><?php echo app('translator')->get('website.External Link'); ?></a>
                          <?php endif; ?>

                      </div>           
                    <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>" alt="<?php echo e($products->products_name); ?>">  
                    </div>
                    
                 
                </div>
          
            </article>
              
          </div>
      </div>


        <?php else: ?>

        <div class="">
          <div class="product">
            <article>
                <div class="flash-p">
                    <div class="pro-description">
                        <div class="pro-info blink"> 
                            <?php echo app('translator')->get('website.Comming Soon'); ?>                 
                        </div>

                        <?php

                              if(!empty($products->flash_price)){
                                  $discount_price = $products->flash_price;
                              }
                              
                              $orignal_price = $products->products_price;
                              
                              if(!empty($products->flash_price)){

                                if(($orignal_price+0)>0){
                                  $discounted_price = $orignal_price-$discount_price;
                                  $discount_percentage = $discounted_price/$orignal_price*100;
                                  $discounted_price =$products->flash_price;
                                  }else{
                                    $discount_percentage = 0;
                                    $discounted_price = 0;
                                }

                            }
                          ?>

                          <span class="tag">
                            <?php 
                            $cates2='';
                              foreach($products->categories as $key=>$category){
                                $cates2 =  trim($category->categories_name);
                              }   
                              echo $cates2;                  
                            ?>                                
                          </span>
                          <h4 class="pro-title">
                            <span><?php echo e($products->products_name); ?> </span>

                            <?php if(!empty($products->flash_price)): ?>
                            <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e(($discounted_price+0) * session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?>

                              <del><?php echo e(Session::get('symbol_left')); ?><?php echo e(($orignal_price+0) * session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></del>
                            </ins>
                            
                            <?php else: ?>
                              <ins><?php echo e(Session::get('symbol_left')); ?><?php echo e(($orignal_price+0) *session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></ins>
                            <?php endif; ?> 
                            
                          </h4>                         
                           

                          <div class="countdown pro-timer" data-placement="bottom" title="<?php echo app('translator')->get('website.Countdown Timer'); ?>">                               
                            <span class="days">0<small><?php echo app('translator')->get('website.Days'); ?> </small></span>
                            <span class="hours">0<small><?php echo app('translator')->get('website.Hours'); ?></small></span>
                            <span class="mintues">0<small><?php echo app('translator')->get('website.Minutes'); ?></small></span>
                            <span class="seconds">0<small><?php echo app('translator')->get('website.Seconds'); ?></small></span>
                          </div>

                    </div>

                    <div class="pro-thumb">                   
                      <div class="product-flash-hover">                        
                           <a class="btn btn-block btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo app('translator')->get('website.View Detail'); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                      </div>           
                    <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>" alt="<?php echo e($products->products_name); ?>">  
                    </div>
                    
                 
                </div>
          
            </article>
              
          </div>
      </div>

  
        <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      

      </div>
    </div>
  </div>
</section>


<?php endif; ?>
<script>

jQuery(document).ready(function(e) {

   <?php if(!empty($result['flash_sale']['success']) and $result['flash_sale']['success']==1): ?>
       <?php $__currentLoopData = $result['flash_sale']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   <?php if( date("Y-m-d",$products->server_time) >= date("Y-m-d",$products->flash_start_date)): ?>
	    var product_div_<?php echo e($products->products_id); ?> = 'product_div_<?php echo e($products->products_id); ?>';
		var  counter_id_<?php echo e($products->products_id); ?> = 'counter_<?php echo e($products->products_id); ?>';
		var inputTime_<?php echo e($products->products_id); ?> = "<?php echo e(date('M d, Y H:i:s' ,$products->flash_expires_date)); ?>";

		// Set the date we're counting down to
		var countDownDate_<?php echo e($products->products_id); ?> = new Date(inputTime_<?php echo e($products->products_id); ?>).getTime();

		// Update the count down every 1 second
		var x_<?php echo e($products->products_id); ?> = setInterval(function() {

		  // Get todays date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance_<?php echo e($products->products_id); ?> = countDownDate_<?php echo e($products->products_id); ?> - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days_<?php echo e($products->products_id); ?> = Math.floor(distance_<?php echo e($products->products_id); ?> / (1000 * 60 * 60 * 24));
		  var hours_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60)) / 1000);
      var days_text = "<?php echo app('translator')->get('website.Days'); ?>";
		  // Display the result in the element with id="demo"
		  document.getElementById(counter_id_<?php echo e($products->products_id); ?>).innerHTML = "<span class='days'>"+days_<?php echo e($products->products_id); ?> + "<small><?php echo app('translator')->get('website.Days'); ?></small></span> <span class='hours'>" + hours_<?php echo e($products->products_id); ?> + "<small><?php echo app('translator')->get('website.Hours'); ?></small></span> <span class='mintues'> "
		  + minutes_<?php echo e($products->products_id); ?> + "<small><?php echo app('translator')->get('website.Minutes'); ?></small></span> <span class='seconds'>" + seconds_<?php echo e($products->products_id); ?> + "<small><?php echo app('translator')->get('website.Seconds'); ?></small></span> ";

		  // If the count down is finished, write some text
		  if (distance_<?php echo e($products->products_id); ?> < 0) {
			clearInterval(x_<?php echo e($products->products_id); ?>);
			//document.getElementById(counter_id_<?php echo e($products->products_id); ?>).innerHTML = "EXPIRED";
			document.getElementById('product_div_<?php echo e($products->products_id); ?>').remove();
		  }
		}, 1000);
  	   <?php endif; ?>
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>

	<?php if(!empty($result['detail']['product_data'][0]->flash_start_date)): ?>
		<?php if( $result['detail']['product_data'][0]->server_time >= $result['detail']['product_data'][0]->flash_start_date): ?>

			var inputTime = "<?php echo e(date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)); ?>";

			var countDownDate = new Date(inputTime).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get todays date and time
			  var now = new Date().getTime();

			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;

			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			  // Display the result in the element with id="demo"
			  document.getElementById("counter_product").innerHTML = days + "d " + hours + "h "
			  + minutes + "m " + seconds + "s ";
				document.getElementById("counter_product").style.display = 'block';
			  // If the count down is finished, write some text
			  if (distance < 0) {
				clearInterval(x);
				document.getElementById("counter_product").innerHTML = "EXPIRED";
				document.getElementById("add-to-Cart").style.display = 'none';
			  }
			}, 1000);
		<?php endif; ?>
	<?php endif; ?>
});
</script>
<?php /**PATH F:\sites\mysan\resources\views/web/product-sections/flash_sale_section.blade.php ENDPATH**/ ?>