<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.News')); ?> <small><?php echo e(trans('labels.ListingAllNews')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.News')); ?></li>
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
                            

                            <div class="form-inline filteerBox">

                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/news/filter')); ?>">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden><?php echo e(trans('labels.Filter By')); ?></option>
                                            <option value="Name"  <?php if(isset($name)): ?> <?php if($name == "Name"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Name')); ?></option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="<?php echo e(trans('labels.Search')); ?>..." id="parameter"  <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/news/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class=" form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/news/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">

                                    <?php if($errors != null): ?>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('news_id', trans('labels.ID')));?></th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('news_name', trans('labels.Name')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('is_feature', trans('labels.Feature')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.AddedLastModifiedDate')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($news != null): ?>

                                            <?php $newslist = $news->unique('news_id') ?>
                                            <?php $__currentLoopData = $newslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td><?php echo e($new->news_id); ?></td>
                                                    <td><img src="<?php echo e(asset($new->path)); ?>" alt="" width=" 100px" height="100px"></td>
                                                    <td>
                                                        <strong><?php echo e($new->news_name); ?></strong>
                                                    </td>
                                                    <td>
                                                        <?php if($new->is_feature==1): ?>
                                                            <span class="badge bg-green"><?php echo e(trans('labels.Yes')); ?></span>
                                                        <?php elseif($new->is_feature==0): ?>
                                                            <span class="badge bg-red"><?php echo e(trans('labels.No')); ?></span>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e($new->created_at); ?><br>
                                                        <strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php echo e($new->updated_at); ?>

                                                    </td>

                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(URL::to('admin/news/edit/'.$new->news_id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteNewsId" news_id="<?php echo e($new->news_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"><?php echo e(trans('labels.NoRecordFound')); ?>.</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php if($news != null): ?>
                                    <div class="col-xs-12 text-right">
                                        <?php echo e($news->links()); ?>

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

            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteNewsModalLabel"><?php echo e(trans('labels.DeleteNews')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/news/delete', 'name'=>'deleteNews', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteNewsText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteNews"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\news\index.blade.php ENDPATH**/ ?>