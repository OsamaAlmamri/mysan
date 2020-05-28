<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.AddNewsCategory')); ?> <small><?php echo e(trans('labels.AddNewsCategory')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/newscategories/display')); ?>"><i class="fa fa-database"></i> <?php echo e(trans('labels.NewsCategories')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.AddNewsCategory')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.AddNewsCategory')); ?> </h3>
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

                        <!-- form start -->
                         <div class="box-body">

                            <?php echo Form::open(array('url' =>'admin/newscategories/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                              <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?> (<?php echo e($languages->name); ?>)</label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="categoryName_<?=$languages->languages_id?>" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NewsCategoryName')); ?> (<?php echo e($languages->name); ?>)</span>

                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <div class="form-group" id="imageIcone">
                                   <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                   <div class="col-sm-10 col-md-4">
                                       <!-- Modal -->
                                       <div class="modal fade embed-images" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                       <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="imageselected">
                                         <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )); ?>

                                         <br>
                                         <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                         <div class="closimage">
                                             <button type="button" class="close pull-left image-close " id="image-Icone"
                                               style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                       </div>
                                       <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ImageText')); ?></span>

                                       <br>
                                   </div>
                               </div>
                               
                               <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                <div class="col-sm-10 col-md-4">
                                  <select class="form-control" name="categories_status">
                                        <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                        <option value="0"><?php echo e(trans('labels.Inactive')); ?></option>
                                  </select>
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                <?php echo e(trans('labels.GeneralStatusText')); ?></span>
                                </div>
                               </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                <a href="<?php echo e(URL::to('admin/newscategories/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/newscategories/add.blade.php ENDPATH**/ ?>