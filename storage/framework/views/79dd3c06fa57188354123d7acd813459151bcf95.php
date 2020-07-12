<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Update Project')); ?> <small><?php echo e(trans('labels.Update Project')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Update Project')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.Update Project / Bug Fixer')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <?php if(session()->has('message')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session()->has('error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('error')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/managements/updatercontent', 'id' =>'updater-form', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.NOTE')); ?></label>
                                                <p class="col-sm-10 col-md-4">
                                                    <?php echo e(trans('labels.Text of updater and bug zip file')); ?>

                                                    </br>
                                                    <?php echo e(trans('labels.For source code Updator. Please update admin code first then other zip files.')); ?>

                                                    </br>
                                                    <b style="color: red">Please take backup of your code as well as database before performing any update.
                                                    Author would not be responsible for any loss or change in your own code customization.</b>
                                                </p>
                                            </div>

                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Choose Zip')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="file" name="zip_file" id="file" class="form-control field-validate">
                                                    <span class="help-block hidden"><?php echo e(trans('labels.Choose Zip Text')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Purchase Code')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="purchase_code"  class="form-control field-validate">
                                                    <span class="help-block"><?php echo e(trans('labels.Purchase Code Text')); ?></span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="button" class="btn btn-primary" id="password-confirm-btn" ><?php echo e(trans('labels.Submit')); ?></button>
                                                </div>
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

    <div class="modal fade" id="checkpassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p style="text-align:center"><?php echo e(trans('labels.Update source code confirm password text')); ?></p>
                <div class="form-group" id="imageIcone">
                    <label for="name" class="col-sm-3 col-md-4 control-label"><?php echo e(trans('labels.Password')); ?></label>
                    <div class="col-sm-10 col-md-6">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="alert alert-danger" id="passowrd-error" style="display: none">
                    <?php echo e(trans('labels.Please enter your valid passowrd.')); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="check-password"><?php echo e(trans('labels.Confirm')); ?></button>
                </div>
            </div>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/managements/updater.blade.php ENDPATH**/ ?>