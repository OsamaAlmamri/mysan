<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;"
       href="<?php echo e(route('bouquets.edit', $bouquet_id )); ?>"><?php echo e(trans('labels.EditProduct')); ?></a>
    <br>

    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(url('admin/products/images/display/'. $bouquet_id)); ?>"><?php echo e(trans('labels.ProductImages')); ?></a>
    <br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId"
       products_id="<?php echo e($bouquet_id); ?>"><?php echo e(trans('labels.DeleteProduct')); ?></a>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/bouquets/btn/manage.blade.php ENDPATH**/ ?>