<div class="row">
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon"><?php echo e(trans('labels.Categories')); ?></span>
            <?php echo Form ::select('main_categories',[],'',['class' => 'select2 form-control', 'id' => 'main_categories']); ?>

        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon"><?php echo e(trans('labels.Categories')); ?></span>
            <?php echo Form ::select('subCategories',[],'',['class' => 'select2 form-control', 'id' => 'subCategories']); ?>

        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group">
            <span class="input-group-addon"><?php echo e(trans('labels.products')); ?></span>
            <?php echo Form ::select('products_list',  [],'',['class' => 'select2 form-control', 'id' => 'products_list']); ?>

        </div>
    </div>
</div>
<br>
<div class="row">
    <div class=" col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon"><?php echo e(trans('labels.fromDate')); ?></span>
            <input type="date" class="form-control" name="start" value="<?php echo e(isset($start)?$start:''); ?>"
                   id="from_date">
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon"><?php echo e(trans('labels.toDate')); ?></span>
            <input type="date" class="form-control" name="end" value="<?php echo e(isset($end)?$end:''); ?>" required
                   id="to_date">
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <button type="button" name="filter" id="filter"
                    class="btn btn-primary btn-ms waves-effect waves-light"><?php echo e(trans('labels.filter')); ?> <i
                    class="fa fa-filter"></i></button>
        </div>
    </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views/admin/common/filters/catetegories_products_date.blade.php ENDPATH**/ ?>