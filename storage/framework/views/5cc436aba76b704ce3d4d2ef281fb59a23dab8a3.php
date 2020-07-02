
<header class="main-header">


    <!-- Logo -->
    <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size:12px"><b><?php echo e(trans('labels.get_site_name')); ?></b></span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b><?php echo e(trans('labels.get_site_name')); ?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="linkid" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo e(trans('labels.toggle_navigation')); ?></span>
      </a>
		<div id="countdown" style="
    width: 350px;
    margin-top: 13px !important;
    position: absolute;
    font-size: 16px;
    color: #ffffff;
    display: inline-block;
    margin-left: -175px;
    left: 50%;
"></div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-list-ul"></i>
              <span class="label label-success"><?php echo e(count($unseenOrders)); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo e(trans('labels.you_have')); ?> <?php echo e(count($unseenOrders)); ?> <?php echo e(trans('labels.new_orders')); ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php $__currentLoopData = $unseenOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unseenOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><!-- start message -->
                    <a href="<?php echo e(URL::to("admin/viewOrder")); ?>/<?php echo e($unseenOrder->orders_id); ?>">
                      <h4>
                        <?php echo e($unseenOrder->customers_name); ?>

                        <small><i class="fa fa-clock-o"></i> <?php echo e(date('d/m/Y', strtotime($unseenOrder->created_at))); ?></small>
                      </h4>
                      <p>Ordered Products (<?php echo e($unseenOrder->total_products); ?>)</p>
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <!-- end message -->
                </ul>
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-users"></i>
              <span class="label label-warning"><?php echo e(count($newCustomers)); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo e(count($newCustomers)); ?> <?php echo e(trans('labels.new_users')); ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php $__currentLoopData = $newCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newCustomer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <li><!-- start message -->
                    <a href="<?php echo e(URL::to("admin/customers/edit")); ?>/<?php echo e($newCustomer->id); ?>">
                      <div class="pull-left">

                      </div>
                      <h4>
                        
                        <?php echo e($newCustomer->first_name); ?> <?php echo e($newCustomer->last_name); ?>

                        <small><i class="fa fa-clock-o"></i> </small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <!-- end message -->
                </ul>
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-th"></i>
              <span class="label label-warning"><?php echo e(count($lowInQunatity)); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo e(count($lowInQunatity)); ?> <?php echo e(trans('labels.products_are_in_low_quantity')); ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php $__currentLoopData = $lowInQunatity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowInQunatity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><!-- start message -->
                    <a href="<?php echo e(URL::to("admin/editProduct")); ?>/<?php echo e($lowInQunatity->products_id); ?>">
                      <div class="pull-left">
                         <img src="<?php echo e(asset('').'/'.$lowInQunatity->products_image); ?>" class="img-circle" >
                      </div>
                      <h4 style="white-space: normal;">
                        <?php echo e($lowInQunatity->products_name); ?>

                      </h4>
                      <p></p>
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <!-- end message -->
                </ul>
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <span class="hidden-xs"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <p>
                  <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                  <small><?php echo e(trans('labels.administrator')); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(URL::to('admin/admin/profile')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.profile_link')); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo e(URL::to('admin/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(trans('labels.sign_out')); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
<?php /**PATH F:\sites\mysan\resources\views\admin\common\header.blade.php ENDPATH**/ ?>