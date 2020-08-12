<p> <?php echo e(trans('labels.count_rating')); ?> :
    <?php if($count_rating==0): ?>
    <?php echo e(round($count_rating)); ?>

    <?php else: ?>
        <a href="<?php echo e(route('reviews.display',$products_id)); ?>">
            <?php echo e(round($count_rating)); ?></a>
    <?php endif; ?>
</p>
<div class="ratingDiv">
<?php for($i=1;$i<6;$i++): ?>
        <span class="fa fa-star <?php if(round($avg_rating)>=$i): ?> checked <?php endif; ?> "></span>
    <?php endfor; ?>
</div>
<p> <?php echo e(trans('labels.avg_rating')); ?> : <?php echo e(round($avg_rating)); ?> </p>


<?php /**PATH F:\sites\mysan\resources\views/admin/products/btn/rating.blade.php ENDPATH**/ ?>