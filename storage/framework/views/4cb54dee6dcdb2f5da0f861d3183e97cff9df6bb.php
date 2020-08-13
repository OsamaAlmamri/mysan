<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo e(trans('labels.Customer Report')); ?> <small><?php echo e(trans('labels.Customer Report')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Customer Report')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.Customer Report')); ?> </h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12">

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('labels.Ranking in Orders')); ?></th>
                      <th><?php echo e(trans('labels.CustomerName')); ?></th>
                      <th><?php echo e(trans('labels.Email')); ?></th>
                      <th><?php echo e(trans('labels.Phone')); ?></th>
                      <th><?php echo e(trans('labels.Member Since')); ?></th>
                      <th><?php echo e(trans('labels.# of orders')); ?></th>
                      <th><?php echo e(trans('labels.TotalPurchased')); ?></th>
                      <!-- <th><?php echo e(trans('labels.View')); ?></th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['cusomters'])>0): ?>
                    <?php $__currentLoopData = $result['cusomters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$key); ?></td>
                            <td><?php echo e($orderData->first_name); ?> <?php echo e($orderData->last_name); ?></td>
                            <td> <?php echo e($orderData->email); ?></td>
                            <td><?php echo e($orderData->country_code); ?> <?php echo e($orderData->phone); ?></td>
                            <td> <?php echo e($orderData->created_at); ?></td>
                            <td> <?php echo e($orderData->total_orders); ?></td>
                            <td><?php echo e($result['setting'][19]->value); ?><?php echo e($orderData->price); ?></td>
                            <!-- <td><a href="<?php echo e(URL::to('admin/customers/edit')); ?>/<?php echo e($orderData->id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td> -->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  	<tr>
                    	<td colspan="6"><strong><?php echo e(trans('labels.NoRecordFound')); ?></strong></td>
                    </tr>
                  <?php endif; ?>
                  </tbody>
                </table>               
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reports/statsCustomers.blade.php ENDPATH**/ ?>