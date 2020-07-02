<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <div class="col-xs-12">
      <div class="row">
       <?php if(session()->has('message')): ?>
      	<div class="alert alert-success alert-dismissible">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> <?php echo e(trans('labels.Successlabel')); ?></h4>
            <?php echo e(session()->get('message')); ?>

        </div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        	<div class="alert alert-warning alert-dismissible">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> <?php echo e(trans('labels.WarningLabel')); ?></h4>
                <?php echo e(session()->get('error')); ?>

            </div>
        <?php endif; ?>


       </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
            <i class="fa fa-globe"></i> <?php echo e(trans('labels.OrderID')); ?># <?php echo e($data['orders_data'][0]->orders_id); ?>

            <small class="pull-right"><?php echo e(trans('labels.OrderedDate')); ?>: <?php echo e(date('m/d/Y', strtotime($data['orders_data'][0]->date_purchased))); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <?php echo e(trans('labels.CustomerInfo')); ?>:
          <address>
            <strong><?php echo e($data['orders_data'][0]->customers_name); ?></strong><br>
            <?php echo e($data['orders_data'][0]->customers_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->customers_city); ?>, <?php echo e($data['orders_data'][0]->customers_state); ?> <?php echo e($data['orders_data'][0]->customers_postcode); ?>, <?php echo e($data['orders_data'][0]->customers_country); ?><br>
            <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data['orders_data'][0]->customers_telephone); ?><br>
            <?php echo e(trans('labels.Email')); ?>: <?php echo e($data['orders_data'][0]->email); ?>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <?php echo e(trans('labels.ShippingInfo')); ?>

          <address>
            <strong><?php echo e($data['orders_data'][0]->delivery_name); ?></strong><br>
            <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data['orders_data'][0]->delivery_phone); ?><br>
            <?php echo e($data['orders_data'][0]->delivery_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->delivery_city); ?>, <?php echo e($data['orders_data'][0]->delivery_state); ?> <?php echo e($data['orders_data'][0]->delivery_postcode); ?>, <?php echo e($data['orders_data'][0]->delivery_country); ?><br>
           <strong> <?php echo e(trans('labels.ShippingMethod')); ?>:</strong> <?php echo e($data['orders_data'][0]->shipping_method); ?> <br>
           <strong> <?php echo e(trans('labels.ShippingCost')); ?>:</strong> <?php if(!empty($data['orders_data'][0]->shipping_cost)): ?> <?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->shipping_cost); ?> <?php else: ?> --- <?php endif; ?> <br>
          </address>
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th><?php echo e(trans('labels.Qty')); ?></th>
              <th><?php echo e(trans('labels.ProductName')); ?></th>
              <th><?php echo e(trans('labels.ProductModal')); ?></th>
              <th><?php echo e(trans('labels.Options')); ?></th>
              <th><?php echo e(trans('labels.Price')); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php $__currentLoopData = $data['orders_data'][0]->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($products->products_quantity); ?></td>
                <td  width="30%">
                    <?php echo e($products->products_name); ?><br>
                </td>
                <td>
                    <?php echo e($products->products_model); ?>

                </td>
                <td>
                <?php $__currentLoopData = $products->attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                	<b><?php echo e(trans('labels.Name')); ?>:</b> <?php echo e($attributes->products_options); ?><br>
                    <b><?php echo e(trans('labels.Value')); ?>:</b> <?php echo e($attributes->products_options_values); ?><br>
                    <b><?php echo e(trans('labels.Price')); ?>:</b> <?php echo e($data['currency'][19]->value); ?><?php echo e($attributes->options_values_price); ?><br>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>

                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($products->final_price); ?></td>
             </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
          </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-7">
          <p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.PaymentMethods')); ?>:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
           	<?php echo e(str_replace('_',' ', $data['orders_data'][0]->payment_method)); ?>

          </p>
          <?php if(!empty($data['orders_data'][0]->coupon_code)): ?>
              <p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.Coupons')); ?>:</p>
                <table class="text-muted well well-sm no-shadow stripe-border table table-striped" style="text-align: center; ">
                	<tr>
                        <th style="text-align: center; "><?php echo e(trans('labels.Code')); ?></th>
                        <th style="text-align: center; "><?php echo e(trans('labels.Amount')); ?></th>
                    </tr>
                	<?php $__currentLoopData = json_decode($data['orders_data'][0]->coupon_code); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $couponData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<tr>
                        	<td><?php echo e($couponData->code); ?></td>
                            <td><?php echo e($couponData->amount); ?>


                                <?php if($couponData->discount_type=='percent_product'): ?>
                                    (<?php echo e(trans('labels.Percent')); ?>)
                                <?php elseif($couponData->discount_type=='percent'): ?>
                                    (<?php echo e(trans('labels.Percent')); ?>)
                                <?php elseif($couponData->discount_type=='fixed_cart'): ?>
                                    (<?php echo e(trans('labels.Fixed')); ?>)
                                <?php elseif($couponData->discount_type=='fixed_product'): ?>
                                    (<?php echo e(trans('labels.Fixed')); ?>)
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
          <?php endif; ?>

          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <!--<p class="lead"></p>-->

          <div class="table-responsive ">
            <table class="table order-table">
              <tr>
                <th style="width:50%"><?php echo e(trans('labels.Subtotal')); ?>:</th>
                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($data['subtotal']); ?></td>
              </tr>
              <tr>
                <th><?php echo e(trans('labels.Tax')); ?>:</th>
                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->total_tax); ?></td>
              </tr>
              <tr>
                <th><?php echo e(trans('labels.ShippingCost')); ?>:</th>
                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->shipping_cost); ?></td>
              </tr>
              <?php if(!empty($data['orders_data'][0]->coupon_code)): ?>
              <tr>
                <th><?php echo e(trans('labels.DicountCoupon')); ?>:</th>
                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->coupon_amount); ?></td>
              </tr>
              <?php endif; ?>
              <tr>
                <th><?php echo e(trans('labels.Total')); ?>:</th>
                <td><?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->order_price); ?></td>
              </tr>
            </table>
          </div>

        </div>
        <div class="col-xs-12">
        	<p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.Orderinformation')); ?>:</p>
        	<p class="text-muted well well-sm no-shadow" style="text-transform:capitalize; word-break:break-all;">
            <?php if(trim($data['orders_data'][0]->order_information) != '[]' and !empty($data['orders_data'][0]->order_information)): ?>
           		<?php echo e($data['orders_data'][0]->order_information); ?>

            <?php else: ?>
           		---
            <?php endif; ?>
            </p>
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\Orders\invoiceprint.blade.php ENDPATH**/ ?>