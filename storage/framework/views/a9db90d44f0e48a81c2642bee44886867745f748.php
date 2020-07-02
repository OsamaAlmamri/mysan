<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.reviews')); ?> <small><?php echo e(trans('labels.ListingAllReviews')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.reviews')); ?></li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if($errors): ?>
                                        <?php if($errors->any()): ?>
                                            <div <?php if($errors->first()=='Default can not Deleted!!'): ?> class="alert alert-danger alert-dismissible" <?php else: ?> class="alert alert-success alert-dismissible" <?php endif; ?> role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <?php echo e(trans('labels.DefaultLanguageChangedMessage')); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('reviews_id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('products_name',  trans('labels.products_name')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('reviews_text',  trans('labels.reviews_text')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at',  trans('labels.Date')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($result['reviews']): ?>
                                            <?php $__currentLoopData = $result['reviews']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td>
                                                        <?php echo e($review->reviews_id); ?>

                                                        <?php if($review->reviews_read == 0 and $review->reviews_status == 0): ?>
                                                        <span class="label label-success"><?php echo e(trans('labels.new')); ?></span>
                                                        <?php elseif($review->reviews_read == 1 and $review->reviews_status == 0): ?>
                                                        <span class="label label-info"><?php echo e(trans('labels.pending')); ?></span>
                                                        <?php elseif($review->reviews_read == 1 and $review->reviews_status == 1): ?>
                                                        <span class="label label-primary"><?php echo e(trans('labels.seen')); ?></span>
                                                        <?php elseif($review->reviews_read == 1 and $review->reviews_status == -1): ?>
                                                        <span class="label label-danger"><?php echo e(trans('labels.Deactive')); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($review->products_name); ?></td>
                                                    <td width="40%"><?php echo e($review->reviews_text); ?></td>
                                                    <td><?php echo e($review->created_at); ?></td>
                                                    <td>
                                                        <?php if($review->reviews_read == 0 and $review->reviews_status == 0): ?>
                                                      <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(URL::to('admin/reviews/edit/'.$review->reviews_id.'/0')); ?>"><?php echo e(trans('labels.pending')); ?></a>
                                                      </br>
                                                      <?php endif; ?>
                                                      <a class="btn btn-success" style="width: 100%;  margin-bottom: 5px;"  href="<?php echo e(URL::to('admin/reviews/edit/'.$review->reviews_id.'/1')); ?>"><?php echo e(trans('labels.Active')); ?></a>
                                                    </br>
                                                    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;"  href="<?php echo e(URL::to('admin/reviews/edit/'.$review->reviews_id.'/-1')); ?>"><?php echo e(trans('labels.Deactive')); ?></a>
                                                      </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><?php echo e(trans('labels.Nolanguageexist')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                        <?php if($result['reviews'] != null): ?>
                                        <div class="col-xs-12 text-right">
                                            <?php echo e($result['reviews']->links()); ?>

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
            <!-- deletelanguagesModal -->
            <div class="modal fade" id="deleteLanguagesModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel"><?php echo e(trans('labels.DeleteLanguages')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/languages/delete', 'name'=>'deletelanguages', 'id'=>'deletelanguages', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'languages_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.confrimLanguageDelete')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deletelanguages"><?php echo e(trans('labels.Delete')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>