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

                        <?php if(isset($viewCategory)): ?>
                            <?php echo Form::model($viewCategory, ['route' => ['view_categories.update', $viewCategory->id], 'method' => 'put','class' => 'form-horizontal form-validate', 'files' => true]); ?>


                            <?php echo Form::hidden('oldImage', $viewCategory->image , array('id'=>'oldImage')); ?>

                        <?php else: ?>
                            <?php echo Form::open(array('route' =>'bouquet.store', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'files' => true)); ?>

                        <?php endif; ?>

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

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Products')); ?><span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <select class="form-control field-validate select2 product-type" id="select_product_id" name="products_id">
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
                                                                        <input type="number" id="products_count" name="count" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Enter Stock Text')); ?></span>
                                                                    </div>
                                                                </div>
                                                                <!-- /.users-list -->
                                                            </div>
                                                           <?php if(count($result['products'])> 0): ?>
                                                                <?php if(count($result['attributes'])>0 and $result['products'][0]->products_type==1 or $result['products'][0]->products_type==0): ?>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer text-center">
                                                                    <button type="submit" id="btn_add_bouquets_products" class="btn btn-primary pull-right"><?php echo e(trans('labels.Add Stock')); ?></button>
                                                                </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

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
                                                                <h3 class="box-title"><?php echo e(trans('labels.Products')); ?></h3>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th> المنتج </th>
                                                                        <th>الكمية </th>
                                                                        <th>السمات </th>
                                                                        <th>حذف</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody style="text-align: right;" id="products_list_table">

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <!--/.box -->
                                                    </div>

                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit"  class="btn btn-primary pull-right"><?php echo e(trans('labels.Add Stock')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>


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