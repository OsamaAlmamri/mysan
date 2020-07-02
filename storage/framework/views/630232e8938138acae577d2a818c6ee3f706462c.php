<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.EditOptions')); ?> <small><?php echo e(trans('labels.EditOptions')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to("admin/dashboard/this_month")); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('labels.Home')); ?> </a></li>
                <li><a href="<?php echo e(URL::to("admin/products/attributes/display")); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.ListingOptions')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditOptions')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.EditOptions')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>
                                        <?php if(count($errors) > 0): ?>
                                            <?php if($errors->any()): ?>
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <?php echo e($errors->first()); ?>

                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/products/attributes/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('products_options_id', $result['editoptions'][0]->products_options_id , array('class'=>'form-control', 'id'=>'products_options_id')); ?>


                                            <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Option Name')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="options_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['name']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Option Name Text')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.Option Name Text')); ?></span>
                                                    </div>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">Update Option</button>
                                                <a href="<?php echo e(URL::to("admin/products/attributes/display")); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\products_attributes\edit.blade.php ENDPATH**/ ?>