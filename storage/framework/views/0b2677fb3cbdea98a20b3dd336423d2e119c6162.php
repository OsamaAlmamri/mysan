<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Inventory')); ?> <small><?php echo e(trans('labels.Inventory')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
            <?php if($result['products'][0]->products_type==1): ?>
            <li><a href="<?php echo e(URL::to('admin/products/attach/attribute/display/'.$result['products'][0]->products_id)); ?>"><?php echo e(trans('labels.AddOptions')); ?></a></li>
            <?php endif; ?>
            <li class="active"><?php echo e(trans('labels.Inventory')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.addinventory')); ?> </h3>

                    </div>
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
                                        <h4><strong><?php echo e(trans('labels.productName')); ?>:</strong> <?php echo e($result['products'][0]->products_name); ?></h4>
                                        <br>

                                        <div class="row">
                                            <!-- Left col -->
                                            <div class="col-md-6">
                                                <!-- MAP & BOX PANE -->

                                                <!-- /.box -->
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-md-12">
                                                        <!-- USERS LIST -->
                                                        <div class="box box-info">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title"><?php echo e(trans('labels.Add Bouquet')); ?></h3>
                                                                <div class="box-tools pull-right">

                                                                </div>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <?php echo Form::open(array('url' =>'admin/products/inventory/addnewstock', 'name'=>'inventoryfrom', 'id'=>'addewinventoryfrom', 'method'=>'post', 'class' => 'form-horizontal form-validate',
                                                                'enctype'=>'multipart/form-data')); ?>

                                                                <?php echo Form::hidden('products_id', $result['products'][0]->products_id, array('class'=>'form-control', 'id'=>'products_id')); ?>


                                                                <?php if(count($result['attributes'])==0 and $result['products'][0]->products_type==1): ?>
                                                                <div class="alert alert-danger" role="alert">
                                                                    <?php echo e(trans('labels.You can not add stock without attribute for variable product')); ?>

                                                                </div>
                                                                <?php endif; ?>

                                                                <?php if($result['products'][0]->products_type==1): ?>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.products_attributes')); ?></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <ul class="list-group list-group-root well list-group-root2">
                                                                            <?php $__currentLoopData = $result['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li href="#" class="list-group-item"><label style="width:100%">
                                                                                    <input id="attribute" type="hidden" class="attributeid_<?=$attribute['option']['id']?>" name="attributeid[]" value=""> <?php echo e($attribute['option']['name']); ?></label></li>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item">
                                                                                    <?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input name="values_<?=$attribute['option']['id']?>" type="radio" class="currentstock required_one" value="<?php echo e($value['products_attributes_id']); ?>"
                                                                                          attributeid="<?php echo e($attribute['option']['id']); ?>"> <?php echo e($value['value']); ?></label> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
                                                                            </ul>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Select Option values Text')); ?>.</span>
                                                                        <span class="help-block hidden"><?php echo e(trans('labels.Select Option values Text')); ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>

                                                                 <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Current Stock')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p id="current_stocks" style="width:100%"><?php echo e($result['stocks']); ?></p><br>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Total Purchase Price')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p class="purchase_price_content" style="width:100%"><?php echo e($result['currency'][19]->value); ?><span id="total_purchases"><?php echo e($result['purchase_price']); ?></span></p><br>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Current Stock')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p id="current_stocks" style="width:100%"><?php echo e($result['stocks']); ?></p><br>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Total Purchase Price')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p class="purchase_price_content" style="width:100%"><?php echo e($result['currency'][19]->value); ?><span id="total_purchases"><?php echo e($result['purchase_price']); ?></span></p><br>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Enter Stock')); ?></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="stock" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Enter Stock Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Purchase Price')); ?></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="purchase_price" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Purchase Price Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Reference / Purchase Code')); ?></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="reference_code" value="" class="form-control field-required">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Reference / Purchase Code Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <!-- /.users-list -->
                                                            </div>
                                                            <?php if(count($result['attributes'])>0 and $result['products'][0]->products_type==1 or $result['products'][0]->products_type==0): ?>
                                                            <!-- /.box-body -->
                                                            <div class="box-footer text-center">
                                                                <button type="submit" class="btn btn-primary pull-right"><?php echo e(trans('labels.Add Stock')); ?></button>
                                                            </div>

                                                            <?php endif; ?>

                                                            <?php echo Form::close(); ?>

                                                            <!-- /.box-footer -->
                                                        </div>
                                                        <!--/.box -->
                                                    </div>

                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>

                                            <div class="col-md-6">
                                                <!-- MAP & BOX PANE -->

                                                <!-- /.box -->
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-md-12">
                                                        <!-- USERS LIST -->
                                                        <div class="box box-danger">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title"><?php echo e(trans('labels.Manage Min/Max Quantity')); ?></h3>
                                                            </div>
                                                            <!-- /.box-header -->

                                                            <!-- /.box-body -->
                                                          

                                                            <!-- /.box-footer -->
                                                        </div>
                                                        <!--/.box -->
                                                    </div>

                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>

                                            <div class="box-footer col-xs-12">
                                                <?php if($result['products'][0]->products_type==1): ?>
                                                <a href="<?php echo e(URL::to("admin/products/attach/attribute/display/".$result['products'][0]->products_id)); ?>" class="btn btn-default pull-left"><?php echo e(trans('labels.AddOptions')); ?></a>
                                                <?php else: ?>
                                                <a href="<?php echo e(URL::to("admin/products/display")); ?>" class="btn btn-default pull-left"> <i class="fa fa-angle-left"></i> <?php echo e(trans('labels.back')); ?></a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(URL::to("admin/products/images/display/{$result['products'][0]->products_id}")); ?>" class="btn btn-primary pull-right"> <?php echo e(trans('labels.Save_And_Continue')); ?> <i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>


    </section>
    <!-- /.row -->

    <!-- Main row -->
</div>

<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\bouquets\add.blade.php ENDPATH**/ ?>