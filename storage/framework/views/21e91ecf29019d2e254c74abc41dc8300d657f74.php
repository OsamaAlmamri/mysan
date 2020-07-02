<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.AddProductImages')); ?> <small><?php echo e(trans('labels.AddProductImages')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-database"></i><?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.AddImages')); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo e(trans('labels.AddImage')); ?> </h3>

                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="modal-content">

                                        <?php echo Form::open(array('url' =>'admin/products/images/insertproductimage', 'name'=>'addImageFrom', 'id'=>'addImageFrom', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                                        <?php echo Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')); ?>


                                        <?php echo Form::hidden('sort_order',  count($result['products_images'])+1, array('class'=>'form-control', 'id'=>'sort_order')); ?>


                                        <div class="modal-body">

                                          <div class="form-group" id="imageIcone">
                                              <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                              <div class="col-sm-10 col-md-4">
                                                  <!-- Modal -->
                                                  <div class="modal fade embed-images" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                  <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                              </div>
                                                              <div class="modal-body manufacturer-image-embed">
                                                                  <?php if(isset($allimage)): ?>
                                                                  <select class="image-picker show-html " name="image_id" id="select_img">
                                                                      <option value=""></option>
                                                                      <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  </select>
                                                                  <?php endif; ?>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Image')); ?></a>
                                                                  <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                  <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div id="imageselected">
                                                    <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )); ?>

                                                    <br>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ImageText')); ?></span>
                                                    <br>
                                                    <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close " id="image-Icone"
                                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                  </div>
                                                  <br>
                                              </div>
                                          </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Description')); ?> </label>
                                                <div class="col-sm-10 col-md-8">
                                                    <div class="col-md-6 col-sm-6">
                                                    <?php echo Form::textarea('htmlcontent',  '', array('class'=>'form-control', 'id'=>'htmlcontent', 'colspan'=>'3' )); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
							     <?php echo e(trans('labels.ImageDescription')); ?>

							     </span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-danger addError" style="display: none; margin-bottom: 0;" role="alert"><i class="icon fa fa-ban"></i> <?php echo e(trans('labels.ChooseImageText')); ?> </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-4 control-label"> </label>
                                            <div class="col-sm-10 col-md-8 float-right">
                                            <a type="button" class="btn btn-default float-right" href="<?php echo e(url('admin/products/images/display')); ?>/<?php echo e($products_id); ?>" ><?php echo e(trans('labels.back')); ?> </a>
                                            <button type="submit" class="btn btn-primary float-right" ><?php echo e(trans('labels.AddNew')); ?></button>
                                        </div>
                                            <br><br><br><br><br>

                                        <?php echo Form::close(); ?>

                                        </div>
                                    </div>



                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <!-- /.row -->

                <!-- Main row -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\products\images\add.blade.php ENDPATH**/ ?>