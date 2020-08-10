<a data-id="<?php echo e($id); ?>"
        data-status="<?php echo e($categories_status); ?>"
        class="active_btn"
>
    <?php if($categories_status==1): ?>

        <i class="fa fa-eye"> </i>
    <?php else: ?>

        <i class="fa fa-eye-slash"> </i>
    <?php endif; ?>
</a>
<?php /**PATH F:\sites\mysan\resources\views/admin/categories/btn/status.blade.php ENDPATH**/ ?>