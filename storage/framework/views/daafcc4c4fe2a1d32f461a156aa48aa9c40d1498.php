<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.AddImages')); ?> <small><?php echo e(trans('labels.AddProductImages')); ?>...</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <?php if(isset($products_type) and $products_type=='bouquet'): ?>
                    <li><a href="<?php echo e(route('bouquets.index')); ?>"><i
                                class="fa fa-database"></i> <?php echo e(trans('labels.Bouquets')); ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(URL::to('admin/products/images/display')."/$products_id"); ?>">
                            <i class="fa fa-database"></i><?php echo e(trans('labels.ListingAllProductsImages')); ?></a></li>
                <?php endif; ?>
                <li class="active"><?php echo e(trans('labels.AddImages')); ?></li>


            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ListingAllProductsImages')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a type="button" class="btn btn-block btn-primary"
                                   href="<?php echo e(route('products.images.add',['id'=>$products_id,'type'=>$products_type])); ?>">
                                    <?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="row">
                                <?php if(count($result['products_images']) > 0): ?>
                                    <?php $__currentLoopData = $result['products_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-xs-4 col-md-2 margin-bottomset">
                                            <div class="thumbnail">
                                                <div class="caption">
                                                    <a class="badge bg-light-blue editProductImagesModal"
                                                       href="<?php echo e(url('admin/products/images/editproductimage/')); ?>/<?php echo e($products_image->id); ?>}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a products_id='<?php echo e($products_image->products_id); ?>'
                                                       id="<?php echo e($products_image->id); ?>"
                                                       class="badge bg-red deleteProductImagesModal"><i
                                                            class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                </div>
                                                <img width="200px" height="300px" src="<?php echo e(asset($products_image->path)); ?>"
                                                     alt="...">
                                                Sort Order : <?php echo e($products_image->sort_order); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <div class="col-xs-12 text-right">
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <a href="<?php echo e((isset($products_type) and $products_type=='bouquet')?  route('bouquets.index'): URL::to('admin/products/display')); ?>"
                                   class="btn btn-default"><?php echo e(trans('labels.Save_And_complete')); ?></a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- deleteProductImageModal -->
            <div class="modal fade" id="deleteProductImageModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteProductImageModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content deleteImageEmbed">
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/products/images/index.blade.php ENDPATH**/ ?>