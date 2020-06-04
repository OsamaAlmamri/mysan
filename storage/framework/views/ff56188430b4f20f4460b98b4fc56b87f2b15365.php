<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="deleteProductImageModalLabel"><?php echo e(trans('labels.DeleteImages')); ?></h4>
</div>
<?php echo Form::open(array('url' =>'admin/products/images/deleteproductimage', 'name'=>'deleteImageForm', 'id'=>'deleteImageForm', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

<?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>

<?php echo Form::hidden('id',  $result['data']['id'], array('class'=>'form-control', 'id'=>'id')); ?>

<div class="modal-body">
    <p><?php echo e(trans('labels.DeleteImagesText')); ?></p>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Cancel')); ?></button>
        <button type="submit" class="btn btn-primary" ><?php echo e(trans('labels.Delete')); ?></button>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products/images/modal/delete.blade.php ENDPATH**/ ?>