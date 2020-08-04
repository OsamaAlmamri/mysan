<td>
    <?php if($reviews_read == 0 and $reviews_status == 0): ?>
        <a class="btn btn-warning"
           style="width: 100%;  margin-bottom: 5px;"
           href="<?php echo e(URL::to('admin/reviews/edit/'.$reviews_id.'/0')); ?>"><?php echo e(trans('labels.pending')); ?></a>
        </br>
    <?php endif; ?>
    <a class="btn btn-success"
       style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(URL::to('admin/reviews/edit/'.$reviews_id.'/1')); ?>"><?php echo e(trans('labels.Active')); ?></a>
    </br>
    <a class="btn btn-danger"
       style="width: 100%;  margin-bottom: 5px;"
       href="<?php echo e(URL::to('admin/reviews/edit/'.$reviews_id.'/-1')); ?>"><?php echo e(trans('labels.Deactive')); ?></a>
</td>



<?php /**PATH F:\sites\mysan\resources\views/admin/reviews/btn/manage.blade.php ENDPATH**/ ?>