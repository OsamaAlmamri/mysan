<?php echo e($reviews_id); ?>

<?php if($reviews_read == 0 and $reviews_status == 0): ?>
    <span
        class="label label-success"><?php echo e(trans('labels.new')); ?></span>
<?php elseif($reviews_read == 1 and $reviews_status == 0): ?>
    <span
        class="label label-info"><?php echo e(trans('labels.pending')); ?></span>
<?php elseif($reviews_read == 1 and $reviews_status == 1): ?>
    <span
        class="label label-primary"><?php echo e(trans('labels.seen')); ?></span>
<?php elseif($reviews_read == 1 and $reviews_status == -1): ?>
    <span
        class="label label-danger"><?php echo e(trans('labels.Deactive')); ?></span>
<?php endif; ?>
<?php /**PATH F:\sites\mysan\resources\views/admin/reviews/btn/id.blade.php ENDPATH**/ ?>