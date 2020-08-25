<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;"
       href="<?php echo e(route('bouquets.edit', $bouquet_id )); ?>"><?php echo e(trans('labels.EditBouquet')); ?></a>
    <br>



    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(route('products.images.display',['id'=>$bouquet_id,'type'=>'bouquet'])); ?>"><?php echo e(trans('labels.ProductImages')); ?></a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(route('bouquets.delete',encrypt( $bouquet_id))); ?>"
       onclick="return confirm('هل أنت متأكد من الحذف');"
    ><?php echo e(trans('labels.DeleteBouquet')); ?></a>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/bouquets/btn/manage.blade.php ENDPATH**/ ?>