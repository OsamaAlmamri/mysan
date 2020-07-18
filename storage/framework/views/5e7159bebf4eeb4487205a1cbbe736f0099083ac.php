<td>
    <strong><?php echo e(trans('labels.Product Type')); ?>:</strong>
    <?php if($products_type==0): ?>
        <?php echo e(trans('labels.Simple')); ?>

    <?php elseif($products_type==1): ?>
        <?php echo e(trans('labels.Variable')); ?>

    <?php elseif($products_type==2): ?>
        <?php echo e(trans('labels.External')); ?>

    <?php endif; ?>
    <br>
    <?php if(!empty($manufacturers_name)): ?>
        <strong><?php echo e(trans('labels.Manufacturer')); ?>:</strong> <?php echo e($manufacturers_name); ?><br>
    <?php endif; ?>

    <strong><?php echo e(trans('labels.Price')); ?>: </strong>    <?php echo e($products_price); ?><br>
    <strong><?php echo e(trans('labels.Viewed')); ?>: </strong>  <?php echo e($products_viewed); ?><br>
    <?php if(!empty($specials_id)): ?>
        <strong class="badge bg-light-blue"><?php echo e(trans('labels.Special Product')); ?></strong><br>
        <strong><?php echo e(trans('labels.SpecialPrice')); ?>: </strong>  <?php echo e($specials_products_price); ?><br>

        <?php if(($specials_id) !== null): ?>
            <?php  $mytime = Carbon\Carbon::now()  ?>
            <strong><?php echo e(trans('labels.ExpiryDate')); ?>: </strong>
            <?php if($expires_date > $mytime->toDateTimeString()): ?>
                <?php echo e(date('d-m-Y', $expires_date)); ?>

            <?php else: ?>
                <strong class="badge bg-red"><?php echo e(trans('labels.Expired')); ?></strong>
            <?php endif; ?>
            <br>
        <?php endif; ?>
    <?php endif; ?>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/products/btn/info.blade.php ENDPATH**/ ?>