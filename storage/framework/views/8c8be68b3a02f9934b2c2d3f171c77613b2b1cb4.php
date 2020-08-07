<td>
    <strong><?php echo e(trans('labels.Phone')); ?>: </strong> <?php echo e($phone); ?> <br>
    <strong><?php echo e(trans('labels.Devices')); ?>: </strong>
    <?php if(count($devices)>0): ?>
        <a href="javaScript:avoid(0)" id="notification-popup" customers_id="<?php echo e($id); ?>">
            <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $devices_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span>
                                                        <?php if($devices_data->device_type == 1): ?>
                        <?php echo e(trans('labels.IOS')); ?>

                    <?php elseif($devices_data->device_type == 2): ?>
                        <?php echo e(trans('labels.Android')); ?>

                    <?php elseif($devices_data->device_type == 3): ?>
                        <?php echo e(trans('labels.Website')); ?>

                    <?php endif; ?>
                                                    </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </a>
    <?php endif; ?>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/customers/btn/info.blade.php ENDPATH**/ ?>