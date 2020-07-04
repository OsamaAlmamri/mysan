<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="editManufacturerLabel"><?php echo e(trans('labels.EditAddress')); ?></h4>
</div>

<?php echo Form::open(array('url' =>'admin/customers/updateAddress', 'name'=>'editAddressFrom', 'id'=>'editAddressFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

<?php echo Form::hidden('user_id', $data['user_id'], array('class'=>'form-control')); ?>

<?php echo Form::hidden('address_book_id', $data['customer_addresses'][0]->address_book_id, array('class'=>'form-control')); ?>

<div class="modal-body">
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Company')); ?></label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('entry_company', $data['customer_addresses'][0]->entry_company, array('class'=>'form-control field-validate', 'id'=>'entry_company')); ?>

        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.FirstName')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('name', $data['customer_addresses'][0]->name, array('class'=>'form-control field-validate', 'id'=>'entry_firstname')); ?>

        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.StreetAddress')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('entry_street_address', $data['customer_addresses'][0]->entry_street_address, array('class'=>'form-control field-validate', 'id'=>'entry_street_address')); ?>

        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Suburb')); ?></label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('entry_suburb', $data['customer_addresses'][0]->entry_suburb, array('class'=>'form-control field-validate', 'id'=>'entry_suburb')); ?>

        </div>
    </div>


    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.City')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('entry_city', $data['customer_addresses'][0]->entry_city, array('class'=>'form-control field-validate', 'id'=>'entry_city')); ?>

        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Country')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <select id="entry_country_id" class="form-control" name="entry_country_id">
                <?php $__currentLoopData = $data['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($data['customer_addresses'][0]->entry_country_id == $countries_data->countries_id ): ?>
                    selected
                    <?php endif; ?>
                    value="<?php echo e($countries_data->countries_id); ?>"><?php echo e($countries_data->countries_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group selectstate" <?php if(!is_numeric($data['customer_addresses'][0]->entry_state)): ?> style="display: none" <?php endif; ?>>
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.State')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <select class="form-control zoneContent" name="entry_state_box">
                <?php $__currentLoopData = $data['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($data['customer_addresses'][0]->entry_zone_id == $zones_data->zone_id ): ?>
                    selected
                    <?php endif; ?>
                    value="<?php echo e($zones_data->zone_id); ?>"><?php echo e($zones_data->zone_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group otherstate" <?php if(is_numeric($data['customer_addresses'][0]->entry_state)): ?> style="display: none" <?php endif; ?>>
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.State')); ?>*</label>
        <div class="col-sm-10 col-md-8">
            <?php echo Form::text('entry_state', $data['customer_addresses'][0]->entry_state, array('class'=>'form-control entry_state', 'id'=>'entry_state')); ?>

        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.DefaultShippingAddress')); ?></label>
        <div class="col-sm-10 col-md-8">
            <select id="is_default" class="form-control" name="is_default">
                <option <?php if($data['customers'][0]->is_default == 0 ): ?>
                    selected
                    <?php endif; ?>
                    value="0">No</option>
                <option <?php if($data['customers'][0]->is_default == 1 ): ?>
                    selected
                    <?php endif; ?>
                    value="1">Yes</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
    <button type="button" class="btn btn-primary form-validate" id="updateAddress"><?php echo e(trans('labels.Submit')); ?></button>
</div>
<?php echo Form::close(); ?>

<?php /**PATH F:\sites\mysan\resources\views/admin/customers/address/editaddress.blade.php ENDPATH**/ ?>