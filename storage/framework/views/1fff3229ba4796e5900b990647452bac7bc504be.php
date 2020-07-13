<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.Coupons')); ?> <small><?php echo e(trans('labels.ListingAllCoupons')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.Coupons')); ?></li>
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
                            

                            <div class="col-lg-6 form-inline" id="contact-form">


                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/coupons/filter')); ?>">
                                    <input type="hidden"  value="<?php echo e(csrf_token()); ?>">
                                    
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >
                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="Code"  <?php if(isset($name)): ?> <?php if($name == "Code"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Code')); ?></option>
                                        </select>
                                        

                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/coupons/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                        
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>


                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/coupons/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('coupans_id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('code', trans('labels.Code')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('discount_type', trans('labels.CouponType')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('amount', trans('labels.CouponAmount')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', trans('labels.Description')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('expiry_date', trans('labels.ExpiryDate')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($coupons !== null): ?>
                                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td><?php echo e($coupan->coupans_id); ?></td>
                                                    <td><?php echo e($coupan->code); ?></td>
                                                    <td><?php echo e(str_replace('_', ' ', $coupan->discount_type)); ?> </td>
                                                    <td>
                                                        <?php if($coupan->discount_type=='fixed_product' or $coupan->discount_type=='fixed_cart'): ?>
                                                            <?php echo e($result['currency'][19]->value); ?><?php echo e($coupan->amount); ?>

                                                        <?php else: ?>
                                                            <?php echo e($coupan->amount); ?>%
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($coupan->description); ?> </td>
                                                    <td><?php echo e(date('d/m/Y',strtotime($coupan->expiry_date))); ?> </td>

                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(url('admin/coupons/edit')); ?>/<?php echo e($coupan->coupans_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCoupans_id" coupans_id ="<?php echo e($coupan->coupans_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8"><strong><?php echo e(trans('labels.NoRecordFound')); ?></strong></td>
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
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- deleteCoupanModal -->
            <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog" aria-labelledby="deleteCoupanModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteCoupanModalLabel"><?php echo e(trans('labels.DeleteCoupon')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/coupons/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteCouponText')); ?></p>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-danger" id="deleteCoupanBtn"><?php echo e(trans('labels.Delete')); ?> </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/coupons/index.blade.php ENDPATH**/ ?>