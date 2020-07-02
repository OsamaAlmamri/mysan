<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Bouquets')); ?> <small><?php echo e(trans('labels.Bouquets')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-database"></i> <?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
            <?php if(count($result['products'])> 0 && $result['products'][0]->products_type==1): ?>
            <li><a href="<?php echo e(URL::to('admin/products/attach/attribute/display/'.$result['products'][0]->products_id)); ?>"><?php echo e(trans('labels.AddOptions')); ?></a></li>
            <?php endif; ?>
            <li class="active"><?php echo e(trans('labels.Bouquets')); ?></li>
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
                                                                <h3 class="box-title"><?php echo e(trans('labels.Add Stock')); ?></h3>
                                                                <div class="box-tools pull-right">

                                                                </div>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <?php echo Form::open(array('url' =>'admin/products/inventory/addnewstock', 'name'=>'inventoryfrom', 'id'=>'addewinventoryfrom', 'method'=>'post', 'class' => 'form-horizontal form-validate',
                                                                'enctype'=>'multipart/form-data')); ?>


                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Products')); ?><span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <select class="form-control field-validate product-type" name="products_id">
                                                                            <option value=""><?php echo e(trans('labels.Choose Product')); ?></option>
                                                                            <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($pro->products_id); ?>"><?php echo e($pro->products_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Product Type Text')); ?>.</span>
                                                                    </div>
                                                                </div>
                                                                <div id="attribute" style="display:none">

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Current Stock')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p id="current_stocks" style="width:100%">0</p><br>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Total Purchase Price')); ?>

                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p class="purchase_price_content" style="width:100%"><?php echo e($result['currency'][19]->value); ?><span id="total_purchases">0</span></p><br>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Enter Stock')); ?><span style="color:red;">*</span></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="stock" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Enter Stock Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Purchase Price')); ?><span style="color:red;">*</span></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="purchase_price" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Purchase Price Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Reference / Purchase Code')); ?></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="reference_code" value="" class="form-control field-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Reference / Purchase Code Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <!-- /.users-list -->
                                                            </div>
                                                           <?php if(count($result['products'])> 0): ?>
                                                                <?php if(count($result['attributes'])>0 and $result['products'][0]->products_type==1 or $result['products'][0]->products_type==0): ?>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer text-center">
                                                                    <button type="submit" id="attribute-btn" class="btn btn-primary pull-right"><?php echo e(trans('labels.Add Stock')); ?></button>
                                                                </div>
                                                                <?php endif; ?>
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
                                                            <div class="box-body">
                                                                <?php echo Form::open(array('url' =>'admin/products/inventory/addminmax', 'name'=>'addminmax', 'id'=>'addminmax', 'method'=>'post', 'class' => 'form-horizontal form-validate-level',
                                                                'enctype'=>'multipart/form-data')); ?>

                                                                 <input class="form-control check_reference_id" id="inventory_ref_id" name="inventory_ref_id" type="hidden" value="">
                                                                 <input class="form-control check_reference_id" id="inventory_pro_id" name="products_id" type="hidden" value="">

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Min Level')); ?><span style="color:red;">*</span>
                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="min_level" id="min_level" value="" class="form-control number-validate-level">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Min Level Text')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        <?php echo e(trans('labels.Max Level')); ?><span style="color:red;">*</span>
                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="max_level" id="max_level" value="" class="form-control number-validate-level">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Min Level Text')); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-danger alert-dismissible" id="minmax-error" role="alert" style="display: none">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <?php echo e(trans('labels.This stock is not asscociated with any attributes. Please choose products attributes first')); ?>

                                                                </div>
                                                                <!-- /.users-list -->
                                                            </div>
                                                            <!-- /.box-body -->
                                                            <?php if(count($result['products'])> 0): ?>
                                                            <div class="box-footer text-center">
                                                                <button type="submit" class="btn btn-primary pull-right"><?php echo e(trans('labels.Submit')); ?></button>
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

                                            <div class="box-footer col-xs-12">
                                                <?php if(count($result['products'])> 0 && $result['products'][0]->products_type==1): ?>
                                                <a href="<?php echo e(URL::to("admin/products/attach/attribute/display/".$result['products'][0]->products_id)); ?>" class="btn btn-default pull-left"><?php echo e(trans('labels.AddOptions')); ?></a>
                                                <?php endif; ?>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/bouquets/add1.blade.php ENDPATH**/ ?>