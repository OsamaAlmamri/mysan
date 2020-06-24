<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.EditTaxRate')); ?> <small><?php echo e(trans('labels.EditTaxRate')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/tax/taxrates/display')); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('labels.TaxRates')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditTaxRate')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.EditTaxRate')); ?></h3>
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

                                    <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/tax/taxrates/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('id', $result['taxrate']->tax_rates_id, array('class'=>'form-control', 'id'=>'tax_rate')); ?>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.TaxClass')); ?>*  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="tax_class_id" class="form-control">
                                                        <?php $__currentLoopData = $result['tax_class']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                    <?php if($result['taxrate']->tax_class_id == $tax_class->tax_class_id): ?>
                                                                    selected
                                                                    <?php endif; ?>
                                                                    value="<?php echo e($tax_class->tax_class_id); ?>"> <?php echo e($tax_class->tax_class_title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ChooseTaxClass')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Zone')); ?>*
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="tax_zone_id" class="form-control">
                                                        <?php $__currentLoopData = $result['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                    <?php if($result['taxrate']->tax_zone_id == $zones->zone_id): ?>
                                                                    selected
                                                                    <?php endif; ?>
                                                                    value="<?php echo e($zones->zone_id); ?>"> <?php echo e($zones->zone_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddTaxRateText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.AddTaxRatePercentage')); ?>*
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('tax_rate',  $result['taxrate']->tax_rate, array('class'=>'form-control number-validate', 'id'=>'tax_rate')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddTaxRatePercentageText')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.NumericValueError')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Description')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::textarea('tax_description',  $result['taxrate']->tax_description, array('class'=>'form-control', 'id'=>'tax_description')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.TaxDescription')); ?></span>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/tax/taxrates/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/tax/taxrate/edit.blade.php ENDPATH**/ ?>