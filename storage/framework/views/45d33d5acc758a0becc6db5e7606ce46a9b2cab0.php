<?php $__env->startSection('content'); ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(URL::to('/orders')); ?>"><?php echo app('translator')->get('website.orders'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.Order information'); ?></li>
          </ol>
      </div>
    </nav>
</div> 

<!--My Order Content -->
<section class="order-two-content pro-content">
  <div class="container">
    <div class="page-heading-title">
        <h2>   <?php echo app('translator')->get('website.Order information'); ?>
        </h2>
     
        </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12 col-lg-3 ">
      <div class="heading">
          <h2>
              <?php echo app('translator')->get('website.My Account'); ?>
          </h2>
          <hr >
        </div>

      <ul class="list-group">
          <li class="list-group-item">
              <a class="nav-link" href="<?php echo e(URL::to('/profile')); ?>">
                  <i class="fas fa-user"></i>
                <?php echo app('translator')->get('website.Profile'); ?>
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="<?php echo e(URL::to('/wishlist')); ?>">
                  <i class="fas fa-heart"></i>
               <?php echo app('translator')->get('website.Wishlist'); ?>
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="<?php echo e(URL::to('/orders')); ?>">
                  <i class="fas fa-shopping-cart"></i>
                <?php echo app('translator')->get('website.Orders'); ?>
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="<?php echo e(URL::to('/shipping-address')); ?>">
                  <i class="fas fa-map-marker-alt"></i>
               <?php echo app('translator')->get('website.Shipping Address'); ?>
              </a>
          </li>
          <li class="list-group-item">
              <a class="nav-link" href="<?php echo e(URL::to('/logout')); ?>">
                  <i class="fas fa-power-off"></i>
                <?php echo app('translator')->get('website.Logout'); ?>
              </a>
          </li>
        </ul>
    </div>
    <div class="col-12 col-lg-9 ">
      

        <div class="row">
          <div class="col-12 col-md-5">
              <div class="heading">
                  <h2>
                   
                        <?php echo app('translator')->get('website.orderID'); ?>&nbsp;<?php echo e($result['orders'][0]->orders_id); ?>

                   
                  </h2>
                  <hr >
                </div>

              <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6"><?php echo app('translator')->get('website.orderStatus'); ?></td>
                        <?php if($result['orders'][0]->orders_status_id == '1'): ?>
                          <td class="col-6 col-md-6">
                            <span class="badge badge-primary"><?php echo e($result['orders'][0]->orders_status); ?></span>
                          </td>
                        <?php elseif($result['orders'][0]->orders_status_id == '2'): ?>
                        <td class="col-6 col-md-6">
                            <span class="badge badge-success"><?php echo e($result['orders'][0]->orders_status); ?></span>
                        </td>
                        <?php elseif($result['orders'][0]->orders_status_id == '3'): ?>
                        <td class="col-6 col-md-6">
                            <span class="badge badge-danger"><?php echo e($result['orders'][0]->orders_status); ?></span>
                        </td>
                        <?php else: ?>
                        <td class="col-6 col-md-6">
                          <span class="badge badge-warning"><?php echo e($result['orders'][0]->orders_status); ?></span>
                        </td>
                        <?php endif; ?>
                      </tr>
                      <tr class="d-flex">
                          <td class="col-6 col-md-6">Order Date</td>
                          <td  class="underline col-6 col-md-6" align="left"><?php echo e(date('d/m/Y', strtotime($result['orders'][0]->date_purchased))); ?></td>
                        </tr>
                    </tbody>
              </table>

          </div>
          <div class="col-12 col-md-7">
              <div class="heading">
                  <h2>
                
                      Shipping Details
                 
                  </h2>
                  <hr >
                </div>

              <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="address col-12 col-md-6"><?php echo e($result['orders'][0]->delivery_name); ?></td>


                      </tr>
                      <tr class="d-flex">
                          <td  class="address col-12 col-md-12"><?php echo e($result['orders'][0]->delivery_street_address); ?>, <?php echo e($result['orders'][0]->delivery_city); ?>, <?php echo e($result['orders'][0]->delivery_state); ?>,
                          <?php echo e($result['orders'][0]->delivery_postcode); ?>,  <?php echo e($result['orders'][0]->delivery_country); ?></td>

                        </tr>
                    </tbody>
              </table>

          </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-5">
                <div class="heading">
                    <h2>
                    
                        <?php echo app('translator')->get('website.Billing Detail'); ?>
                   
                    </h2>
                    <hr >
                  </div>

                <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="address col-12"><?php echo e($result['orders'][0]->billing_name); ?></td>
                      </tr>
                      <tr  class="d-flex">
                          <td class="address col-12"><?php echo e($result['orders'][0]->billing_street_address); ?>, <?php echo e($result['orders'][0]->billing_city); ?>, <?php echo e($result['orders'][0]->billing_state); ?>,
                          <?php echo e($result['orders'][0]->billing_postcode); ?>,  <?php echo e($result['orders'][0]->billing_country); ?></td>
                        </tr>
                    </tbody>
              </table>

            </div>
            <div class="col-12 col-md-7">
                <div class="heading">
                    <h2>
                     
                         <?php echo app('translator')->get('website.Payment/Shipping Method'); ?>
                      
                    </h2>
                    <hr >
                  </div>

                <table class="table order-id">
                    <tbody>
                        <tr class="d-flex">
                          <td class="col-6"><?php echo app('translator')->get('website.Shipping Method'); ?></td>
                          <td class="col-6"><?php echo e($result['orders'][0]->shipping_method); ?></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-6"><?php echo app('translator')->get('website.Payment Method'); ?></td>
                            <td class="underline col-6"><?php echo e($result['orders'][0]->payment_method); ?></td>
                          </tr>
                      </tbody>
                </table>

            </div>
          </div>

        <table class="table items">

  
          <tbody>
            <?php
                $price = 0;
            ?>
            <?php if(count($result['orders']) > 0): ?>
                <?php $__currentLoopData = $result['orders'][0]->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $price+= $products->final_price;
                ?>
            <tr class="d-flex responsive-lay">
              <td class="col-12 col-md-2">
                <img class="img-fluid order-img" src="<?php echo e(asset('').$products->image); ?>" alt="<?php echo e($products->products_name); ?>" class="mr-3">
              </td>
              <td class="col-12 col-md-3 item-detail-left">
                <div class="text-body">
                      <h4><?php echo e($products->products_name); ?><br>
                  <small>
                         <?php if(count($products->attributes) >0): ?>
                            <ul>
                              <?php $__currentLoopData = $products->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li><?php echo e($attributes->products_options); ?><span><?php echo e($attributes->products_options_values); ?></span></li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                          <?php endif; ?>
                  </small></h4>

                </div>

                  </div>
              </td>
              <td class="tag-color col-12 col-md-3"><?php echo e(Session::get('symbol_left')); ?><?php echo e($products->final_price/$products->products_quantity*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>
              <td class="col-12 col-md-2">
                  <div class="input-group">
                      <input name="quantity[]" type="text" readonly value="<?php echo e($products->products_quantity); ?>" class="form-control qty" min="1" max="300">

                  </div>
              </td>
              <td  class="tag-s col-12 col-md-2"><?php echo e(Session::get('symbol_left')); ?><?php echo e($products->final_price*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


          </tbody>
        </table>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <?php if(count($result['orders'][0]->statusess)>0): ?>
                    <div style="border-radius:5px;"class="card">
                        <div style="background: none;" class="card-header">
                          <?php echo app('translator')->get('website.Comments'); ?>
                        </div>
                        <div class="card-body">
                        <?php $__currentLoopData = $result['orders'][0]->statusess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$statusess): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($statusess->comments)): ?>
                                <?php if(++$key==1): ?>
                                  <h6><?php echo app('translator')->get('website.Order Comments'); ?>: <?php echo e(date('d/m/Y', strtotime($statusess->date_added))); ?></h6>

                                <?php else: ?>
                                  <h6><?php echo app('translator')->get('website.Admin Comments'); ?>: <?php echo e(date('d/m/Y', strtotime($statusess->date_added))); ?></h6>
                                <?php endif; ?>
                                <p class="card-text"><?php echo e($statusess->comments); ?></p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>


      <!-- ............the end..... -->
    </div>
  </div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/view-order.blade.php ENDPATH**/ ?>