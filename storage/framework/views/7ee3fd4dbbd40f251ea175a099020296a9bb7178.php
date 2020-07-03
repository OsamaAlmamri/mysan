<?php $__env->startSection('content'); ?>
       <!-- End Header Content -->

       <!-- NOTIFICATION CONTENT -->
         <?php echo $__env->make('web.common.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- END NOTIFICATION CONTENT -->

       <!-- Carousel Content -->
       <?php  echo $final_theme['carousel']; ?>
       <!-- Fixed Carousel Content -->

      <!-- Banners Content -->
      <!-- Products content -->

      <?php

      $product_section_orders = json_decode($final_theme['product_section_order'], true);
      foreach ($product_section_orders as $product_section_order){
          if($product_section_order['order'] == 1 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 2 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 3 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 4 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 5 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 6 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 7 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 8 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
        ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
          }
          if($product_section_order['order'] == 9 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
        ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
          }
          if($product_section_order['order'] == 10 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
        ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
          }
          if($product_section_order['order'] == 11 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
        ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
          }
          if($product_section_order['order'] == 12 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
        ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
          }
       }
      ?>
<?php echo $__env->make('web.common.scripts.addToCompare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('web.common.scripts.Like', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/web/index.blade.php ENDPATH**/ ?>