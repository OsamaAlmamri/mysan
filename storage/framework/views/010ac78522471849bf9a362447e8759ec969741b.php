<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?php if($result['shppingMethods'][0]->table_name=='free_shipping'): ?>
                  <?php echo e(trans('labels.FreeShipping')); ?>

                <?php elseif($result['shppingMethods'][0]->table_name=='local_pickup'): ?>
                  <?php echo e(trans('labels.LocalPickup')); ?>

                <?php elseif($result['shppingMethods'][0]->table_name=='shipping_by_weight'): ?>
                  <?php echo e(trans('labels.shppingbyweight')); ?>

                <?php endif; ?>

                <small>
                  <?php if($result['shppingMethods'][0]->table_name=='free_shipping'): ?>
                    <?php echo e(trans('labels.FreeShipping')); ?>...
                  <?php elseif($result['shppingMethods'][0]->table_name=='local_pickup'): ?>
                  <?php echo e(trans('labels.LocalPickup')); ?>...
                  <?php elseif($result['shppingMethods'][0]->table_name=='shipping_by_weight'): ?>
                    <?php echo e(trans('labels.shppingbyweight')); ?>...
                  <?php endif; ?>
                </small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>"><i class="fa fa-bars"></i> <?php echo e(trans('labels.Shipping Method')); ?></a></li>
                <li class="active">
                  <?php if($result['shppingMethods'][0]->table_name=='free_shipping'): ?>
                    <?php echo e(trans('labels.FreeShipping')); ?>

                  <?php elseif($result['shppingMethods'][0]->table_name=='local_pickup'): ?> 
                    <?php echo e(trans('labels.LocalPickup')); ?>

                  <?php elseif($result['shppingMethods'][0]->table_name=='shipping_by_weight'): ?>
                    <?php echo e(trans('labels.shppingbyweight')); ?>

                  <?php endif; ?></li>
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
                            <h3 class="box-title">
                              <?php if($result['shppingMethods'][0]->table_name=='free_shipping'): ?>
                                <?php echo e(trans('labels.FreeShipping')); ?>

                              <?php elseif($result['shppingMethods'][0]->table_name=='local_pickup'): ?>
                                <?php echo e(trans('labels.LocalPickup')); ?>

                              <?php elseif($result['shppingMethods'][0]->table_name=='shipping_by_weight'): ?>
                                <?php echo e(trans('labels.shppingbyweight')); ?>

                              <?php endif; ?> </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>
                                        <?php if(count($errors) > 0): ?>
                                            <?php if($errors->any()): ?>
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <?php echo e($errors->first()); ?>

                                                </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/shippingmethods/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                            <?php echo Form::hidden('table_name',  $result['shppingMethods'][0]->table_name , array('class'=>'form-control', 'id'=>'table_name')); ?>

                                            <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="name_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['name']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ShippingmethodName')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/shippingmethods/detail.blade.php ENDPATH**/ ?>