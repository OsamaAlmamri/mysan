<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.AddOptions')); ?> <small><?php echo e(trans('labels.AddOptions')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.AddOptions')); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ListingDefaultOptions')); ?> </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#adddefaultattributesmodal">
                                    <?php echo e(trans('labels.AddDefaultOption')); ?>

                                </button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.OptionName')); ?></th>
                                            <th><?php echo e(trans('labels.OptionValue')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="contentDefaultAttribute">

                                        <?php if(count($result['products_attributes']) > 0): ?>
                                            <?php $__currentLoopData = $result['products_attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products_attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($products_attributes->is_default == '1'): ?>
                                                    <tr>
                                                        <td><?php echo e(++$key); ?></td>
                                                        <td><?php echo e($products_attributes->options_name); ?></td>
                                                        <td><?php echo e($products_attributes->options_values_name); ?></td>
                                                    <!--<td><?php echo e($products_attributes->price_prefix); ?><?php echo e($products_attributes->options_values_price); ?></td>-->
                                                        <td>
                                                            <a class="badge bg-light-blue editdefaultattributemodal" products_id = '<?php echo e($products_attributes->products_id); ?>' products_attributes_id = "<?php echo e($products_attributes->products_attributes_id); ?>"  options_id = '<?php echo e($products_attributes->options_id); ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a products_id = '<?php echo e($products_attributes->products_id); ?>' products_attributes_id = "<?php echo e($products_attributes->products_attributes_id); ?>" class="badge bg-red deletedefaultattributemodal"><i class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><strong>
                                                        <?php echo e(trans('labels.NoRecordFoundTextForDefaultOption')); ?></strong>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- adddefaultattributesmodal -->
                                    <div class="modal fade" id="adddefaultattributesmodal" tabindex="-1" role="dialog" aria-labelledby="addAttributeModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="addAttributeModalLabel"><?php echo e(trans('labels.AddOptions')); ?></h4>
                                                </div>
                                                <?php echo Form::open(array('url' =>'admin/products/attach/attribute/default', 'name'=>'addattributefrom', 'id'=>'adddefaultattributefrom', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                                <?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>

                                                <?php echo Form::hidden('subcategory_id',  $result['subcategory_id'], array('class'=>'form-control', 'id'=>'subcategory_id')); ?>

                                                <?php echo Form::hidden('is_default',  '1', array('class'=>'form-control', 'id'=>'is_default')); ?>


                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label">
                                                            <?php echo e(trans('labels.OptionName')); ?>

                                                        </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control default-option-id field-validate" name="products_options_id">
                                                                <option value="" class="field-validate"><?php echo e(trans('labels.ChooseOptions')); ?></option>
                                                                <?php $__currentLoopData = $result['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option->products_options_id); ?>"><?php echo e($option->options_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            	<?php echo e(trans('labels.AddOptionNameText')); ?>

                                 </span>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.OptionValues')); ?></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control products_options_values_id field-validate" name="products_options_values_id">	</select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  <?php echo e(trans('labels.AddOptionValueText')); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-danger addDefaultError" style="display: none; margin-bottom: 0;" role="alert"><i class="icon fa fa-ban"></i><span></span> </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                                                    <button type="button" class="btn btn-primary" id="addDefaultAttribute"><?php echo e(trans('labels.AddOption')); ?></button>
                                                </div>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- editdefaultattributemodal -->
                                    <div class="modal fade" id="editdefaultattributemodal" tabindex="-1" role="dialog" aria-labelledby="editdefaultattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content editDefaultContent">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- deletedefaultattributemodal -->
                                    <div class="modal fade" id="deletedefaultattributemodal" tabindex="-1" role="dialog" aria-labelledby="deletedefaultattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content deleteDefaultEmbed">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ListingAdditionalProductsOptions')); ?> </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#addAttributeModal">
                                    <?php echo e(trans('labels.AddAdditionalOption')); ?></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.OptionName')); ?></th>
                                            <th><?php echo e(trans('labels.OptionValue')); ?></th>
                                            <th><?php echo e(trans('labels.Price')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>

                                        </tr>
                                        </thead>
                                        <tbody class="contentAttribute">

                                        <?php if(count($result['products_attributes']) > 0): ?>
                                            <?php $__currentLoopData = $result['products_attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products_attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($products_attributes->is_default == '0'): ?>
                                                    <tr>
                                                        <td><?php echo e(++$key); ?></td>
                                                        <td><?php echo e($products_attributes->options_name); ?></td>
                                                        <td><?php echo e($products_attributes->options_values_name); ?></td>
                                                        <td><?php echo e($products_attributes->price_prefix); ?><?php echo e($products_attributes->options_values_price); ?></td>
                                                        <td>
                                                            <a class="badge bg-light-blue editproductattributemodal" products_id = '<?php echo e($products_attributes->products_id); ?>' products_attributes_id = "<?php echo e($products_attributes->products_attributes_id); ?>" options_id = '<?php echo e($products_attributes->options_id); ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a products_id = '<?php echo e($products_attributes->products_id); ?>' products_attributes_id = "<?php echo e($products_attributes->products_attributes_id); ?>" class="badge bg-red deleteproductattributemodal"><i class="fa fa-trash " aria-hidden="true"></i></a></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5">
                                                    <?php echo e(trans('labels.NoRecordFoundTextForAdditionalOption')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>


                                        </tbody>
                                    </table>

                                    <!-- addAttributeModal -->
                                    <div class="modal fade" id="addAttributeModal" tabindex="-1" role="dialog" aria-labelledby="addAttributeModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="addAttributeModalLabel"><?php echo e(trans('labels.AddOptions')); ?></h4>
                                                </div>
                                                <?php echo Form::open(array('url' =>'admin/products/attach/attribute/default/options/add', 'name'=>'addattributefrom', 'id'=>'addattributefrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                                                <?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>


                                                <?php echo Form::hidden('subcategory_id',  $result['subcategory_id'], array('class'=>'form-control', 'id'=>'subcategory_id')); ?>

                                                <?php echo Form::hidden('is_default',  '0', array('class'=>'form-control', 'id'=>'is_default')); ?>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.OptionName')); ?>  </label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control  additional-option-id field-validate" name="products_options_id">										 									  <option value="" class="field-validate"><?php echo e(trans('labels.ChooseOptions')); ?></option>
                                                                <?php $__currentLoopData = $result['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($option->products_options_id); ?>"><?php echo e($option->options_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
								  <?php echo e(trans('labels.OptionNameText')); ?>

								  </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.OptionValues')); ?></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control additional_products_options_values_id field-validate" name="products_options_values_id">
                                                            </select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  <?php echo e(trans('labels.OptionValuesText')); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-xs-12 col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Price')); ?></label>
                                                        <div class="col-xs-4 col-sm-2">
                                                            <select class="form-control" name="price_prefix" id="price_prefix">
                                                                <option value="+">+</option>
                                                                <option value="-">-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-8 col-sm-8 col-md-6">
                                                            <?php echo Form::text('options_values_price',  '0', array('class'=>'form-control', 'id'=>'options_values_price')); ?>

                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NumericValueError')); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-danger addError" style="display: none; margin-bottom: 0;" role="alert">Already Exist<i class="icon fa fa-ban"></i><span></span> </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                                                    <button type="button" class="btn btn-primary" id="addAttribute"><?php echo e(trans('labels.AddOption')); ?></button>
                                                </div>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- editproductattributemodal -->
                                    <div class="modal fade" id="editproductattributemodal" tabindex="-1" role="dialog" aria-labelledby="editproductattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content editContent">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- deleteproductattributemodal -->
                                    <div class="modal fade" id="deleteproductattributemodal" tabindex="-1" role="dialog" aria-labelledby="deleteproductattributemodalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content deleteEmbed">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="<?php echo e(URL::to("admin/products/display")); ?>" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> <?php echo e(trans('labels.back')); ?> </a>
                                <a href="<?php echo e(URL::to("admin/products/images/display/{$result['data']['products_id']}")); ?>" class="btn btn-primary pull-right"> <?php echo e(trans('labels.Save_And_Continue')); ?> <i class="fa fa-angle-right"></i></a>
                            </div>

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->



            <!-- Main row -->
    </div>

    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/products/attribute/add.blade.php ENDPATH**/ ?>