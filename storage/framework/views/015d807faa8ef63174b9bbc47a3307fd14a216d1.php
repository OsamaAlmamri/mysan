<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1> <?php echo e(trans('labels.Options')); ?> <small><?php echo e(trans('labels.ListingAllOptions')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Options')); ?></li>
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
                            <h3 class="box-title"> <?php echo e(trans('labels.ListingAllOptions')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/products/attributes/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.Options')); ?></th>
                                            <th width="40%"><?php echo e(trans('labels.Values')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($result['attributes'])>0): ?>
                                            <?php $__currentLoopData = $result['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($data->products_options_id); ?></td>
                                                    <td dir="ltr">
                                                        <?php $__currentLoopData = $data->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <strong><?php echo e($language->name); ?>:</strong>
                                                            <?php if(count($language->attributes)>0): ?>
                                                                <?php $__currentLoopData = $language->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo e($attribute->options_name); ?><br>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                --- <br>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(URL::to('admin/products/attributes/edit')); ?>/<?php echo e($data->products_options_id); ?>" ><?php echo e(trans('labels.Manage Options')); ?></a><br>
                                                    </td>
                                                    <td dir="ltr">
                                                        <?php $__currentLoopData = $data->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <strong><?php echo e($language->name); ?>:</strong>
                                                            <?php if(count($language->values)>0): ?>
                                                                <?php $__currentLoopData = $language->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo e($value->options_values_name); ?>,
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                --- <br>
                                                            <?php endif; ?>
                                                            <br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(URL::to('admin/products/attributes/options/values/display')); ?>/<?php echo e($data->products_options_id); ?>" ><?php echo e(trans('labels.Manage Values')); ?></a><br>
                                                    </td>
                                                    <td><a option_id="<?php echo e($data->products_options_id); ?>" class="badge bg-red deleteOption"><i class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>

                                    </table>

                                    <div class="col-xs-12 text-right">


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

            <!-- deleteAttributeModal -->

            <div class="modal fade" id="deleteattributeModal" tabindex="-1" role="dialog" aria-labelledby="deleteAttributeModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="deleteAttributeModalLabel"><?php echo e(trans('labels.DeleteOption')); ?></h4>

                        </div>

                        <?php echo Form::open(array('url' =>'admin/products/attributes/delete', 'name'=>'deleteAttribute', 'id'=>'deleteAttribute', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>


                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>


                        <?php echo Form::hidden('option_id',  '', array('class'=>'form-control', 'id'=>'option_id')); ?>


                        <div class="modal-body">

                            <p><?php echo e(trans('labels.DeleteOptionPrompt')); ?></p>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>

                            <button type="submit" class="btn btn-primary" id="deleteAttribute"><?php echo e(trans('labels.DeleteOption')); ?></button>

                        </div>

                        <?php echo Form::close(); ?>


                    </div>

                </div>

            </div>



            <div class="modal fade" id="productListModal" tabindex="-1" role="dialog" aria-labelledby="productListModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="productListModalLabel"></h4>

                        </div>

                        <div class="modal-body">
                            <p><strong><?php echo e(trans('labels.DeletingErrorMessage')); ?></strong></p>
                            <ul style="padding:0" id="assciate-products">
                            </ul>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Ok')); ?></button>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Main row -->
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products_attributes/index.blade.php ENDPATH**/ ?>