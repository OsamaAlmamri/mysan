<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.view_categories')); ?> <small><?php echo e(trans('labels.ListingAllView_categories')); ?>

                    ...</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.view_categories')); ?></li>
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
                            


                            <div class="box-tools ">
                                <a href="<?php echo e(URL::to('admin/view_categories/create')); ?>" type="button"
                                   class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                            <br>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name_ar', trans('labels.name_ar')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name_en', trans('labels.name_en')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sort', trans('labels.sort')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('parent', trans('labels.parent')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('content', trans('labels.content')));?></th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php if($coupons !== null): ?>
                                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($coupan->id); ?></td>
                                                    <td><?php echo e($coupan->name_ar); ?></td>
                                                    <td><?php echo e($coupan->name_en); ?> </td>
                                                    <td><?php echo e($coupan->sort); ?> </td>
                                                    <td><?php echo e(($coupan->parent==0)?trans('labels.no'):trans('labels.yes')); ?> </td>
                                                    <td><?php echo e(($coupan->content=='products')?trans('labels.view_type_products'):trans('labels.view_type_categories')); ?> </td>
                                                    <td><img src="<?php echo e(asset($coupan->imagePath->imagesTHUMBNAIL->path)); ?>" alt="" width=" 100px"></td>

                                                    <td><a data-toggle="tooltip" data-placement="bottom"
                                                           title="<?php echo e(trans('labels.Edit')); ?>"
                                                           href="<?php echo e(url('admin/view_categories/'.$coupan->id.'/edit')); ?>"
                                                           class="badge bg-light-blue"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom"
                                                           title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCoupans_id"
                                                           coupans_id="<?php echo e($coupan->id); ?>"
                                                           class="badge bg-red"><i class="fa fa-trash"
                                                                                   aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8"><strong><?php echo e(trans('labels.NoRecordFound')); ?></strong>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        
                                        
                                        <?php echo $coupons->appends(\Request::except('page'))->render(); ?>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- deleteCoupanModal -->
            <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteCoupanModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="deleteCoupanModalLabel"><?php echo e(trans('labels.DeleteView_categories')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/view_categories/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteView_categoriesText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"
                                    id="deleteCoupanBtn"><?php echo e(trans('labels.Delete')); ?> </button>
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/view_categories/index.blade.php ENDPATH**/ ?>