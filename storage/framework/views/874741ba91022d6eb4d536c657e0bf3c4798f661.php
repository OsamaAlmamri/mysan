<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Manufacturer')); ?>  <small><?php echo e(trans('labels.EditCurrentManufacturer')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/listingManufacturer')); ?>"><i class="fa fa-industry"></i> <?php echo e(trans('labels.Manufacturer')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditManufacturer')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.EditManufacturerInfo')); ?> </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>

                                        <?php if(session('update')): ?>
                                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> <?php echo e(session('update')); ?> </strong>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(count($errors) > 0): ?>
                                            <?php if($errors->any()): ?>
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <?php echo e($errors->first()); ?>

                                                </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">


                                            <?php echo Form::open(array('url' =>'admin/manufacturers/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('id',  $editManufacturer[0]->id , array('class'=>'form-control', 'id'=>'id')); ?>

                                            <?php echo Form::hidden('oldImage',  $editManufacturer[0]->image , array('id'=>'oldImage')); ?>



                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.slug')); ?> </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="hidden" name="old_slug" value="<?php echo e($editManufacturer[0]->slug); ?>">
                                                    <input type="text" name="slug" class="form-control field-validate" value="<?php echo e($editManufacturer[0]->slug); ?>">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.slugText')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('name',  $editManufacturer[0]->name , array('class'=>'form-control field-validate', 'id'=>'name'), value(old('name'))); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ManufacturerNameExample')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ManufacturerURL')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('manufacturers_url',  $editManufacturer[0]->url , array('class'=>'form-control', 'id'=>'manufacturers_url'), value(old('manufacturers_url'))); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ManufacturerURLText')); ?></span>
                                                </div>
                                            </div>

                                            <!--  -->

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    
                                                    <!-- Modal -->
                                                        <div class="modal fade embed-images" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                                    </div>
                                                                    <div class="modal-body manufacturer-image-embed">
                                                                        <?php if(isset($allimage)): ?>
                                                                            <select class="image-picker show-html " name="image_id" id="select_img">
                                                                                <option  value=""></option>
                                                                                <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option data-img-src="<?php echo e(asset($image->path)); ?>"  class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Icon')); ?></a>
                                                                      <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                      <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div  id ="imageselected">
                                                            <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 3px;"><?php echo e(trans('labels.CompanyLogo')); ?></span>
                                                            <div class="closimage">
                                                                <button type="button" class="close pull-right" id="image-close" style="display: none; position: absolute;left: 91px; top: 54px; background-color: black; color: white; opacity: 2.2;" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div  id="selectedthumbnail"></div>
                                                            <br>
                                                            <?php echo Form::hidden('oldImage', $editManufacturer[0]->image, array('id'=>'oldImage')); ?>

                                                            <?php if(($editManufacturer[0]->path!== null)): ?>
                                                                <img width="80px" src="<?php echo e(asset($editManufacturer[0]->path)); ?>" class="img-circle">
                                                            <?php else: ?>
                                                                <img width="80px" src="<?php echo e(asset($editManufacturer[0]->path)); ?>" class="img-circle">
                                                            <?php endif; ?>

                                                        </div>

                                                </div>

                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/manufacturers/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                            </div>
                                            <!-- /.box-footer -->
                                            <?php echo Form::close(); ?>

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

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/manufacturers/edit.blade.php ENDPATH**/ ?>