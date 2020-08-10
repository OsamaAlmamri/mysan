<td>
    <?php if( $question_status == 0): ?>

        <a class="btn btn-warning"
           style="width: 100%;  margin-bottom: 5px;"
           href="<?php echo e(URL::to('admin/product_questions/edit/'.$product_question_id.'/0')); ?>"><?php echo e(trans('labels.pending')); ?></a>
        </br>
    <?php endif; ?>
    <a class="btn btn-success"
       style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(URL::to('admin/product_questions/edit/'.$product_question_id.'/1')); ?>"><?php echo e(trans('labels.Active')); ?></a>
    </br>
    <a class="btn btn-info"
       style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(URL::to('admin/product_questions/show/'.$product_question_id)); ?>"><?php echo e(trans('labels.Replay')); ?></a>
    </br>
    <a class="btn btn-danger"
       style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(URL::to('admin/product_questions/edit/'.$product_question_id.'/-1')); ?>"><?php echo e(trans('labels.Deactive')); ?></a>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/product_questions/btn/manage.blade.php ENDPATH**/ ?>