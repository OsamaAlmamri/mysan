<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Banners')); ?> <small><?php echo e(trans('labels.ListingAllBanners')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Banners')); ?></li>
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
                            


                            <div class="col-lg-6 form-inline" id="contact-form">


                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/banners/filter')); ?>">
                                    <input type="hidden"  value="<?php echo e(csrf_token()); ?>">
                                    
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >

                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="Title"  <?php if(isset($name)): ?> <?php if($name == "Title"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>>Title</option>


                                        </select>

                                        

                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/banners')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                        
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>





                            <div class="box-tools pull-right">
                                <a href="<?php echo e(url('admin/banners/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewBanner')); ?></a>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('banners_id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('banners_title', trans('labels.Title')));?></th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.AddedModifiedDate')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($result['banners'])>0): ?>
                                            <?php $resultitems['banners']  = $result['banners']->unique('banners_id');?>
                                            <?php $__currentLoopData = $resultitems['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($banners->banners_id); ?></td>
                                                    <td><?php echo e($banners->banners_title); ?></td>
                                                    <td><img src="<?php echo e(asset($banners->path)); ?>" alt="" width=" 100px"></td>
                                                    <td><strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e(date('d M, Y', strtotime($banners->created_at))); ?><br>
                                                        <strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php if(!empty($banners->updated_at)): ?> <?php echo e(date('d M, Y', strtotime($banners->updated_at))); ?>  <?php endif; ?><br>
                                                        <strong><?php echo e(trans('labels.ExpiryDate')); ?>: </strong><?php if(!empty($banners->expires_date)): ?> <?php echo e(date('d M, Y', strtotime($banners->expires_date))); ?>  <?php endif; ?></td>

                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(url('admin/banners/edit')); ?>/<?php echo e($banners->banners_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteBannerId" banners_id ="<?php echo e($banners->banners_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">

                                        <?php echo $result['banners']->appends(\Request::except('page'))->render(); ?>

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

            <!-- deleteBannerModal -->
            <div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteBannerModalLabel"><?php echo e(trans('labels.DeleteBanner')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/banners/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('banners_id',  '', array('class'=>'form-control', 'id'=>'banners_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteBannerText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\Banners\index.blade.php ENDPATH**/ ?>