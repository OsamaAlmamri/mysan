<?php $__env->startSection('content'); ?>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.stockin')); ?> <small><?php echo e(trans('labels.stockin')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.stockin')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.ProductName')); ?> : <?php echo e($result['products'][0]->products_name); ?> <?php if(!empty($result['products'][0]->products_model)): ?> ( <?php echo e($result['products'][0]->products_model); ?> )<?php endif; ?></h3>
          </div>          
          <!-- /.box-header -->
          <div class="box-body">
            
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th><?php echo e(trans('labels.AddedBy')); ?></th>
                      <th><?php echo e(trans('labels.AddedDate')); ?></th>
                      <th><?php echo e(trans('labels.Stock')); ?></th>
                      <th><?php echo e(trans('labels.Reference / Purchase Code')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($result['products']['history']) and count($result['products']['history']) > 0): ?>
                    <?php $__currentLoopData = $result['products']['history']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><?php echo e($history->first_name); ?> <?php echo e($history->last_name); ?></td>
                            <td><?php echo e($history->added_date); ?></td>
                            <td>
                                <?php echo e($history->stock); ?>

                            </td>
                            <td>
                            <?php if(!empty($history->reference_code)): ?>
                                <?php echo e($history->reference_code); ?>

                            <?php else: ?>
                            	---
                            <?php endif; ?>
                            </td>                           
                        </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                     <tr><td><?php echo e(trans('labels.Stock is not added yet')); ?></td></tr>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reports/stockin.blade.php ENDPATH**/ ?>