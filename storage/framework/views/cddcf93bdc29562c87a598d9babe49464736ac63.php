<?php $__env->startSection('content'); ?>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Low Stock Products')); ?> <small><?php echo e(trans('labels.Low Stock Products')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Low Stock Products')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.Low Stock Products')); ?> </h3>
          </div>          
          <!-- /.box-header -->
          <div class="box-body">
            
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.Image')); ?></th>
                      <th><?php echo e(trans('labels.Products')); ?></th>
                      <!--<th><?php echo e(trans('labels.Quantity')); ?></th>-->
                      <th><?php echo e(trans('labels.ViewStock')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                 <?php if(count($result['lowQunatity']) > 0): ?>
                    <?php $__currentLoopData = $result['lowQunatity']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$lowQunatityProducts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($lowQunatityProducts->products_id); ?></td>
                            <td><img src="<?php echo e(asset('').'/'.$lowQunatityProducts->products_image); ?>" alt="" width=" 100px" height="100px"></td>
                            <td width="45%">
                                <strong><?php echo e($lowQunatityProducts->products_name); ?> ( <?php echo e($lowQunatityProducts->products_model); ?> )</strong><br>
                            </td>
                            <!--<td>
                                <?php echo e($lowQunatityProducts->products_quantity); ?>

                            </td>-->
                            <td>
                                <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.View')); ?>" href="stockin?products_id=<?php echo e($lowQunatityProducts->products_id); ?>" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php else: ?> 
                 <tr>
                 	<td colspan="4">
                 		<?php echo e(trans('labels.NoRecordFound')); ?>

                    </td>
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
    
    <!-- Main row --> 
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/reports/lowinstock.blade.php ENDPATH**/ ?>