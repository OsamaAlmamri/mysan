<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.OrderStatus')); ?> <small><?php echo e(trans('labels.ListingOrderStatus')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.OrderStatus')); ?></li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.ListingOrderStatus')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a href="addorderstatus" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddOrderStatus')); ?></a>
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
                                            <th><?php echo e(trans('labels.OrderStatus')); ?></th>
                                            <th><?php echo e(trans('labels.Default')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $result['orders_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $OrderStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($OrderStatus->orders_status_id); ?></td>
                                                <td><?php echo e($OrderStatus->orders_status_name); ?></td>
                                                <td><?php if($OrderStatus->public_flag==1): ?> <?php echo e(trans('labels.Yes')); ?>  <?php else: ?> <?php echo e(trans('labels.No')); ?> <?php endif; ?></td>
                                               
                                                <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editorderstatus/<?php echo e($OrderStatus->orders_status_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <?php if($OrderStatus->orders_status_id > 15): ?> <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteOrderStatusId" orders_status_id ="<?php echo e($OrderStatus->orders_status_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a><?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        <?php echo e($result['orders_status']->links()); ?>

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
            <!-- deleteOrderStatusModal -->
            <div class="modal fade" id="deleteOrderStatusModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderStatusModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteOrderStatusModalLabel"><?php echo e(trans('labels.DeleteOrderStatus')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/orders/deleteOrderStatus', 'name'=>'deleteOrderStatus', 'id'=>'deleteOrderStatus', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'orders_status_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteOrderStatusText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteOrderStatus"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/Orders/orderstatus.blade.php ENDPATH**/ ?>