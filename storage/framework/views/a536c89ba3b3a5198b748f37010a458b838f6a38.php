<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="<?php echo e(url('admin/products/edit')); ?>/<?php echo e($products_id); ?>"><?php echo e(trans('labels.EditProduct')); ?></a>
    </br>
    <?php if($products_type==1): ?>
        <a class="btn btn-info" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(url('admin/products/attach/attribute/display')); ?>/<?php echo e($products_id); ?>"><?php echo e(trans('labels.ProductAttributes')); ?></a>

        </br>
    <?php endif; ?>
    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(url('admin/products/images/display/'. $products_id)); ?>"><?php echo e(trans('labels.ProductImages')); ?></a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="<?php echo e($products_id); ?>"><?php echo e(trans('labels.DeleteProduct')); ?></a>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/products/btn/manage.blade.php ENDPATH**/ ?>