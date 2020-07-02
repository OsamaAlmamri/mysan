<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.EditMenu')); ?> <small><?php echo e(trans('labels.EditMenu')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/menus')); ?>"><i class="fa fa-gears"></i> <?php echo e(trans('labels.ListingAllMenu')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditMenu')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.EditMenu')); ?> </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                    <!--<div class="box-header with-border">
                          <h3 class="box-title"><?php echo e(trans('labels.EditPage')); ?></h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <?php if( count($errors) > 0): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                                        <?php echo e($error); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php echo Form::open(array('url' =>'admin/updatemenu', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                            <?php echo Form::hidden('id',  $result['menus'][0]->id, array('class'=>'form-control', 'id'=>'id')); ?>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Menu')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="parent_id" >
                                                      <option value="0"><?php echo e(trans('labels.Leave as Parent')); ?></option>
                                                      <?php $__currentLoopData = $result['allmenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($result['menus'][0]->parent_id == $menu->id): ?> selected <?php endif; ?> value="<?php echo e($menu->id); ?>"><?php echo e($menu->name); ?></option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        <?php echo e(trans('labels.ChooseMainMenu')); ?></span>
                                                </div>
                                            </div>
                                            <?php
                                            if($result['menus'][0]->sort_order == null){
                                              $val = $result['menus'][0]->sub_sort_order;
                                            }
                                            else{
                                              $val = $result['menus'][0]->sort_order;
                                            }
                                             ?>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Sort_Order')); ?><span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input required type="number" value="<?php echo e($val); ?>" name="sort_order" class="form-control menu">
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?> (<?php echo e($description_data['language_name']); ?>) </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="menuName_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['name']); ?>" >
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Name')); ?> (<?php echo e($description_data['language_name']); ?>)</span>

                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Type')); ?> </label>
                                              <div class="col-sm-10 col-md-4">
                                                <select required id="select_id" onchange="showPageSelect()" class="form-control" name="type">
                                                      <option><?php echo e(trans('labels.Select Type')); ?></option>
                                                      <option <?php if($result['menus'][0]->type == 0): ?> selected <?php endif; ?> value="0"><?php echo e(trans('labels.External Link')); ?></option>
                                                      <option <?php if($result['menus'][0]->type == 1): ?> selected <?php endif; ?> value="1"><?php echo e(trans('labels.Link')); ?></option>
                                                      <option <?php if($result['menus'][0]->type == 2): ?> selected <?php endif; ?> value="2"><?php echo e(trans('labels.Page')); ?></option>
                                                </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                              <?php echo e(trans('labels.GeneralStatusText')); ?></span>
                                              </div>
                                            </div>
                                            <div class="form-group external_link <?php if($result['menus'][0]->type != 0): ?> hidden <?php endif; ?>">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.External_Link')); ?><span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input value="<?php echo e($result['menus'][0]->external_link); ?>" name="external_link" class="form-control menu">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group link <?php if($result['menus'][0]->type != 1): ?> hidden <?php endif; ?>">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Link')); ?><span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input value="<?php echo e($result['menus'][0]->link); ?>" name="link" class="form-control menu">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group page <?php if($result['menus'][0]->type != 2): ?> hidden <?php endif; ?>">
                                              <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Page')); ?> </label>
                                              <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="page_id">
                                                  <?php $__currentLoopData = $result['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <option <?php if($result['menus'][0]->page_id == $page->page_id): ?> selected <?php endif; ?> value="<?php echo e($page->page_id); ?>"><?php echo e($page->name); ?></option>
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
                                                     jQuery('.page').addClass("hidden");
                                                   }
                                                   else if(d == 2) {
                                                     jQuery('.external_link').addClass("hidden");
                                                     jQuery('.link').addClass("hidden");
                                                     jQuery('.page').removeClass("hidden");
                                                   }
                                              }
                                            </script>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1"  <?php if($result['menus'][0]->status=='1'): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                                        <option value="0"  <?php if($result['menus'][0]->status=='0'): ?> selected <?php endif; ?>><?php echo e(trans('labels.InActive')); ?></option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.StatusPageText')); ?></span>
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
    <script src="<?php echo asset('plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
    <script type="text/javascript">
        $(function () {

            //for multiple languages
            <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor_<?php echo e($languages->languages_id); ?>');

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\menus\edit.blade.php ENDPATH**/ ?>