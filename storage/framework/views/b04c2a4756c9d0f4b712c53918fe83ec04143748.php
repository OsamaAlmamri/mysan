<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php if(isset($viewCategory)): ?>
                    <small><?php echo e(trans('labels.EditViewCategory')); ?>...</small>
                <?php else: ?>
                    <small><?php echo e(trans('labels.AddViewCategory')); ?>...</small>
                <?php endif; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/view_categories')); ?>"><i
                            class="fa fa-tablet"></i><?php echo e(trans('labels.ListingAllView_categories')); ?></a></li>
                <li class="active"> <?php if(isset($viewCategory)): ?>
                        <?php echo e(trans('labels.EditViewCategory')); ?>

                    <?php else: ?>
                        <?php echo e(trans('labels.AddViewCategory')); ?>

                    <?php endif; ?></li>
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
                            <h3 class="box-title">
                            <?php if(isset($viewCategory)): ?>
                                <?php echo e(trans('labels.EditViewCategory')); ?>

                            <?php else: ?>
                                <?php echo e(trans('labels.AddViewCategory')); ?>

                            <?php endif; ?>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>
                                        <?php if(count($result['message'])>0): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <?php echo e($result['message']); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="box-body">
                                            <?php if(isset($viewCategory)): ?>
                                                <?php echo Form::model($viewCategory, ['route' => ['view_categories.update', $viewCategory->id], 'method' => 'put','class' => 'form-horizontal form-validate', 'files' => true]); ?>


                                            <?php else: ?>
                                                <?php echo Form::open(array('route' =>'view_categories.store', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'files' => true)); ?>

                                            <?php endif; ?>
                                                <?php echo Form::hidden('oldImage', $old_image , array('id'=>'oldImage')); ?>


                                                <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.name_ar')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('name_ar', null, array('class'=>'form-control field-validate', 'id'=>'name_ar')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_name_ar')); ?></span>
                                                    <span
                                                        class="help-block hidden"><?php echo e(trans('labels.view_categories_name_ar')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.name_en')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('name_en',  null, array('class'=>'form-control field-validate', 'id'=>'name_en')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_name_en')); ?></span>
                                                    <span
                                                        class="help-block hidden"><?php echo e(trans('labels.view_categories_name_en')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group" id="imageselected">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?>

                                                    <span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                
                                                <!-- Modal -->
                                                    <div class="modal fade" id="Modalmanufactured" tabindex="-1"
                                                         role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" id="closemodal"
                                                                            aria-label="Close"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <h3 class="modal-title text-primary"
                                                                        id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                                </div>
                                                                <div class="modal-body manufacturer-image-embed">
                                                                    <?php if(isset($allimage)): ?>
                                                                        <select
                                                                            class="image-picker show-html field-validate"
                                                                            name="image_id" id="select_img">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    data-img-src="<?php echo e(asset($image->path)); ?>"
                                                                                    class="imagedetail"
                                                                                    data-img-alt="<?php echo e($key); ?>"
                                                                                    value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank"
                                                                       class="btn btn-primary pull-left"><?php echo e(trans('labels.Add Image')); ?></a>
                                                                    <button type="button"
                                                                            class="btn btn-default refresh-image"><i
                                                                            class="fa fa-refresh"></i></button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="selected"
                                                                            data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="imageselected">
                                                        <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                        <br>
                                                        <div id="selectedthumbnail"
                                                             class="selectedthumbnail col-md-5"></div>
                                                        <div class="closimage">
                                                            <button type="button" class="close pull-left image-close "
                                                                    id="image-close"
                                                                    style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; "
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CategoryImageText')); ?></span>
                                                </div>
                                            </div>
                                            <?php if($old_image !=null): ?>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                    <div class="col-sm-10 col-md-4">
                                                    <span class="help-block "
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OldImage')); ?></span>
                                                        <br>
                                                        <img src="<?php echo e(asset($old_image)); ?>"
                                                             alt=""
                                                             width=" 100px">
                                                    </div>
                                                </div>
                                            <?php endif; ?>


                                            <div class="form-group">
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.view_categories_sort')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::number('sort', null, array('class'=>'form-control field-validate', 'id'=>'sort')); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    	<?php echo e(trans('labels.view_categories_sortText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_categories_content"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.view_categories_content')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form ::select('content',['products'=>trans('labels.view_type_products'), 'categories'=>trans('labels.view_type_categories')],null,['class' => 'select2 form-control', 'id' => 'view_categories_content']); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_type_categoriesText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="view_categories_parent"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.view_categories_parent')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form ::select('parent',['0'=>trans('labels.view_categories_parent_0'), 'categories'=>trans('labels.view_categories_parent_1')],null,['class' => 'select2 form-control', 'id' => 'view_categories_parent']); ?>

                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_parentText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_products_view_categories"
                                                 <?php if($content!='products'): ?> style="display: none" <?php endif; ?>>
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Products')); ?></label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="products[]" multiple
                                                            class="form-control select2 ">
                                                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($products->products_id); ?>"
                                                                <?php if(in_array($products->products_id,$old_products)): ?> selected="" <?php endif; ?> ><?php echo e($products->products_name); ?> <?php echo e($products->products_model); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categories_products')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group" id="div_categories_view_categories"
                                                 <?php if($content!='categories'): ?> style="display: none" <?php endif; ?>>
                                                <label for="name"
                                                       class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.IncludeCategories')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="categories[]" multiple
                                                            class="form-control select2">
                                                        <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($categories->id); ?>"
                                                                    <?php if(in_array($products->products_id,$old_products)): ?> selected="" <?php endif; ?> ><?php echo e($categories->name_ar); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block"
                                                          style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.view_categoriesCategoriesText')); ?></span>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit"
                                                        class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/view_categories')); ?>" type="button"
                                                   class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                            </div>
                                            <!-- /.box-footer -->
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
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/view_categories/add.blade.php ENDPATH**/ ?>