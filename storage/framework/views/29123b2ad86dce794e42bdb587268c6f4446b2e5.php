<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.AddCustomer')); ?> <small><?php echo e(trans('labels.AddNEWCustomer')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/customers/display')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.ListingAllCustomers')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.AddCustomer')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.AddCustomer')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit category</h3>
                                        </div>-->
                                    <!-- /.box-header -->
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

                                    <div class="box-body">
                                        <?php echo Form::open(array('url' =>'admin/customers/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.FirstName')); ?> </label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('customers_firstname',  '', array('class'=>'form-control field-validate', 'id'=>'customers_firstname')); ?>

                                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.FirstNameText')); ?></span>
                                                                            <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.LastName')); ?> </label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('customers_lastname',  '', array('class'=>'form-control field-validate', 'id'=>'customers_lastname')); ?>

                                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.lastNameText')); ?></span>
                                                                            <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Gender')); ?></label>
                                                                               <div class="col-sm-10 col-md-4">
                                                                                    <label>
                                                                                      <input type="radio" name="customers_gender" value="1" class="minimal" checked> <?php echo e(trans('labels.Male')); ?>

                                                                                    </label><br>

                                                                                    <label>
                                                                                      <input type="radio" name="customers_gender" value="0" class="minimal"> <?php echo e(trans('labels.Female')); ?>

                                                                                    </label>

                                                                               </div>
                                                                          </div>
                                                                          
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.DOB')); ?> </label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('customers_dob',  '', array('class'=>'form-control datepicker' , 'readonly'=>'readonly', 'id'=>'customers_dob')); ?>

                                                                         	 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                         	 <?php echo e(trans('labels.DOBText')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Telephone')); ?></label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('customers_telephone',  '', array('class'=>'form-control', 'id'=>'customers_telephone')); ?>

                                                                           <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                           <?php echo e(trans('labels.TelephoneText')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <!-- <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Fax')); ?></label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('customers_fax',  '', array('class'=>'form-control', 'id'=>'customers_fax')); ?>

                                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.FaxText')); ?></span>
                                                                          </div>
                                                                        </div> -->
                                                                        <hr>
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.EmailAddress')); ?> </label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::text('email',  '', array('class'=>'form-control email-validate', 'id'=>'email')); ?>

                                                                             <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                             <?php echo e(trans('labels.EmailText')); ?></span>
                                                                            <span class="help-block hidden"> <?php echo e(trans('labels.EmailError')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Password')); ?></label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <?php echo Form::password('password', array('class'=>'form-control field-validate', 'id'=>'password')); ?>

                                                        	                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                           <?php echo e(trans('labels.PasswordText')); ?></span>
                                                                            <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                                                          <div class="col-sm-10 col-md-4">
                                                                            <select class="form-control" name="isActive">
                                                                                  <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                                                                  <option value="0"><?php echo e(trans('labels.Inactive')); ?></option>
                                        									</select>
                                                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                          <?php echo e(trans('labels.StatusText')); ?></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="box-footer text-center">
                                                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                                            <a href="<?php echo e(URL::to('admin/customers/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                                                        </div>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/customers/add.blade.php ENDPATH**/ ?>