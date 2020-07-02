<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Menus')); ?> <small><?php echo e(trans('labels.AddMenus')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/menus')); ?>"><i class="fa fa-database"></i><?php echo e(trans('labels.Menus')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.AddMenus')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.AddMenus')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <br>
                                    <?php if(count($errors) > 0): ?>
                                    <?php if($errors->any()): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e($errors->first()); ?>

                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/addnewmenu', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Menu')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="parent_id">
                                                  <option value="0"> <?php echo e(trans('labels.Leave as Parent')); ?></option>
                                                  <?php $__currentLoopData = $result['menus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menu->id); ?>"><?php echo e($menu->name); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.ChooseMainMenu')); ?></span>
                                            </div>
                                        </div>

                                        <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?><span style="color:red;">*</span> (<?php echo e($languages->name); ?>)</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input required name="menuName_<?=$languages->languages_id?>" class="form-control menu">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.SubMenuName')); ?> (<?php echo e($languages->name); ?>).</span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Type')); ?> </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select required id="select_id" onchange="showPageSelect()" class="form-control" name="type">
                                                  <option><?php echo e(trans('labels.Select Type')); ?></option>
                                                  <option value="0"><?php echo e(trans('labels.External Link')); ?></option>
                                                  <option value="1"><?php echo e(trans('labels.Link')); ?></option>
                                                  <option value="2"><?php echo e(trans('labels.Page')); ?></option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          <?php echo e(trans('labels.GeneralStatusText')); ?></span>
                                          </div>
                                        </div>
                                        <div class="form-group external_link hidden">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.External_Link')); ?><span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input name="external_link" class="form-control menu">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.SubMenuName')); ?> (<?php echo e($languages->name); ?>).</span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group link hidden">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Link')); ?><span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input name="link" class="form-control menu">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.SubMenuName')); ?> (<?php echo e($languages->name); ?>).</span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group page hidden">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Page')); ?> </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="page_id">
                                              <option value="">Select Page</option>
                                              <?php $__currentLoopData = $result['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($page->page_id); ?>"><?php echo e($page->name); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          <?php echo e(trans('labels.GeneralStatusText')); ?></span>
                                          </div>
                                        </div>
                                        <script>
                                          function showPageSelect(){
                                               var d = document.getElementById("select_id").value;
                                               if(d == 0){
                                                 jQuery('.external_link').removeClass("hidden");
                                                 jQuery('.link').addClass("hidden");
                                                 jQuery('.page').addClass("hidden");
                                               }
                                               else if(d == 1) {
                                                 jQuery('.external_link').addClass("hidden");
                                                 jQuery('.link').removeClass("hidden");
                                                 jQuery('.page').addClass("hidden");                                               }
                                               else if(d == 2) {
                                                 jQuery('.external_link').addClass("hidden");
                                                 jQuery('.link').addClass("hidden");
                                                 jQuery('.page').removeClass("hidden");                                               }
                                          }
                                        </script>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="status">
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
                                            <a href="<?php echo e(URL::to('admin/menus')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\menus\add.blade.php ENDPATH**/ ?>