<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Sliders')); ?> <small><?php echo e(trans('labels.ListingAllImages')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Sliders')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.ListingAllImages')); ?> </h3>
            <div class="box-tools pull-right">
            	<!-- <a href="<?php echo e(URL::to('admin/addsliderimage')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewImage')); ?></a> -->
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
                      <th><?php echo e(trans('labels.Title')); ?></th>
                      <th><?php echo e(trans('labels.Image')); ?></th>
                      <th><?php echo e(trans('labels.AddedModifiedDate')); ?></th>
                      <th><?php echo e(trans('labels.languages')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['sliders'])>0): ?>
                    <?php $__currentLoopData = $result['sliders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sliders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($sliders->sliders_id); ?></td>
                            <td><?php echo e($sliders->sliders_title); ?></td>
                            <td><img src="<?php echo e(asset('').$sliders->path); ?>" alt="" width=" 100px"></td>
                            <td><strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e(date('d M, Y', strtotime($sliders->date_added))); ?><br>
                            <strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php if(!empty($sliders->date_status_change)): ?> <?php echo e(date('d M, Y', strtotime($sliders->date_status_change))); ?>  <?php endif; ?><br>
                            <strong><?php echo e(trans('labels.ExpiryDate')); ?>: </strong><?php if(!empty($sliders->expires_date)): ?> <?php echo e(date('d M, Y', strtotime($sliders->expires_date))); ?>  <?php endif; ?></td>

                            <td><?php echo e($sliders->language_name); ?></td>
                            <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editslide/<?php echo e($sliders->sliders_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                            <!-- <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteSliderId" sliders_id ="<?php echo e($sliders->sliders_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
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
                	<?php echo e($result['sliders']->links('vendor.pagination.default')); ?>

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

    <!-- deleteSliderModal -->
	<div class="modal fade" id="deleteSliderModal" tabindex="-1" role="dialog" aria-labelledby="deleteSliderModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteSliderModalLabel"><?php echo e(trans('labels.DeleteSlider')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/deleteSlider', 'name'=>'deleteSlider', 'id'=>'deleteSlider', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  <?php echo Form::hidden('sliders_id',  '', array('class'=>'form-control', 'id'=>'sliders_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.DeleteSliderText')); ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary" id="deleteSlider"><?php echo e(trans('labels.Delete')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/settings/web/sliders/index.blade.php ENDPATH**/ ?>