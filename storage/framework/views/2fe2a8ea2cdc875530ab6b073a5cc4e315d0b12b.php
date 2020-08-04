<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Bouquets')); ?> <small><?php echo e(trans('labels.Bouquets')); ?>...</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(route('bouquets.index')); ?>"><i
                            class="fa fa-database"></i> <?php echo e(trans('labels.Bouquets')); ?></a></li>

                <li class="active"><?php echo e(trans('labels.Add Bouquet')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.Add Bouquet')); ?> </h3>
                        </div>
                        <div class="box-body">
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php if(isset($viewCategory)): ?>
                                <?php echo Form::model($viewCategory, ['route' => ['bouquets.update', $viewCategory->id], 'method' => 'put','class' => 'form-horizontal form-validate', 'files' => true]); ?>


                                <?php echo Form::hidden('oldImage', $viewCategory->image , array('id'=>'oldImage')); ?>

                            <?php else: ?>
                                <?php echo Form::open(array('route' =>'bouquets.store', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'files' => true)); ?>

                            <?php endif; ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- Left col -->
                                                <div class="col-md-6">
                                                    <!-- MAP & BOX PANE -->
                                                    <!-- /.box -->
                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-info">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><?php echo e(trans('labels.Add Bouquet Products')); ?></h3>
                                                                    <div class="box-tools pull-right">

                                                                    </div>
                                                                </div>
                                                                <!-- /.box-header -->
                                                                <div class="box-body">

                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.Products')); ?>

                                                                            <span style="color:red;">*</span> </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <select
                                                                                class="form-control field-validate select2 product-type"
                                                                                id="select_product_id"
                                                                                name="products_id">
                                                                                <option
                                                                                    value=""><?php echo e(trans('labels.Choose Product')); ?></option>
                                                                                <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option
                                                                                        value="<?php echo e($pro->products_id); ?>"><?php echo e($pro->products_name); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select><span class="help-block"
                                                                                           style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Product Type Text')); ?>.</span>
                                                                        </div>
                                                                    </div>
                                                                    <div id="attribute" style="display:none">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">
                                                                            <?php echo e(trans('labels.Current Stock')); ?>

                                                                        </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <p id="current_stocks" style="width:100%">
                                                                                0</p><br>


                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label">
                                                                            <?php echo e(trans('labels.Total Purchase Price')); ?>

                                                                        </label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <p class="purchase_price_content"
                                                                               style="width:100%"><?php echo e($result['currency'][19]->value); ?>

                                                                                <span id="total_purchases">0</span></p>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name"
                                                                               class="col-sm-2 col-md-4 control-label"><?php echo e(trans('labels.count')); ?>

                                                                            <span style="color:red;">*</span></label>
                                                                        <div class="col-sm-10 col-md-8">
                                                                            <input type="number" id="products_count"
                                                                                   name="count" value="1" min="1"
                                                                                   class="form-control number-validate">
                                                                            <span class="help-block"
                                                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.Enter Bouquet Products count')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.users-list -->
                                                                </div>
                                                            <?php if(count($result['products'])> 0): ?>
                                                                <?php if(count($result['attributes'])>0 and $result['products'][0]->products_type==1 or $result['products'][0]->products_type==0): ?>
                                                                    <!-- /.box-body -->
                                                                        <div class="box-footer text-center">
                                                                            <button type="submit"
                                                                                    id="btn_add_bouquets_products"
                                                                                    class="btn btn-primary pull-right"><?php echo e(trans('labels.Add')); ?></button>
                                                                        </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <!-- /.box-footer -->
                                                            </div>
                                                            <!--/.box -->
                                                        </div>

                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- MAP & BOX PANE -->

                                                    <!-- /.box -->
                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-danger">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><?php echo e(trans('labels.Bouquet Products')); ?></h3>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th> المنتج</th>
                                                                            <th>الكمية</th>
                                                                            <th>السمات</th>
                                                                            <th>حذف</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody style="text-align: right;"
                                                                               id="products_list_table">

                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                            <!--/.box -->
                                                        </div>

                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Usage Limit For Bouquet')); ?> </label>
                                        <div class="col-sm-10 col-md-8">
                                            <?php echo Form::number('count',  '1', array('class'=>'form-control ','min'=>1, 'placeholder'=>trans('labels.Unlimited'), 'id'=>'usage_limit')); ?>

                                            <span class="help-block"
                                                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Usage Limit For Bouquet count')); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                               class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.BouquetExpiryDate')); ?></label>
                                        <div class="col-sm-10 col-md-8">
                                            <?php echo Form::text('expiry_date',  '', array('class'=>'form-control field-validate datepicker', 'id'=>'datepicker', 'readonly'=>'readonly')); ?>

                                            <span class="help-block hidden"><?php echo e(trans('labels.BouquetExpiryDate')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.BouquetPrice')); ?><span style="color:red;">*</span></label>
                                        <div class="col-sm-10 col-md-8">
                                            <?php echo Form::number('bouquet_price',  '1', array('class'=>'form-control ','min'=>1, 'placeholder'=>trans('labels.BouquetPrice'), 'id'=>'usage_limit')); ?>

                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductPriceText')); ?>

                                                        </span>
                                            <span class="help-block hidden"><?php echo e(trans('labels.ProductPriceText')); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.AllowFreeShipping')); ?></label>
                                        <div class="col-sm-10 col-md-8" style="padding-top: 7px;">
                                            <label style="margin-bottom:0">
                                                <?php echo Form::checkbox('free_shipping', 1, null, ['class' => 'minimal']); ?>

                                            </label>
                                            &nbsp; <?php echo e(trans('labels.AllowBouquetFreeShippingText')); ?>


                                        </div>
                                    </div>
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
                                                    <select class="image-picker show-html " name="image_id"
                                                            id="select_img">
                                                        <option value=""></option>
                                                        <?php $__currentLoopData = getAllImages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option data-img-src="<?php echo e(asset($image->path)); ?>"
                                                                    class="imagedetail" data-img-alt="<?php echo e($key); ?>"
                                                                    value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank"
                                                       class="btn btn-primary pull-left"><?php echo e(trans('labels.Add Image')); ?></a>
                                                    <button type="button"
                                                            class="btn btn-default refresh-image">
                                                        <i class="fa fa-refresh"></i></button>
                                                    <button type="button" class="btn btn-primary" id="selected"
                                                            data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="imageselected">
                                        <?php if(isset($viewCategory)): ?>
                                            <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                        <?php else: ?>
                                            <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                        <?php endif; ?>
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
                            <?php if((isset($old_image)) and  $old_image !=null): ?>
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
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tabbable tabs-left">
                                        <ul class="nav nav-tabs">
                                            <?php $__currentLoopData = getLanguage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="<?php if($key==0): ?> active <?php endif; ?>"><a
                                                        href="#product_<?php echo e($languages->languages_id); ?>"
                                                        data-toggle="tab"><?php echo e($languages->name); ?><span
                                                            style="color:red;">*</span></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = getLanguage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-top: 15px;"
                                                     class="tab-pane <?php if($key==0): ?> active <?php endif; ?>"
                                                     id="product_<?php echo e($languages->languages_id); ?>">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="name"
                                                                   class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.BouquetName')); ?>

                                                                <span style="color:red;">*</span>
                                                                (<?php echo e($languages->name); ?>)</label>
                                                            <div class="col-sm-10 col-md-8">
                                                                <input type="text"
                                                                       name="bouquet_name_<?php echo e($languages->languages_id); ?>"
                                                                       class="form-control field-validate">
                                                                <span class="help-block"
                                                                      style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.EnterProductNameIn')); ?> <?php echo e($languages->name); ?> </span>
                                                                <span
                                                                    class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name"
                                                                   class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Description')); ?>

                                                                <span style="color:red;">*</span>
                                                                (<?php echo e($languages->name); ?>)</label>
                                                            <div class="col-sm-10 col-md-8">
                                                                <textarea id="editor<?php echo e($languages->languages_id); ?>"
                                                                          name="bouquet_description_<?php echo e($languages->languages_id); ?>"
                                                                          class="form-control" rows="5"></textarea>
                                                                <span class="help-block"
                                                                      style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.EnterProductDetailIn')); ?> <?php echo e($languages->name); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <button type="submit"
                                        class="btn btn-primary pull-right"><?php echo e(trans('labels.Add')); ?></button>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>


        </section>
        <!-- /.row -->

        <!-- Main row -->
    </div>

    <!-- /.row -->
    <script src="<?php echo asset('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>

    <script type="text/javascript">
        $(function () {

            //for multiple languages
            <?php $__currentLoopData = getLanguage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor<?php echo e($languages->languages_id); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/bouquets/add1.blade.php ENDPATH**/ ?>