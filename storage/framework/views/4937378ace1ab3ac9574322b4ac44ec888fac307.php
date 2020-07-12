<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.EditUnit')); ?> <small><?php echo e(trans('labels.EditUnit')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/units')); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('labels.ListingUnits')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditUnit')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.EditUnit')); ?></h3>
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
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/updateunit', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('id', $result['units']->unit_id, array('class'=>'form-control', 'id'=>'unit_id')); ?>

                                            

                                            <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.UnitName')); ?> (<?php echo e($content['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="UnitName_<?=$content['languages_id']?>" class="form-control field-validate" value="<?php echo e($content['units_name']); ?>" >
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UnitNameMessage')); ?> (<?php echo e($content['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.UnitNameMessage')); ?></span>
                                                    </div>
                                                </div>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="is_active">
                                                        <option value="1" <?php if($result['units']->is_active==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                                        <option value="0" <?php if($result['units']->is_active==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.InActive')); ?></option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.StatusUnitText')); ?></span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                    <a href="<?php echo e(URL::to('admin/units')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                                </div>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/settings/general/units/edit.blade.php ENDPATH**/ ?>