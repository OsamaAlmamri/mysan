<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.ViewOrder')); ?> <small> <?php echo e(trans('labels.ViewOrder')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/orders/display')); ?>"><i class="fa fa-dashboard"></i>  <?php echo e(trans('labels.ListingAllOrders')); ?></a></li>
      <li class="active"> <?php echo e(trans('labels.ViewOrder')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <?php if(session()->has('message')): ?>
       <div class="col-xs-12">
       <div class="row">
      	<div class="alert alert-success alert-dismissible">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> <?php echo e(trans('labels.Successlabel')); ?></h4>
            <?php echo e(session()->get('message')); ?>

        </div>
        </div>
        </div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="col-xs-12">
      	<div class="row">
        	<div class="alert alert-warning alert-dismissible">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> <?php echo e(trans('labels.WarningLabel')); ?></h4>
                <?php echo e(session()->get('error')); ?>

            </div>
          </div>
         </div>
        <?php endif; ?>
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px; margin-top:0;">
            <i class="fa fa-globe"></i> <?php echo e(trans('labels.OrderID')); ?># <?php echo e($data['orders_data'][0]->orders_id); ?>

            <small style="display: inline-block"><?php echo e(trans('labels.OrderedDate')); ?>: <?php echo e(date('m/d/Y', strtotime($data['orders_data'][0]->date_purchased))); ?></small>
            <a href="<?php echo e(URL::to('admin/orders/invoiceprint/'.$data['orders_data'][0]->orders_id)); ?>" target="_blank"  class="btn btn-default pull-right"><i class="fa fa-print"></i> <?php echo e(trans('labels.Print')); ?></a>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
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
        <div class="col-sm-4 invoice-col">
          <?php echo e(trans('labels.ShippingInfo')); ?>

          <address>
            <strong><?php echo e($data['orders_data'][0]->delivery_name); ?></strong><br>
            <?php echo e($data['orders_data'][0]->delivery_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->delivery_city); ?>, <?php echo e($data['orders_data'][0]->delivery_state); ?> <?php echo e($data['orders_data'][0]->delivery_postcode); ?>, <?php echo e($data['orders_data'][0]->delivery_country); ?><br>

            <strong><?php echo e(trans('labels.Phone')); ?>: </strong><?php echo e($data['orders_data'][0]->delivery_phone); ?><br>
           <strong> <?php echo e(trans('labels.ShippingMethod')); ?>:</strong> <?php echo e($data['orders_data'][0]->shipping_method); ?> <br>
           <strong> <?php echo e(trans('labels.ShippingCost')); ?>:</strong> <?php if(!empty($data['orders_data'][0]->shipping_cost)): ?> <?php echo e($data['currency'][19]->value); ?><?php echo e($data['orders_data'][0]->shipping_cost); ?> <?php else: ?> --- <?php endif; ?> <br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <?php echo e(trans('labels.BillingInfo')); ?>

          <address>
            <strong><?php echo e($data['orders_data'][0]->billing_name); ?></strong><br>
            <?php echo e($data['orders_data'][0]->billing_street_address); ?> <br>
            <strong><?php echo e(trans('labels.Phone')); ?>: </strong><?php echo e($data['orders_data'][0]->billing_phone); ?><br>
            <?php echo e($data['orders_data'][0]->billing_city); ?>, <?php echo e($data['orders_data'][0]->billing_state); ?> <?php echo e($data['orders_data'][0]->billing_postcode); ?>, <?php echo e($data['orders_data'][0]->billing_country); ?><br>
          </address>
        </div>
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
              <th><?php echo e(trans('labels.Image')); ?></th>
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
                <td >
                   <img src="<?php echo e(asset('').$products->image); ?>" width="60px"> <br>
                </td>
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
               <!-- <?php echo e($data['orders_data'][0]->coupon_code); ?>-->

          <?php endif; ?>
          <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->

		  <p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.Orderinformation')); ?>:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize; word-break:break-all;">
           <?php if(trim($data['orders_data'][0]->order_information) != '[]' or !empty($data['orders_data'][0]->order_information)): ?>
           		<?php echo e($data['orders_data'][0]->order_information); ?>

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
    <?php echo Form::open(array('url' =>'admin/orders/updateOrder', 'method'=>'post', 'onSubmit'=>'return cancelOrder();', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

     <?php echo Form::hidden('orders_id', $data['orders_data'][0]->orders_id, array('class'=>'form-control', 'id'=>'orders_id')); ?>

     <?php echo Form::hidden('old_orders_status', $data['orders_data'][0]->orders_status_id, array('class'=>'form-control', 'id'=>'old_orders_status')); ?>

     <?php echo Form::hidden('customers_id', $data['orders_data'][0]->customers_id, array('class'=>'form-control', 'id'=>'device_id')); ?>

        <div class="col-xs-12">
        <hr>
          <p class="lead"><?php echo e(trans('labels.ChangeStatus')); ?>:</p>

            <div class="col-md-12">
              <div class="form-group">
                <label><?php echo e(trans('labels.PaymentStatus')); ?>:</label>
                <select class="form-control select2" id="status_id" name="orders_status" style="width: 100%;">

               	 <?php $__currentLoopData = $data['orders_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($orders_status->orders_status_id); ?>" <?php if( $data['orders_data'][0]->orders_status_id == $orders_status->orders_status_id): ?> selected="selected" <?php endif; ?> ><?php echo e($orders_status->orders_status_name); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ChooseStatus')); ?></span>
              </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                <label><?php echo e(trans('labels.Comments')); ?>:</label>
                <?php echo Form::textarea('comments',  '', array('class'=>'form-control', 'id'=>'comments', 'rows'=>'4')); ?>

                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CommentsOrderText')); ?></span>
              </div>
            </div>
        </div>
         <!-- this row will not appear when printing -->
            <div class="col-xs-12">
              <a href="<?php echo e(URL::to('admin/orders/display')); ?>" class="btn btn-default"><i class="fa fa-angle-left"></i> <?php echo e(trans('labels.back')); ?></a>
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo e(trans('labels.Submit')); ?> </button>
              <!--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
              </button>-->

         <br><br> <hr><br>

            </div>
          <?php echo Form::close(); ?>


        <div class="col-xs-12">
          <p class="lead"><?php echo e(trans('labels.OrderHistory')); ?></p>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><?php echo e(trans('labels.Date')); ?></th>
                  <th><?php echo e(trans('labels.Status')); ?></th>
                  <th><?php echo e(trans('labels.Comments')); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $data['orders_status_history']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders_status_history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
							<?php
								$date = new DateTime($orders_status_history->date_added);
								$status_date = $date->format('d-m-Y');
								print $status_date;
							?>
                        </td>
                        <td>
                        	<?php if($orders_status_history->orders_status_id==1): ?>
                            	<span class="label label-warning">
                            <?php elseif($orders_status_history->orders_status_id==2): ?>
                                <span class="label label-success">
                            <?php elseif($orders_status_history->orders_status_id==3): ?>
                                 <span class="label label-danger">
                            <?php else: ?>
                                 <span class="label label-primary">
                            <?php endif; ?>
                            <?php echo e($orders_status_history->orders_status_name); ?>

                                 </span>
                        </td>
                        <td style="text-transform: initial;"><?php echo e($orders_status_history->comments); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/Orders/vieworder.blade.php ENDPATH**/ ?>