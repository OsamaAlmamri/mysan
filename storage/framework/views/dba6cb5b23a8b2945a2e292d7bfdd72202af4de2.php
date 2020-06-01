<?php $__env->startSection('content'); ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.COMPARE PRODUCT'); ?></li>
          </ol>
      </div>
    </nav>
</div> 



<!-- Compare Content -->
<section class="compare-content pro-content">

  <div class="container">
    <div class="page-heading-title">
        <h2> <?php echo app('translator')->get('website.COMPARE PRODUCT'); ?> 
        </h2>
     
        </div>
</div>

  <div class="container">
    <div class="row">

      <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-lg-6">
          <table class="table">
              <thead>
                <td align="center">
                  <div class="img-div">
                      <img class="img-fluid" src="<?php echo e($products['product_data'][0]->image_path); ?>">
                  </div>

                </td>
              </thead>

              <tbody>
                <tr>
                  <td>
                    <h2 ><?php echo e($products['product_data'][0]->products_name); ?></h2>
                  </td>

                </tr>
                <tr>
                  <td>
                    <span><?php echo app('translator')->get('website.Price'); ?>&nbsp;:&nbsp;</span>
                    <span class="price-tag">
                      <?php echo e(Session::get('symbol_left')); ?>

                      <?php echo e($products['product_data'][0]->products_price+0*session('currency_value')); ?>

                      <?php echo e(Session::get('symbol_right')); ?>

                  </span>
                </td>
                </tr>
                <tr>
                  <td>
                    <span><?php echo app('translator')->get('website.Discount'); ?>&nbsp;:&nbsp;</span>
                    <?php
                                                $current_date = date("Y-m-d", strtotime("now"));

                                                $string = substr($products['product_data'][0]->products_date_added, 0, strpos($products['product_data'][0]->products_date_added, ' '));
                                                $date=date_create($string);
                                                date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));


                                                $after_date = date_format($date,"Y-m-d");

                                                if($after_date>=$current_date){
                                                }

                                                if(!empty($products['product_data'][0]->discount_price)){
                                                    $discount_price = $products['product_data'][0]->discount_price;
                                                    $orignal_price = $products['product_data'][0]->products_price;

                                                    if(($orignal_price+0)>0){
                              $discounted_price = $orignal_price-$discount_price;
                              $discount_percentage = $discounted_price/$orignal_price*100;
                            }else{
                              $discount_percentage = 0;
                            }
                                              echo "<span style='margin-left:15px' class='discount-tag'>".(int)$discount_percentage."%</span>";
                            }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span><?php echo app('translator')->get('website.New Price'); ?>&nbsp;:&nbsp;</span>
                    <span class="price-tag">
                    <?php echo e(Session::get('symbol_left')); ?>

                    <?php echo e($products['product_data'][0]->discount_price+0*session('currency_value')); ?>

                    <?php echo e(Session::get('symbol_right')); ?>

                  </span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span><?php echo app('translator')->get('website.Categories'); ?>&nbsp;:&nbsp;</span>
                  <?php  foreach($products['product_data'][0]->categories as $f) { ?>
                    <?php echo e($f->categories_name); ?><?php if(++$key === count($products['product_data'][0]->categories)): ?> <?php else: ?>, <?php endif; ?>
                  <?php   } ?>
                  </td>
                </tr>
                <?php  foreach($products['product_data'][0]->attributes as $f) { ?>
                <tr>
                  <td>
                    <span><?php echo e($f['option']['name']); ?>&nbsp;:&nbsp;</span>
                    <?php  foreach($f['values'] as $d) { ?>
                    <span style="margin-left:15px;"><?php echo e($d['value']); ?></span>
                    <?php   } ?>
                  </td>
                </tr>
                <?php   } ?>
                <tr>
                  <td>
                    <div class="detail-buttons">
                        <a href="<?php echo e(URL::to('/product-detail/'.$products['product_data'][0]->products_slug)); ?>" class="btn btn-secondary">View Details</a>
                        <div class="share"><a href="<?php echo e(URL::to("/deletecompare")); ?>/<?php echo e($products['product_data'][0]->products_id); ?>">Remove &nbsp;<i class="fas fa-trash-alt"></i></a> </div>

                    </div>

                  </td>

                </tr>
              </tbody>
            </table>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/compare.blade.php ENDPATH**/ ?>