<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="deleteProductAttributeModalLabel"><?php echo e(trans('labels.DeleteOption')); ?></h4>
</div>
<?php echo Form::open(array('url' =>'admin/products/attach/attribute/default/delete', 'name'=>'deleteattributeform', 'id'=>'deleteattributeform', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

<?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>

<?php echo Form::hidden('products_attributes_id',  $result['data']['products_attributes_id'], array('class'=>'form-control', 'id'=>'products_attributes_id')); ?>

<div class="modal-body">
    <p><?php echo e(trans('labels.DeleteOptionText')); ?></p>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Cancel')); ?></button>
        <button type="button" class="btn btn-primary" id="deleteProductAttribute"><?php echo e(trans('labels.DeleteOption')); ?></button>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\products\modals\deleteproductattributemodal.blade.php ENDPATH**/ ?>