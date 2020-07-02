<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo e(trans('labels.Edit')); ?> <?php echo e($result['methods']['method_detail'][1]['name']); ?><small><?php echo e(trans('labels.Edit')); ?> <?php echo e($result['methods']['method_detail'][1]['name']); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i>
                    <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/paymentmethods/index')); ?>"><i class="fa fa-dashboard"></i>
                    <?php echo e(trans('labels.PaymentSetting')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.Edit')); ?> <?php echo e($result['methods']['method_detail'][1]['name']); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.Edit')); ?> <?php echo e($result['methods']['method_detail'][1]['name']); ?></h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if(count($errors) > 0): ?>
                                <?php if($errors->any()): ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <?php echo e($errors->first()); ?>

                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <form enctype="multipart/form-data" class='form-validate'
                                            action="<?php echo e(URL::to('admin/paymentmethods/update')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="id" value="<?php echo e($id); ?>">
                                            <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="shippingEnvironment"
                                                        class="col-sm-2 col-md-2 control-label"
                                                        style=""><?php echo e(trans('labels.Enviroment')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <label class=" control-label">
                                                            <input type="radio" name="enviroment" value="0"
                                                                class="flat-red"
                                                                <?php if($result['methods']['payment_methods']->enviroment==0): ?> checked
                                                            <?php endif; ?> > &nbsp;<?php echo e(trans('labels.Sanbox')); ?>

                                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                        <label class=" control-label">
                                                            <input type="radio" name="enviroment" value="1"
                                                                class="flat-red"
                                                                <?php if($result['methods']['payment_methods']->enviroment==1): ?> checked
                                                            <?php endif; ?> > &nbsp;<?php echo e(trans('labels.Live')); ?>

                                                        </label>
                                                        <span class="help-block"
                                                            style="font-weight: normal;font-size: 11px;margin-bottom: 0; display: none"><?php echo e(trans('labels.BraintreeAccountTypeText')); ?></span>
                                                        <br>
                                                    </div>
                                                </div>
                                                </br>
                                                </br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <?php $__currentLoopData = $result['methods']['method_keys']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <?php if($res->keyname != 'paymentcurrency'): ?>
                                                <div class="col-xs-6" style="margin-bottom: 10px;">
                                                    <div class="form-group">
                                                        <label for="name"
                                                            class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.'.$res->keyname)); ?></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input type="text" name="<?php echo 'field_' .$res->key; ?>"
                                                                id="braintree_merchant_id" value="<?php echo e($res->value); ?>"
                                                                class="form-control field-validate">
                                                            <span class="help-block"
                                                                style="font-weight: normal;font-size: 11px;margin-bottom: 0; display: none"><?php echo e(trans('labels.MerchantIDText')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <hr>
                                            <h4><?php echo e(trans('labels.Translation')); ?></h4>
                                            <hr>
                                            <div class="row">
                                                <?php $__currentLoopData = $result['methods']['method_detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="name"
                                                            class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Name')); ?>

                                                            (<?php echo e($detail['language_name']); ?>) </label>
                                                            <div class="col-sm-10 col-md-8">
                                                            <input type="text" name="name_<?=$detail['languages_id']?>"
                                                                class="form-control field-validate"
                                                                value="<?php echo e($detail['name']); ?>">
                                                            <span class="help-block"
                                                                style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.paymentmethodname')); ?>

                                                                (<?php echo e($detail['language_name']); ?>)</span>
                                                            <span
                                                                class="help-block hidden" style="display: none"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="row">
                                                <div class="box-footer text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary payment-checkbox"><?php echo e(trans('labels.Submit')); ?>

                                                    </button>
                                                    <a href="<?php echo e(URL::to('admin/paymentmethods/index')); ?>" type="button"
                                                        class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /.box-footer -->
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\paymentmethods\display.blade.php ENDPATH**/ ?>