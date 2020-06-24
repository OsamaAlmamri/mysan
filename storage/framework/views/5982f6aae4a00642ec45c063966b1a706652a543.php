<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.manageroles')); ?> <small><?php echo e(trans('labels.manageroles')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.manageroles')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.manageroles')); ?> </h3>
            <div class="box-tools pull-right">
            	<a href="<?php echo e(URL::to('admin/addadmintype')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.addadmintype')); ?></a>
            </div>
          </div>

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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.types')); ?></th>
                      <th><?php echo e(trans('labels.Date')); ?></th>
                      <th><?php echo e(trans('labels.Status')); ?></th>
                      <th><?php echo e(trans('labels.Manage Role')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php if(count($result['adminTypes']) > 0): ?>
						<?php $__currentLoopData = $result['adminTypes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$adminType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($adminType->user_types_id); ?></td>
								<td>
                                    <?php echo e($adminType->user_types_name); ?>

                                </td>
								<td>
                                    <strong><?php echo e(trans('labels.AddedDate')); ?>: </strong><?php echo e(date('d-m-Y', $adminType->created_at)); ?><br>
									<strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php if(!empty($adminType->updated_at)): ?><?php echo e(date('d-m-Y', $adminType->updated_at)); ?><?php else: ?> --- <?php endif; ?><br>
								</td>
                                <td>
                                  <?php if($adminType->isActive==1): ?>
                                    <strong class="badge bg-green"><?php echo e(trans('labels.Active')); ?> </strong>
                               	  <?php else: ?>
                                	<strong class="badge bg-light-grey"><?php echo e(trans('labels.InActive')); ?> </strong>
                                  <?php endif; ?>

                                </td>
                                <td>
                                 <a href="addrole/<?php echo e($adminType->user_types_id); ?>" class="manage-role-popup" user_types_id = "<?php echo e($adminType->user_types_id); ?>"> <?php echo e(trans('labels.Manage Role')); ?></span>
                                </td>
								<td>
                                <ul class="nav table-nav">
                                  <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="editadmintype/<?php echo e($adminType->user_types_id); ?>"><?php echo e(trans('labels.editadmintype')); ?></a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCustomerFrom" customers_id="<?php echo e($adminType->user_types_id); ?>"><?php echo e(trans('labels.Delete')); ?></a></li>
                                    </ul>
                                  </li>
                              </ul>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    	<tr>
							<td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
						</tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <?php if(count($result['adminTypes']) > 0): ?>
					<div class="col-xs-12 text-right">
						<?php echo e($result['adminTypes']->links()); ?>

					</div>
                 <?php endif; ?>
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

    <!-- deleteCustomerModal -->
	<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteCustomerModalLabel"><?php echo e(trans('labels.AdminType')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/deleteadmintype', 'name'=>'deleteadmintype', 'id'=>'deleteadmintype', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  <?php echo Form::hidden('user_types_id',  '', array('class'=>'form-control', 'id'=>'customers_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.Are you sure you want to delete this admin type')); ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Delete')); ?></button>
		  </div>
		  <?php echo Form::close(); ?>

		</div>
	  </div>
	</div>

    <div class="modal fade" id="manageRoleModal" tabindex="-1" role="dialog" aria-labelledby="manageRoleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" id="manage-role-content">

		</div>
	  </div>
	</div>

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/admins/roles/manageroles.blade.php ENDPATH**/ ?>