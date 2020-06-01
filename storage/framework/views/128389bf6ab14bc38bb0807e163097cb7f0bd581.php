<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Add Roles')); ?> <small><?php echo e(trans('labels.Add Roles')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
       <li><a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.manageroles')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Add Roles')); ?></li>
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
            <h3 class="box-title"><strong><?php echo e(trans('labels.Type')); ?>:</strong> <?php echo e($result['adminType'][0]->user_types_name); ?> </h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <!-- form start -->
                         <div class="box-body">
                          <?php if(session()->has('message')): ?>
                            <div class="alert alert-success" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>

                            <?php echo Form::open(array('url' =>'admin/addnewroles', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                            <?php echo Form::hidden('user_types_id',  $result['user_types_id'], array('class'=>'form-control', 'id'=>'user_types_id')); ?>

                           <div class="row">
                            <?php $__currentLoopData = $result['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                            <hr>
                            <h4><?php echo e(trans('labels.manage '.$datas['link_name'])); ?> </h4>
                            <hr>
                            <?php $__currentLoopData = $datas['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                           		<label class="col-sm-3 col-md-5 control-label" style=""><?php echo e(trans('labels.manage '.$data['name'])); ?></label>
                                <div class="col-sm-10 col-md-4">
                                    <label class=" control-label">
                                          <input type="radio" name="<?php echo e($data['name']); ?>" value="1" class="flat-red" <?php if($data['value']==1): ?> checked <?php endif; ?> > &nbsp;<?php echo e(trans('labels.Yes')); ?>

                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <label class=" control-label">
                                          <input type="radio" name="<?php echo e($data['name']); ?>" value="0" class="flat-red" <?php if($data['value']==0): ?> checked <?php endif; ?> >  &nbsp;<?php echo e(trans('labels.No')); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>

                              <!-- /.box-body -->
                            <div class="box-footer ">
                              <a style="float:right;"href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                            	<button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/admins/roles/addrole.blade.php ENDPATH**/ ?>