<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.MediaSetting')); ?><small><?php echo e(trans('labels.MediaTextSetting')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.ImageSize')); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ImageSize')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <?php if(session('update')): ?>
                                                <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong> <?php echo e(session('update')); ?> </strong>
                                                </div>
                                            <?php endif; ?>

                                        <?php if( count($errors) > 0): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only"><?php echo e(trans('labels.ImageSize')); ?>:</span>
                                                        <?php echo e($error); ?></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php echo Form::open(array('url' =>'admin/media/updatemediasetting', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                                <h4><?php echo e(trans('labels.ThumbnailSetting')); ?></h4>
                                                <hr>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Thumbnail_height')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text($web_setting[87]->value,  $web_setting[87]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[87]->value, 'name'=>'ThumbnailHeight')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Thumbnail_height')); ?></span>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Thumbnail_width')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text($web_setting[88]->value,  $web_setting[88]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[88]->value, 'name'=>'ThumbnailWidth')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Thumbnail_width')); ?></span>
                                                    </div>

                                              </div>

                                                <h4><?php echo e(trans('labels.MediumSetting')); ?></h4>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Medium_height')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text($web_setting[89]->value,  $web_setting[89]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[89]->value, 'name'=>'MediumHeight')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Medium_height')); ?></span>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Medium_width')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text($web_setting[90]->value,  $web_setting[90]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[90]->value, 'name'=>'MediumWidth')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Medium_width')); ?></span>
                                                    </div>

                                                </div>
                                                <h4><?php echo e(trans('labels.LargeSetting')); ?></h4>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Large_height')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text($web_setting[91]->value,  $web_setting[91]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[91]->value, 'name'=>'LargeHeight')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Large_height')); ?></span>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Large_width')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text($web_setting[92]->value,  $web_setting[92]->value, array('class'=>'form-control field-validate', 'id'=>$web_setting[92]->value, 'name'=>'LargeWidth')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Large_width')); ?></span>
                                                    </div>

                                                </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                            <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/media/index.blade.php ENDPATH**/ ?>