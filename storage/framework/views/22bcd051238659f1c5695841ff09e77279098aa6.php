<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.addshippingrate')); ?> <small><?php echo e(trans('labels.addshippingrate')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/deliveryrates/display')); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('labels.shippingrates')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.addshippingrate')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.addshippingrate')); ?></h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if(count($errors) > 0): ?>
                                <?php if($errors->any()): ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo e($errors->first()); ?>

                                </div>
                                <?php endif; ?>
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
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/deliveryrates/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>



                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Time Duration')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select name="time_duration" class="form-control">
                                                    <option value="06:00AM-08:00AM"> 6:00AM to 8:00AM</option>
                                                    <option value="08:00AM-10:00AM"> 8:00AM to 10:00AM</option>
                                                    <option value="10:00AM-12:00PM"> 10:00AM to 12:00PM</option>
                                                    <option value="12:00PM-02:00PM"> 12:00PM to 02:00PM</option>
                                                    <option value="02:00PM-04:00PM"> 02:00PM to 04:00PM</option>
                                                    <option value="04:00PM-06:00PM"> 04:00PM to 06:00PM</option>
                                                    <option value="06:00PM-08:00PM"> 06:00PM to 08:00PM</option>
                                                    <option value="08:00PM-11:00PM"> 08:00PM to 11:00PM</option>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.ChooseTaxClass')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Zone')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select name="zone_id" class="form-control">
                                                    <?php $__currentLoopData = $result['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($zones->zone_id); ?>"> <?php echo e($zones->zone_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddTaxRateText')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Rate')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('delivery_price', '', array('class'=>'form-control number-validate', 'id'=>'delivery_price')); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddTaxRatePercentageText')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.NumericValueError')); ?></span>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                            <a href="<?php echo e(URL::to('admin/deliveryrates/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\deliveryrates\add.blade.php ENDPATH**/ ?>