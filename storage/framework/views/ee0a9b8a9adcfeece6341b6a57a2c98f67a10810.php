<li class="dropdown">

    <?php $qunatity=0; ?>
        <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $qunatity += $cart_data->customers_basket_quantity; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  
    <button class="btn dropdown-toggle" type="button" id="headerOneCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
    <div class="cart-left">
      <i class="fas fa-shopping-bag"></i>
      <span class="badge badge-secondary"><?php echo e($qunatity); ?></span>
    </div>
  
    </button> 
    
    <?php if(count($result['commonContent']['cart'])>0): ?>
   
  
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
        <ul class="shopping-cart-items">
  
          <?php
              $total_amount=0;
              $qunatity=0;
          ?>
          <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
          <?php
          $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
          $qunatity 	  += $cart_data->customers_basket_quantity; ?>
          <li>
            <div class="item-thumb">
                                
              <div class="image">
                <img class="img-fluid" src="<?php echo e(asset('').$cart_data->image); ?>" alt="<?php echo e($cart_data->products_name); ?>"/>
              </div>
            </div>
            <div class="item-detail">
                <h3><?php echo e($cart_data->products_name); ?></h3>
                <div class="item-s"><?php echo e($cart_data->customers_basket_quantity); ?> x <?php echo e(Session::get('symbol_left')); ?><?php echo e($cart_data->final_price*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?> 
                  <a href="<?php echo e(URL::to('/deleteCart?id='.$cart_data->customers_basket_id)); ?>" class="icon" ><i class="fas fa-trash"></i></a></div>
            </div>
          </li>      
  
  
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
          <li>
              <span class="item-summary"><?php echo app('translator')->get('website.Total'); ?>&nbsp;:&nbsp;<span><?php echo e(Session::get('symbol_left')); ?><?php echo e($total_amount*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></span>
              </span>
          </li>
          <li>
              <a class="btn btn-link btn-block" href="<?php echo e(URL::to('/viewcart')); ?>"><?php echo app('translator')->get('website.View Cart'); ?></a>
              <a class="btn btn-secondary btn-block swipe-to-top" href="<?php echo e(URL::to('/checkout')); ?>"><?php echo app('translator')->get('website.Checkout'); ?></a>
          </li>
        </ul>
    </div>
  
  
          <?php else: ?>
  
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
              <ul class="shopping-cart-items">
                  <li><?php echo app('translator')->get('website.You have no items in your shopping cart'); ?></li>
              </ul>
          </div>
          <?php endif; ?>
  
  
  
  
  
<!--
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->
  <?php /**PATH F:\sites\mysan\resources\views/web/headers/cartButtons/cartButton.blade.php ENDPATH**/ ?>