<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1> <?php echo e(trans('labels.Options Value')); ?> <small><?php echo e(trans('labels.Options Value')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Options Value')); ?></li>
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
                            <h3 class="box-title"> <?php echo e(trans('labels.Options Value for')); ?> <?php $__currentLoopData = $result['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <strong><?php echo e($option->options_name); ?></strong> <?php if(count($result['options']) != $key+1): ?><span> / </span> <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></h3>
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
                                <div class="col-md-6">
                                    <?php echo Form::open(array('url' =>'admin/products/attributes/options/values/insert', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                    <?php echo Form::hidden('products_options_id', $result['options'][0]->products_options_id , array('class'=>'form-control', 'id'=>'products_options_values_id')); ?>


                                    <h4><?php echo e(trans('labels.Add Option Value')); ?></h4>
                                    <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Option Value')); ?> (<?php echo e($languages->name); ?>)</label>
                                            <div class="col-sm-10 col-md-8">
                                                <input type="text" name="ValuesName_<?=$languages->languages_id?>" class="form-control field-validate">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Option Value Text')); ?> (<?php echo e($languages->name); ?>).</span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.Option Value Text')); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="">
                                        <a href="<?php echo e(URL::to('admin/products/attributes/display')); ?>" type="button" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> <?php echo e(trans('labels.attributes')); ?></a>
                                        <button type="submit" class="btn btn-primary pull-right"><?php echo e(trans('labels.Add Values')); ?></button>
                                    </div>

                                    <!-- /.box-footer -->
                                    <?php echo Form::close(); ?>


                                </div>
                                <div class="col-md-6">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.Values')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($result['content'])>0): ?>
                                            <?php $__currentLoopData = $result['content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr id="tr_parent_<?php echo e($data->products_options_values_id); ?>">
                                                    <td><?php echo e($data->products_options_values_id); ?></td>
                                                    <td dir="ltr">
                                                        <?php $__currentLoopData = $data->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <p>
                                                                <strong><?php echo e($language->name); ?>:</strong>
                                                                <?php if(count($language->values)>0): ?>
                                                                    <?php $__currentLoopData = $language->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php echo e($value->options_values_name); ?><br>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    --- <br>
                                                                <?php endif; ?>
                                                            </p>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="" href="<?php echo e(URL::to('admin/products/attributes/options/values/edit')); ?>/<?php echo e($data->products_options_values_id); ?>" class="badge bg-light-blue" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="javascript:void(0)" value_id="<?php echo e($data->products_options_values_id); ?>" option_id="<?php echo e($result['options'][0]->products_options_id); ?>" data-toggle="tooltip" data-placement="bottom" title="" class="badge bg-red delete-value" data-original-title="Delete Value"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
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

            <div class="modal fade" id="productListModalValue" tabindex="-1" role="dialog" aria-labelledby="productListModalValueLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="productListModalValueLabel"><?php echo e(trans('labels.AssociatedProducts')); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo e(trans('labels.DeletingValueErrorMessage')); ?></strong></p>
                            <ul style="padding:0" id="assciate-products-value">
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Ok')); ?></button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- deleteattributeModal -->

            <div class="modal fade" id="deleteValueModal" tabindex="-1" role="dialog" aria-labelledby="deleteValueModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteValueModalLabel"><?php echo e(trans('labels.DeleteValue')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/products/attributes/options/values/delete', 'name'=>'deleteValue', 'id'=>'deleteValue', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('value_id',  '', array('class'=>'form-control', 'id'=>'value_id')); ?>

                        <?php echo Form::hidden('delete_language_id', '' , array('class'=>'form-control', 'id'=>'delete_language_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteValuePrompt')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="button" class="btn btn-primary" id="deleteAttribute"><?php echo e(trans('labels.DeleteValue')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>

                </div>

            </div>
            <!-- Main row -->
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products_attributes/options/index.blade.php ENDPATH**/ ?>