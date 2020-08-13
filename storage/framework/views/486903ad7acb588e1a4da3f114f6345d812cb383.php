<?php $__env->startSection('header_h1'); ?>
    <h1>  <?php echo e(trans('labels.view_customers_basket_detail')); ?> </small></h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    /
    <a href="<?php echo e(route('report.show','customers_basket')); ?>"><i
            class="fa fa-file"></i> <?php echo e(trans('labels.customers_basket')); ?></a></li>
    /
    <li class="active"> <?php echo e(trans('labels.ViewBasketDetails')); ?></li><?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog" aria-labelledby="deleteCoupanModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteCoupanModalLabel"><?php echo e(trans('labels.DeleteCoupon')); ?></h4>
                </div>
                <?php echo Form::open(array('url' =>'admin/coupons/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')); ?>

                <div class="modal-body">
                    <p><?php echo e(trans('labels.DeleteCouponText')); ?></p>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger"
                            id="deleteCoupanBtn"><?php echo e(trans('labels.Delete')); ?> </button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reports/basketDetail.blade.php ENDPATH**/ ?>