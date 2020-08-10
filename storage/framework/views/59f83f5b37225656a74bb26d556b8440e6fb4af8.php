<td>
    <?php echo e($product_question_id); ?>

    <?php if($question_read == 0 and $question_status == 0): ?>
        <span
            class="label label-success"><?php echo e(trans('labels.new')); ?></span>
    <?php elseif($question_read == 1 and $question_status == 0): ?>
        <span
            class="label label-info"><?php echo e(trans('labels.pending')); ?></span>
    <?php elseif($question_read == 1 and $question_status == 1): ?>
        <span
            class="label label-primary"><?php echo e(trans('labels.seen')); ?></span>
    <?php elseif($question_read == 1 and $question_status == -1): ?>
        <span
            class="label label-danger"><?php echo e(trans('labels.Deactive')); ?></span>
    <?php endif; ?>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/product_questions/btn/id.blade.php ENDPATH**/ ?>