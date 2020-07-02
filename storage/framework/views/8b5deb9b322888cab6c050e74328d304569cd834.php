<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Currencies')); ?> <small><?php echo e(trans('labels.ListingAllCurrencies')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Currencies')); ?></li>
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
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/currencies/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                            </br>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', trans('labels.ID')));?></th>
                                            <th><?php echo e(trans('labels.Title')); ?></th>
                                            <th><?php echo e(trans('labels.code')); ?></th>
                                            <th><?php echo e(trans('labels.symbol')); ?></th>
                                            <th><?php echo e(trans('labels.Position')); ?></th>
                                            <th style="display: none"><?php echo e(trans('labels.decimal_point')); ?></th>
                                            <th style="display: none"><?php echo e(trans('labels.thousands_point')); ?></th>
                                            <th><?php echo e(trans('labels.decimal_places')); ?></th>
                                            <th><?php echo e(trans('labels.value')); ?></th>
                                            <th style="display: none"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.created_at')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($currencies)>0): ?>
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key+1); ?> <?php if($currency->id==1): ?> <span class="label label-success"><?php echo e(trans('labels.is_default')); ?></span><?php endif; ?></td>
                                                        <td><?php echo e($currency->title); ?></td>
                                                        <td><?php echo e($currency->code); ?></td>
                                                        <td><?php echo e($currency->symbol_left); ?>

                                                            <?php echo e($currency->symbol_right); ?>

                                                        </td>

                                                        <td>
                                                            <?php if(!empty($currency->symbol_left)): ?>
                                                                <?php echo app('translator')->get('labels.Left'); ?>
                                                            <?php else: ?>
                                                                <?php echo app('translator')->get('labels.Right'); ?>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td style="display: none"><?php echo e($currency->decimal_point); ?></td>
                                                        <td style="display: none"><?php echo e($currency->thousands_point); ?></td>
                                                        <td><?php echo e($currency->decimal_places); ?></td>
                                                        <td><?php echo e($currency->value); ?></td>
                                                        <td style="display: none">
                                                            <strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e($currency->created_at); ?><br>
                                                            <strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php echo e($currency->updated_at); ?>

                                                        </td>
                                                        <td>
                                                        <?php if($currency->id!=1): ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/currencies/edit/'. $currency->id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a id="delete" category_id="<?php echo e($currency->id); ?>" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php else: ?>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/currencies/edit/'. $currency->id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php endif; ?>
                                                        </td>
                                                    </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php if($currencies != null): ?>
                                      <div class="col-xs-12 text-right">
                                          <?php echo e($currencies->links()); ?>

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

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/currencies/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\currencies\index.blade.php ENDPATH**/ ?>