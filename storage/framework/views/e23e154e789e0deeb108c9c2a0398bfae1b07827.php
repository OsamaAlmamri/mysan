<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Home Banners')); ?> <small><?php echo e(trans('labels.Listing The Home Banners')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Banners')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		  <?php if(count($errors) > 0): ?>
                          <?php if($errors->any()): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e($errors->first()); ?>

                            </div>
                          <?php endif; ?>
                      <?php endif; ?>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">

                    <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php if($key==0): ?> active <?php endif; ?>"><a href="#banners_<?=$languages->languages_id?>" data-toggle="tab"><?=$languages->name?><span style="color:red;">*</span></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </ul>
                  <?php echo Form::open(array('url' =>'admin/homebanners/insert', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                    <div class="tab-content">
                    <?php 
                    $i =0;
                    ?>
                      <?php $__currentLoopData = $result['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banners_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                 
                      
                      <div style="margin-top: 15px;" class="tab-pane <?php if($i==0): ?> active <?php endif; ?>" id="banners_<?=$key?>">
                        <?php $__currentLoopData = $banners_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="">     
                          
                          <div class="row">
                            <div class="col-xs-12">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Banner')); ?> </label>
                                <div class="col-sm-10 col-md-4">

                                    <!-- Modal -->
                                    <div class="modal fade" id="new-image-<?=$banner['language_id']?>-<?=$banner['banner_name']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h3 class="modal-title text-primary" id="myModalLabel"><?php echo app('translator')->get('website.Choose Image'); ?> </h3>
                                                </div>

                                                <div class="modal-body manufacturer-image-embed">
                                                    <?php if(isset($allimage)): ?>
                                                    <select class=" show-html " name="image_id_<?=$banner['language_id']?>_<?=$banner['banner_name']?>">
                                                        <option value=""></option>
                                                        <?php if($banner['image'] !=''): ?>
                                                        
                                                        <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>" <?php if($image->id == $banner['image']): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($image->id); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        <?php else: ?>
                                                        
                                                        <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php endif; ?>
                                                    </select>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left"><?php echo e(trans('labels.Add Banner')); ?></a>
                                                    <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                    <button type="button" class="btn btn-primary selected-image" imageselected="imageselected_<?=$banner['language_id']?>_<?=$banner['banner_name']?>" attribute="selected_<?=$banner['language_id']?>_<?=$banner['banner_name']?>" data-dismiss="modal"><?php echo app('translator')->get('labels.Done'); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="imageselected_<?=$banner['language_id']?>_<?=$banner['banner_name']?>" >
                                      <?php if($banner['image'] !=''): ?>
                                       <button type="button" class="btn btn-primary bannerBtn" data-toggle="modal" data-target="#new-image-<?=$banner['language_id']?>-<?=$banner['banner_name']?>">
                                        <?php echo app('translator')->get('labels.Choose Banner'); ?>
                                        </button>
                                      <?php else: ?>
                                      <button type="button" class="btn btn-primary field-validate bannerBtn" data-toggle="modal" data-target="#new-image-<?=$banner['language_id']?>-<?=$banner['banner_name']?>">
                                        <?php echo app('translator')->get('labels.Choose Banner'); ?>
                                        </button>
                                      <?php endif; ?>
                                        <br>
                                        <div id="selected_<?=$banner['language_id']?>_<?=$banner['banner_name']?>" class="selectedthumbnail col-md-5" style="display: none"> </div>
                                        <div class="closimage">
                                            <button type="button" class="close pull-left image-close " 
                                              style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Choose Banner')); ?></span>
                                </div>
                            </div>

                            <?php if(!empty($banner['path'])): ?>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                <div class="col-sm-10 col-md-4">
                                    <img src="<?php echo e(asset($banner['path'])); ?>" alt="" width=" 100px">
                                </div>
                            </div>
                            <?php endif; ?>
                           </div>
                          </div>

                        <div class="row">
                          <div class="col-xs-12">
                            <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Text')); ?> </label>
                              <div class="col-sm-10 col-md-8">
                                  <textarea name="text_<?=$banner['language_id']?>_<?=$banner['banner_name']?>" class="form-control"
                                    rows="5"><?php echo e(stripslashes($banner['text'])); ?></textarea>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.Enter Detail')); ?></span> 
                              </div>
                            </div>
                          </div>
                        </div>

                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                      <?php 
                        $i++;
                      ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <!-- /.tab-pane -->
                    </div>
                    <div class="box-footer text-center">
                      <button type="submit" class="btn btn-primary pull-right" id="normal-btn"><?php echo e(trans('labels.Submit')); ?></button>
                  </div>
                  </form>
                  <!-- /.tab-content -->
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
<script src="<?php echo asset('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<script>
  $(document).on('click','.selected-image', function(){
    var image_src = $('.thumbnail.selected').children('img').attr('src');
    var attribute = $(this).attr('attribute');
    var imageselected = $(this).attr('imageselected');    
    $('#'+attribute).html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
    $('#'+attribute).show();   
    $('.image-close').show();
    $('#'+imageselected).removeClass('has-error');
    $('#'+imageselected).children('.bannerBtn').removeClass('field-validate');
    $('.thumbnail.selected').removeClass('selected');
});
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/settings/web/homebanners/index.blade.php ENDPATH**/ ?>