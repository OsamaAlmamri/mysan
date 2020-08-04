<?php if($id!=1): ?>
    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/currencies/edit/'. $id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    <a id="delete" category_id="<?php echo e($id); ?>" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php else: ?>
    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/currencies/edit/'. $id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<?php endif; ?>
<?php /**PATH F:\sites\mysan\resources\views/admin/currencies/btn/manage.blade.php ENDPATH**/ ?>