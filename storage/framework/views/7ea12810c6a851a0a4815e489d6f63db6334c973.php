<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.SendNotification')); ?> <small><?php echo e(trans('labels.SendNotification')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.SendNotification')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.SendNotification')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-info alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>

                                        <?php if(count($result['message'])>0): ?>
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($result['message']); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/devices/sendNotifications', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Devices')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="device_type" id="device_type">
                                                        <?php if($web_setting[66]->value=='1' and $web_setting[67]->value=='1' or $web_setting[66]->value=='1' and $web_setting[67]->value=='0'): ?>
                                                            <option value="all"><?php echo e(trans('labels.All')); ?></option>
                                                        <?php endif; ?>
                                                        <?php if($web_setting[66]->value=='1'): ?>
                                                            <option value="1"><?php echo e(trans('labels.IOS')); ?> </option>
                                                            <option value="2"><?php echo e(trans('labels.Android')); ?></option>
                                                        <?php endif; ?>
                                                        <?php if($web_setting[67]->value=='1'): ?>
                                                            <option value="3"><?php echo e(trans('labels.Website')); ?></option>
                                                        <?php endif; ?>

                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> <?php echo e(trans('labels.SelectDeviceText')); ?></span>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="devices_status" id="">
                                                        <option value="1"><?php echo e(trans('labels.Active_Device')); ?></option>
                                                        <option value="0"><?php echo e(trans('labels.Inactive_Device')); ?></option>
                                                    </select>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.SelectDeviceStatusText')); ?></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Title')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('title',  '', array('class'=>'form-control field-validate', 'id'=>'title')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.TitleText')); ?></span>

                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                                <div class="col-sm-10 col-md-4 float-left">
                                                    

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                    <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
                                                                    <button type="button" id="AddImage" class="btn btn-primary pull-right" >Add Image</button>
                                                                </div>


                                                                <div class="modal-body manufacturer-image-embed">

                                                                    <?php if(isset($allimage)): ?>



                                                                        <select class="image-picker show-html field-validate" name="image_id" id="select_img">

                                                                            <option  value=""></option>

                                                                            <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option data-img-src="<?php echo e(asset($image->path)); ?>"  class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->path); ?>"> <?php echo e($image->path); ?> </option>

                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>


                                                                    <?php endif; ?>


                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>




                                                    <?php echo Form::button('Add Image', array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>


                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.notificationImageText')); ?></span>

                                                        <br>

                                                    <div  id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close"  id="image-close" style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2;" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>





                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Message')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::textarea('message',  '', array('class'=>'form-control field-validate', 'id'=>'message')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.SendNotificationDetailext')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Send')); ?> </button>
                                                <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/Notifications/notifications.blade.php ENDPATH**/ ?>