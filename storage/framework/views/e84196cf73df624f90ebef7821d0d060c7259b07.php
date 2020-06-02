<?php $__env->startSection('content'); ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.My Orders'); ?></li>
          </ol>
      </div>
    </nav>
</div> 

     <!--My Order Content -->
     <section class="order-one-content pro-content">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-3  d-none d-lg-block d-xl-block">
            <div class="heading">
                <h2>
                    <?php echo app('translator')->get('website.My Account'); ?>
                </h2>
                <hr >
              </div>
            <?php if(Auth::guard('customer')->check()): ?>
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
              <?php endif; ?>
          </div>
          <div class="col-12 col-lg-9 ">
              <div class="heading">
                  <h2>
                      <?php echo app('translator')->get('website.My Orders'); ?>
                  </h2>
                  <hr >
                </div>
                <?php if(session()->has('message')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <?php echo e(session()->get('message')); ?>

                    </div>

                <?php endif; ?>

              <table class="table order-table">

                <thead>
                  <tr class="d-flex">
                    <th class="col-12 col-md-2"><?php echo app('translator')->get('website.Order ID'); ?></th>
                    <th class="col-12 col-md-2"><?php echo app('translator')->get('website.Order Date'); ?></th>
                    <th class="col-12 col-md-2"><?php echo app('translator')->get('website.Price'); ?></th>
                    <th class="col-12 col-md-3" ><?php echo app('translator')->get('website.Status'); ?></th>
                    <th class="col-12 col-md-3" > Detail</th>

                  </tr>
                </thead>
                <tbody>
                  <?php if(count($result['orders']) > 0): ?>
                  <?php $__currentLoopData = $result['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="d-flex">
                    <td class="col-12 col-md-2"><?php echo e($orders->orders_id); ?></td>
                    <td class="col-12 col-md-2">
                      <?php echo e(date('d/m/Y', strtotime($orders->date_purchased))); ?>

                    </td>
                    <td class="col-12 col-md-2">
                      <?php echo e(Session::get('symbol_left')); ?><?php echo e($orders->order_price * session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?>

                    </td>
                    <td class="col-12 col-md-3">
                        <?php if($orders->orders_status_id == '2'): ?>
                            <span class="badge badge-success"><?php echo e($orders->orders_status); ?></span>
                            &nbsp;&nbsp;/&nbsp;&nbsp;

                            <form action="<?php echo e(URL::to('/updatestatus')); ?>" method="post" onSubmit="return returnOrder();" style="display: inline-block">
                            <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                            <input type="hidden" name="orders_id" value="<?php echo e($orders->orders_id); ?>">
                            <input type="hidden" name="orders_status_id" value="4">
                            <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer"><?php echo e($orders->orders_status); ?>) </button>
                            </form>
                        <?php else: ?>
                          <?php if($orders->orders_status_id == '3'): ?>
                            <span class="badge badge-danger"><?php echo e($orders->orders_status); ?> </span>
                          <?php elseif($orders->orders_status_id == '4'): ?>
                            <span class="badge badge-danger"><?php echo e($orders->orders_status); ?> </span>                                                <?php else: ?>
                            <span class="badge badge-primary"><?php echo e($orders->orders_status); ?></span>
                            &nbsp;&nbsp;/&nbsp;&nbsp;

                            <form action="<?php echo e(URL::to('/updatestatus')); ?>" method="post" onSubmit="return cancelOrder();" style="display: inline-block">
                            <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                            <input type="hidden" name="orders_id" value="<?php echo e($orders->orders_id); ?>">
                            <input type="hidden" name="orders_status_id" value="3">
                            <button type="submit" class="badge badge-danger" style="text-transform:capitalize; cursor:pointer"><?php echo app('translator')->get('website.cancel order'); ?> </button>
                            </form>

                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td align="right" class="col-12 col-md-3"><a href="<?php echo e(URL::to('/view-order/'.$orders->orders_id)); ?>"><?php echo app('translator')->get('website.View Order'); ?></a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4"><?php echo app('translator')->get('website.No order is placed yet'); ?>
                          </td>
                      </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            <!-- ............the end..... -->
          </div>
        </div>
      </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/orders.blade.php ENDPATH**/ ?>