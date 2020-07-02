<?php $__env->startSection('content'); ?>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.editadmintype')); ?> <small><?php echo e(trans('labels.editadmintype')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.manageroles')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.editadmintype')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.editadmintype')); ?> </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <br>                       
                       	
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-success" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <?php if(session()->has('errorMessage')): ?>
                            <div class="alert alert-danger" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('errorMessage')); ?>

                            </div>
                        <?php endif; ?>
                            
                        <!-- form start -->                        
                         <div class="box-body">
                            <?php echo Form::open(array('url' =>'admin/updatetype', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                            <?php echo Form::hidden('user_types_id',  $result['user_types'][0]->user_types_id, array('class'=>'form-control', 'id'=>'user_types_id')); ?>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.AdminTypeName')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::text('user_types_name',  $result['user_types'][0]->user_types_name, array('class'=>'form-control field-validate', 'id'=>'user_types_name')); ?>

                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AdminTypeNameText')); ?></span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="isActive">
                                          <option value="1" <?php if($result['user_types'][0]->isActive==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                          <option value="0" <?php if($result['user_types'][0]->isActive==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
									</select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  <?php echo e(trans('labels.AdminTypeStatusText')); ?></span>
                                  </div>
                                </div>
                                
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                <a href="<?php echo e(URL::to('admin/manageroles')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\admins\roles\editadmintype.blade.php ENDPATH**/ ?>