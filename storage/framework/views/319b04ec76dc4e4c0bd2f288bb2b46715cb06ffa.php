<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1> <?php echo e(trans('labels.AddImages')); ?> <small><?php echo e(trans('labels.AddImages')); ?>...</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>

                <?php if(isset($products_type) and $products_type=='bouquet'): ?>
                    <li><a href="<?php echo e(route('bouquets.index')); ?>"><i
                            class="fa fa-database"></i> <?php echo e(trans('labels.Bouquets')); ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i
                                class="fa fa-database"></i><?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
                <?php endif; ?>
                <li><a href="<?php echo e(URL::to('admin/products/images/display')."/$products_id" ."/$products_type"); ?>">
                        <i class="fa fa-database"></i><?php echo e(trans('labels.ListingAllProductsImages')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.AddImages')); ?></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.AddImage')); ?> </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <?php if((isset($products_images)) and  $products_images !=null): ?>
                                                <?php echo Form::open(array('url' =>'admin/products/images/updateproductimage', 'name'=>'editImageFrom', 'id'=>'editImageFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                                                <?php echo Form::hidden('id',  $products_images[0]->id, array('class'=>'form-control', 'id'=>'id')); ?>

                                                <?php echo Form::hidden('oldImage',  $products_images[0]->image , array('id'=>'oldImage')); ?>

                                                <?php echo Form::hidden('sort_order',  $products_images[0]->sort_order, array('class'=>'form-control', 'id'=>'sort_order')); ?>

                                            <?php else: ?>
                                                <?php echo Form::open(array('url' =>'admin/products/images/insertproductimage', 'name'=>'addImageFrom', 'id'=>'addImageFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                                                <?php echo Form::hidden('sort_order',  count($result['products_images'])+1, array('class'=>'form-control', 'id'=>'sort_order')); ?>

                                            <?php endif; ?>
                                            <?php echo Form::hidden('products_id',  $products_id, array('class'=>'form-control', 'id'=>'products_id')); ?>

                                            <?php echo Form::hidden('products_type',  $products_type, array('class'=>'form-control', 'id'=>'products_type')); ?>

                                            <div class="modal-body">
                                                <?php echo $__env->make("admin.common.image_to_select", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php if((isset($products_images)) and  $products_images !=null): ?>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label">Sort
                                                            Order</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?php echo Form::text('sort_order',  $products_images[0]->sort_order, array('class'=>'form-control', 'id'=>'sort_order')); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label for="name"
                                                           class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Description')); ?></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <div class="col-md-6 col-sm-6">
                                                            <?php echo Form::textarea('htmlcontent',  (isset($products_images) and  $products_images !=null)?  $products_images[0]->htmlcontent:null, array('class'=>'form-control', 'id'=>'htmlcontent', 'colspan'=>'3' )); ?>

                                                            <span class="help-block"
                                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ImageDescription')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert alert-danger addError"
                                                     style="display: none; margin-bottom: 0;" role="alert"><i
                                                        class="icon fa fa-ban"></i><?php echo e(trans('labels.ImageDescription')); ?>

                                                </div>
                                                <div class="alert alert-danger addError"
                                                     style="display: none; margin-bottom: 0;" role="alert"><i
                                                        class="icon fa fa-ban"></i> <?php echo e(trans('labels.ChooseImageText')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-4 control-label"> </label>
                                                <div class="col-sm-10 col-md-8 float-right">
                                                    <a type="button" class="btn btn-default"
                                                       href="<?php echo e(url('admin/products/images/display')); ?>/<?php echo e($products_id); ?>"><?php echo e(trans('labels.Close')); ?></a>
                                                    <button type="submit"
                                                            class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                </div>
                                                <br><br><br><br><br>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/products/images/edit.blade.php ENDPATH**/ ?>