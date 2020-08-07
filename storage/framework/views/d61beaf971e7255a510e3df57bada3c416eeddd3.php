<?php $__env->startSection('btn_add'); ?>
    <div class="box-header">
        <div class="box-tools pull-right">
            <a href="<?php echo e(URL::to('admin/manufacturers/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_h1'); ?>
    <h1> <?php echo e(trans('labels.Manufacturer')); ?> <small><?php echo e(trans('labels.ListingAllManufacturers')); ?>...</small> </h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class=" active"><?php echo e(trans('labels.Manufacturer')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <!-- deleteManufacturerModal -->
    <div class="modal fade" id="manufacturerModal" tabindex="-1" role="dialog" aria-labelledby="deleteManufacturerModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteManufacturerModalLabel"><?php echo e(trans('labels.DeleteManufacturer')); ?></h4>
                </div>
                <?php echo Form::open(array('url' =>'admin/manufacturers/delete', 'name'=>'deleteManufacturer', 'id'=>'deleteManufacturer', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                <?php echo Form::hidden('manufacturers_id',  '', array('class'=>'form-control', 'id'=>'manufacturers_id')); ?>

                <div class="modal-body">
                    <p><?php echo e(trans('labels.DeleteManufacturerText')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Delete')); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/manufacturers/index2.blade.php ENDPATH**/ ?>