<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="editManufacturerLabel"><?php echo e(trans('labels.EditOptions')); ?></h4>
</div>
  <?php echo Form::open(array('url' =>'admin/addNewProductAttribute', 'name'=>'editAttributeFrom', 'id'=>'editAttributeFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

		  <?php echo Form::hidden('products_attributes_id',  $result['data']['products_attributes_id'], array('class'=>'form-control', 'id'=>'products_attributes_id')); ?>

		  <?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>

          <?php echo Form::hidden('language_id',  $result['data']['language_id'], array('class'=>'form-control', 'id'=>'language_id')); ?>

<div class="modal-body">

		<div class="form-group">
              <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Language')); ?> </label>
              <div class="col-sm-10 col-md-8">
                  <select class="form-control edit_additional_language_id" name="languages_id">		
                    <option value="" class="field-validate">Choose Language</option>								 
                     <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($languages->languages_id); ?>"
                      <?php if($result['data']['language_id'] == $languages->languages_id): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($languages->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>										 
                  </select>
                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Chooselagnuage')); ?></span>
             
              </div>
          </div>
          
          
  <div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.OptionName')); ?>

      </label>
	  <div class="col-sm-10 col-md-8">
		   <select class="form-control edit-additional-option-id field-validate" name="products_options_id">											 
			 <?php $__currentLoopData = $result['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <option
              <?php if($result['products_attributes'][0]->options_id == $options->products_options_id): ?>
              	selected
              <?php endif; ?>
               option = "<?php echo e($result['products_attributes'][0]->options_id); ?>" value="<?php echo e($options->products_options_id); ?>"><?php echo e($options->products_options_name); ?></option>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>										 
		  </select>
      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OptionNameText')); ?></span>
	  </div>
	</div>

   <div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.OptionValues')); ?></label>
	  <div class="col-sm-10 col-md-8">
		  <select class="form-control edit-additional-products_options_values_id field-validate" name="products_options_values_id">	
			 <?php $__currentLoopData = $result['options_value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <option
              <?php if($result['products_attributes'][0]->options_values_id == $options_value->products_options_values_id): ?>
              	selected
              <?php endif; ?>
               option = "<?php echo e($result['products_attributes'][0]->options_values_id); ?>" value="<?php echo e($options_value->products_options_values_id); ?>"><?php echo e($options_value->products_options_values_name); ?></option>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>										 
		 </select>
         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OptionValuesText')); ?></span>
	  </div>
	</div>

	<div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.PricePrefix')); ?></label>
	  <div class="col-sm-10 col-md-8">
		 <?php echo Form::text('price_prefix',  $result['products_attributes'][0]->price_prefix , array('class'=>'form-control', 'id'=>'price_prefix')); ?>

         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.PricePrefixText')); ?></span>
							 
	  </div>
	</div>

	<div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Price')); ?></label>
	  <div class="col-sm-10 col-md-8">
		 <?php echo Form::text('options_values_price',  $result['products_attributes'][0]->options_values_price, array('class'=>'form-control', 'id'=>'options_values_price')); ?>

         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NumericValueError')); ?></span>
	  </div>
	</div>
	<div class="alert alert-danger addError" style="display: none; margin-bottom: 0;" role="alert"><i class="icon fa fa-ban"></i><?php echo e(trans('labels.OpitonExistText')); ?> </div>
    
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
	<button type="button" class="btn btn-primary" id="updateProductAttribute"><?php echo e(trans('labels.UpdateOption')); ?></button>
</div>
  <?php echo Form::close(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products/pop_up_forms/editproductattributeoptionform.blade.php ENDPATH**/ ?>