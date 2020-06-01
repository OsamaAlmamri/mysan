<?php if($result['products'][0]->products_type == '1'): ?>
<div class="form-group">
    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.products_attributes')); ?></label>
    <div class="col-sm-10 col-md-8">
        <?php if(count($result['attributes'])==0 ): ?>
        <input type='hidden' id='has-attribute' value='0'>
            <div class="alert alert-danger" role="alert">
              <?php echo e(trans('labels.You can not add stock without attribute for variable product')); ?>

            </div>
        <?php else: ?>
        <input type='hidden' id='has-attribute' value='1'>
        <ul class="list-group list-group-root well list-group-root2">
            <?php $__currentLoopData = $result['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li href="#" class="list-group-item"><label style="width:100%">
                    <input id="attribute_id" type="hidden" class="attributeid_<?=$attribute['option']['id']?>" name="attributeid[]" value=""> <?php echo e($attribute['option']['name']); ?></label></li>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input name="values_<?=$attribute['option']['id']?>" type="radio" class="currentstock required_one" value="<?php echo e($value['products_attributes_id']); ?>"
                          attributeid="<?php echo e($attribute['option']['id']); ?>"> <?php echo e($value['value']); ?></label> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
            </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
            <?php echo e(trans('labels.Select Option values Text')); ?>.</span>
        <span class="help-block hidden"><?php echo e(trans('labels.Select Option values Text')); ?></span>
    </div>
</div>

<?php elseif($result['products'][0]->products_type == '0'): ?>
<div class="form-group">
    <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.products_attributes')); ?></label>
    <div class="col-sm-10 col-md-8">
    <input type='hidden' id='has-attribute' value='1'>
        <input type='hidden' id='has-attribute' value='0'>
            <div class="alert alert-info" role="alert">
              <?php echo e(trans('labels.Now you can add stock for simple product')); ?>

            </div>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
            <?php echo e(trans('labels.Select Option values Text')); ?>.</span>
        <span class="help-block hidden"><?php echo e(trans('labels.Select Option values Text')); ?></span>
    </div>
</div>
<?php endif; ?>


<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products/inventory/attribute_div.blade.php ENDPATH**/ ?>