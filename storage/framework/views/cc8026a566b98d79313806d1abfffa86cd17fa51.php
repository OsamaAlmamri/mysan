
            <?php if(isset($allimage)): ?>
            <!-- <select class="image-picker show-html " name="image_id" id="select_img"> -->
                <option value=""></option>
                <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- </select> -->
            <?php endif; ?>
<?php /**PATH F:\sites\mysan\resources\views\admin\media\loadimages.blade.php ENDPATH**/ ?>