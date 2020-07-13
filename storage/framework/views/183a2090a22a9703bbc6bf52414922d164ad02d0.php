<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.EditCategories')); ?> <small><?php echo e(trans('labels.EditCategories')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/categories/display')); ?>"><i class="fa fa-database"></i> <?php echo e(trans('labels.Categories')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.EditCategories')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.EditCategories')); ?> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                    <?php if(count($errors) > 0): ?>
                                      <?php if($errors->any()): ?>
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <?php echo e($errors->first()); ?>

                                      </div>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/categories/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                        <?php echo Form::hidden('id', $result['editSubCategory'][0]->id , array('class'=>'form-control', 'id'=>'id')); ?>

                                        <?php echo Form::hidden('oldImage', $result['editSubCategory'][0]->image , array('id'=>'oldImage')); ?>

                                        <?php echo Form::hidden('oldIcon', $result['editSubCategory'][0]->icon , array('id'=>'oldIcon')); ?>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Category')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="parent_id">
                                                    <?php echo e(print_r($result['categories'])); ?>

                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ChooseMainCategory')); ?></span>
                                            </div>
                                        </div>

                                        <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="text" name="category_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['name']); ?>">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CategoryName')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.slug')); ?> </label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="hidden" name="old_slug" value="<?php echo e($result['editSubCategory'][0]->slug); ?>">
                                                <input type="text" name="slug" class="form-control field-validate" value="<?php echo e($result['editSubCategory'][0]->slug); ?>">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.slugText')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                <?php if(isset($allimage)): ?>
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Image')); ?></a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                  <br>
                                                  <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UploadSubCategoryImage')); ?></span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OldImage')); ?></span>
                                              <br>
                                              <img src="<?php echo e(asset($result['editSubCategory'][0]->imgpath)); ?>" alt="" width=" 100px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Icon')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                <?php if(isset($allimage)): ?>
                                                                <select class="image-picker show-html " name="image_icone" id="select_img">
                                                                    <option value=""></option>
                                                                    <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Image')); ?></a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                <button type="button" class="btn btn-primary" id="selectedICONE" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                    <?php echo Form::button(trans('labels.Add Icon'), array('id'=>'newIcon','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )); ?>

                                                    <br>
                                                    <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close " id="image-Icone"
                                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UploadSubCategoryIcon')); ?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OldImage')); ?></span>
                                                <br>
                                                <img src="<?php echo e(asset($result['editSubCategory'][0]->iconpath)); ?>" alt="" width=" 100px">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="categories_status">
                                                  <option value="1" <?php if($result['editSubCategory'][0]->categories_status=='1'): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                                  <option value="0" <?php if($result['editSubCategory'][0]->categories_status=='0'): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          <?php echo e(trans('labels.GeneralStatusText')); ?></span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                <a href="<?php echo e(URL::to('admin/categories/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                            </div>
                            <!-- /.box-footer -->

                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.box-body -->

        <!-- /.box -->

        <!-- /.col -->

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>