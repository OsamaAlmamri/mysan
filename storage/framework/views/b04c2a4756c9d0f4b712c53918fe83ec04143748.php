<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php if(isset($viewCategory)): ?>
                    <small><?php echo e(trans('labels.EditViewCategory')); ?>...</small>
                <?php else: ?>
                    <small><?php echo e(trans('labels.AddViewCategory')); ?>...</small>
                <?php endif; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/view_categories')); ?>"><i
                            class="fa fa-tablet"></i><?php echo e(trans('labels.ListingAllView_categories')); ?></a></li>
                <li class="active"> <?php if(isset($viewCategory)): ?>
                        <?php echo e(trans('labels.EditViewCategory')); ?>

                    <?php else: ?>
                        <?php echo e(trans('labels.AddViewCategory')); ?>

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
                            <?php if(isset($viewCategory)): ?>
                                <?php echo e(trans('labels.EditViewCategory')); ?>

                            <?php else: ?>
                                <?php echo e(trans('labels.AddViewCategory')); ?>

                            <?php endif; ?>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>
                                        <?php if(count($result['message'])>0): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <?php echo e($result['message']); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="box-body">
                                            <?php if(isset($viewCategory)): ?>
                                                <?php echo Form::model($viewCategory, ['route' => ['view_categories.update', $viewCategory->id], 'method' => 'put','class' => 'form-horizontal form-validate', 'files' => true]); ?>


                                            <?php else: ?>
                                                <?php echo Form::open(array('route' =>'view_categories.store', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'files' => true)); ?>

                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.name_ar')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('name_ar', null, array('class'=>'form-control field-validate', 'id'=>'name_ar')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_name_ar')); ?></span>
                                                    <span
                                                        class="help-block hidden"><?php echo e(trans('labels.view_categories_name_ar')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.name_en')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('name_en',  null, array('class'=>'form-control field-validate', 'id'=>'name_en')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_name_en')); ?></span>
                                                    <span
                                                        class="help-block hidden"><?php echo e(trans('labels.view_categories_name_en')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.view_categories_sort')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::number('sort', null, array('class'=>'form-control field-validate', 'id'=>'sort')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    	<?php echo e(trans('labels.view_categories_sortText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Products')); ?></label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="products[]" multiple
                                                            class="form-control select2 field-validate">
                                                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($products->products_id); ?>"
                                                                <?php if(in_array($products->products_id,$old_products)): ?> selected="" <?php endif; ?> ><?php echo e($products->products_name); ?> <?php echo e($products->products_model); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_products')); ?></span>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit"
                                                        class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/view_categories')); ?>" type="button"
                                                   class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/view_categories/add.blade.php ENDPATH**/ ?>