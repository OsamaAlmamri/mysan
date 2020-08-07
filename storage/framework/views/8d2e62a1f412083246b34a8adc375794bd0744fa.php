<a data-id="<?php echo e($products_id); ?>"
        data-status="<?php echo e($products_status); ?>"
        class="active"
>
    <?php if($products_status==1): ?>
        <i class="fa fa-eye"> </i>
    <?php else: ?>
        <i class="fa fa-eye-slash"> </i>
    <?php endif; ?>
</a>
<?php /**PATH F:\sites\mysan\resources\views/admin/products/btn/status.blade.php ENDPATH**/ ?>