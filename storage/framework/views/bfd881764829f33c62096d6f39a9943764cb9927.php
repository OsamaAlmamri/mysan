<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.AddCoupons')); ?> <small><?php echo e(trans('labels.AddCoupons')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/coupons/display')); ?>"><i class="fa fa-tablet"></i><?php echo e(trans('labels.ListingAllCoupons')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.AddCoupons')); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.AddCoupons')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(Session::has('success')): ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo session('success'); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>
                                        <?php if(count($result['message'])>0): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($result['message']); ?>

                                            </div>
                                    <?php endif; ?>
                                    <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/coupons/insert', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Coupon')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('code',  '', array('class'=>'form-control field-validate', 'id'=>'code')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddCouponsTaxt')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.AddCouponsTaxt')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.CouponDescription')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::textarea('description',  '', array('class'=>'form-control', 'rows'=>'5', 'id'=>'description')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                	<?php echo e(trans('labels.CouponDescriptionText')); ?></span>
                                                </div>
                                            </div>
                                        <!--<div class="box">
                            <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.AddCoupons')); ?></h3>
                            </div>
                            </div>-->
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Discounttype')); ?>  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="discount_type" class='form-control'>
                                                        <option value="fixed_cart" selected>Cart Discount</option>
                                                        <option value="percent">Cart % Discount</option>
                                                        <option value="fixed_product">Product Discount</option>
                                                        <option value="percent_product">Product % Discount</option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                	<?php echo e(trans('labels.DiscounttypeText')); ?></span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.CouponAmount')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('amount',  '0', array('class'=>'form-control field-validate', 'id'=>'amount')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                	<?php echo e(trans('labels.CouponAmountText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.AllowFreeShipping')); ?></label>
                                                <div class="col-sm-10 col-md-4" style="padding-top: 7px;">
                                                    <label style="margin-bottom:0">
                                                        <?php echo Form::checkbox('free_shipping', 1, null, ['class' => 'minimal']); ?>

                                                    </label>
                                                    &nbsp; <?php echo e(trans('labels.AllowFreeShippingText')); ?>


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.CouponExpiryDate')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('expiry_date',  '', array('class'=>'form-control field-validate datepicker', 'id'=>'datepicker', 'readonly'=>'readonly')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CouponExpiryDateText')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.CouponExpiryDateText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Minimumspend')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('minimum_amount',  '', array('class'=>'form-control field-validate', 'placeholder'=> trans('labels.NoMinimum'), 'id'=>'minimum_amount')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.MinimumspendText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.MaximumSpend')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('maximum_amount',  '', array('class'=>'form-control field-validate', 'placeholder'=>trans('labels.NoMaximum'), 'id'=>'maximum_amount')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.MaximumSpendText')); ?></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.IndividualUseOnly')); ?> </label>
                                                <div class="col-sm-10 col-md-4"  style="padding-top: 7px; line-height: 22px;">
                                                    <label  style="margin-bottom: 0px;">
                                                        <?php echo Form::checkbox('individual_use', 1, null, ['class' => 'minimal']); ?>

                                                    </label>
                                                    &nbsp; <?php echo e(trans('labels.IndividualUseOnlyText')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ExcludeSaleItems')); ?></label>
                                                <div class="col-sm-10 col-md-4"  style="padding-top: 7px; line-height: 22px;">
                                                    <label  style="margin-bottom: 0px;">
                                                        <?php echo Form::checkbox('exclude_sale_items', 1, null, ['class' => 'minimal']); ?>

                                                    </label>
                                                    &nbsp; <?php echo e(trans('labels.ExcludeSaleItemsText')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Products')); ?></label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="product_ids[]" multiple class="form-control select2 ">
                                                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($products->products_id); ?>"><?php echo e($products->products_name); ?> <?php echo e($products->products_model); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CouponProductsUsed')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ExcludeProducts')); ?></label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="exclude_product_ids[]" multiple class="form-control select2 ">
                                                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($products->products_id); ?>"><?php echo e($products->products_name); ?> <?php echo e($products->products_model); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ExcludeProductsText')); ?></span>
                                                </div>
                                            </div>
//
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.IncludeCategories')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="product_categories[]" multiple class="form-control select2">
                                                        <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($categories->categories_id); ?>"><?php echo e($categories->categories_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.IncludeCategoriesText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ExcludeCategories')); ?> </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="excluded_product_categories[]" multiple class="form-control select2">
                                                        <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($categories->categories_id); ?>"><?php echo e($categories->categories_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ExcludeCategoriesText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.EmailRestrictions')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="email_restrictions[]" multiple class="form-control select2">
                                                        <?php $__currentLoopData = $result['emails']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($emails->email); ?>"><?php echo e($emails->email); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.EmailRestrictionsText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.UsageLimitPerCoupon')); ?> </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::number('usage_limit',  '', array('class'=>'form-control ', 'placeholder'=>trans('labels.Unlimited'), 'id'=>'usage_limit')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UsageLimitPerCouponText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.UsageLimitPerUser')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::number('usage_limit_per_user',  '', array('class'=>'form-control ', 'placeholder'=>trans('labels.Unlimited'), 'id'=>'usage_limit_per_user')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UsageLimitPerUserText')); ?></span>

                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/coupons/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                            </div>
                                            <!-- /.box-footer -->
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/coupons/add.blade.php ENDPATH**/ ?>