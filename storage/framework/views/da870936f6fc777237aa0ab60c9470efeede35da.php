<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Products')); ?> <small><?php echo e(trans('labels.ListingAllProducts')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.Products')); ?></li>
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

                            <div CLASS="col-lg-12"> <h7 style="font-weight: bold; padding:0px 16px; float: left;"><?php echo e(trans('labels.FilterByCategory/Products')); ?>:</h7>

                                <br>
                           <div class="col-lg-10 form-inline">

                                <form  name='registration' id="registration" class="registration" method="get">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <div class="input-group-form search-panel ">
                                        <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="categories_id">

                                            <option value="" selected disabled hidden><?php echo e(trans('labels.ChooseCategory')); ?></option>
                                            <?php $__currentLoopData = $results['subCategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$subCategories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($subCategories->id); ?>"
                                                        <?php if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])): ?>
                                                          <?php if( $subCategories->id == $_REQUEST['categories_id']): ?>
                                                            selected
                                                          <?php endif; ?>
                                                        <?php endif; ?>
                                                ><?php echo e($subCategories->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="product" placeholder="Search term..." id="parameter"  <?php if(isset($product)): ?> value="<?php echo e($product); ?>" <?php endif; ?> />
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($product,$categories_id)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/products/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/products/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('products_id', trans('labels.ID')));?></th>
                                            <th><?php echo e(trans('labels.Image')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('categories_name', trans('labels.Category')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('products_name', trans('labels.Name')));?></th>
                                            <th><?php echo e(trans('labels.Additional info')); ?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.ModifiedDate')));?></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($results['products'])>0): ?>
                                            <?php  $resultsProduct = $results['products']->unique('products_id')->keyBy('products_id');  ?>
                                            <?php $__currentLoopData = $resultsProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($product->products_id); ?></td>
                                                    <td><img src="<?php echo e(asset($product->path)); ?>" alt="" height="50px"></td>
                                                    <td>
                                                        <?php echo e($product->categories_name); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($product->products_name); ?> <?php if(!empty($product->products_model)): ?> ( <?php echo e($product->products_model); ?> ) <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($product->first_name); ?> <?php echo e($product->last_name); ?>

                                                    </td>
                                                    <td>
                                                        <strong><?php echo e(trans('labels.Product Type')); ?>:</strong>
                                                        <?php if($product->products_type==0): ?>
                                                            <?php echo e(trans('labels.Simple')); ?>

                                                        <?php elseif($product->products_type==1): ?>
                                                            <?php echo e(trans('labels.Variable')); ?>

                                                        <?php elseif($product->products_type==2): ?>
                                                            <?php echo e(trans('labels.External')); ?>

                                                        <?php endif; ?>
                                                        <br>
                                                        <?php if(!empty($product->manufacturers_name)): ?>
                                                            <strong><?php echo e(trans('labels.Manufacturer')); ?>:</strong> <?php echo e($product->manufacturers_name); ?><br>
                                                        <?php endif; ?>
                                                        <strong><?php echo e(trans('labels.Price')); ?>: </strong>     <?php echo e($results['currency'][19]->value); ?><?php echo e($product->products_price); ?><br>
                                                        <strong><?php echo e(trans('labels.Weight')); ?>: </strong>  <?php echo e($product->products_weight); ?><?php echo e($product->products_weight_unit); ?><br>
                                                        <strong><?php echo e(trans('labels.Viewed')); ?>: </strong>  <?php echo e($product->products_viewed); ?><br>
                                                        <?php if(!empty($product->specials_id)): ?>
                                                            <strong class="badge bg-light-blue"><?php echo e(trans('labels.Special Product')); ?></strong><br>
                                                            <strong><?php echo e(trans('labels.SpecialPrice')); ?>: </strong>  <?php echo e($product->specials_products_price); ?><br>

                                                            <?php if(($product->specials_id) !== null): ?>
                                                                <?php  $mytime = Carbon\Carbon::now()  ?>
                                                                <strong><?php echo e(trans('labels.ExpiryDate')); ?>: </strong>
                                                                <?php if($product->expires_date > $mytime->toDateTimeString()): ?>
                                                                    <?php echo e(date('d-m-Y', $product->expires_date)); ?>

                                                                <?php else: ?>
                                                                    <strong class="badge bg-red"><?php echo e(trans('labels.Expired')); ?></strong>
                                                                <?php endif; ?>
                                                                <br>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($product->productupdate); ?>

                                                    </td>

                                                    <td>
                                                      <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="<?php echo e(url('admin/products/edit')); ?>/<?php echo e($product->products_id); ?>"><?php echo e(trans('labels.EditProduct')); ?></a>
                                                      </br>
                                                      <?php if($product->products_type==1): ?>
                                                          <a class="btn btn-info" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(url('admin/products/attach/attribute/display')); ?>/<?php echo e($product->products_id); ?>"><?php echo e(trans('labels.ProductAttributes')); ?></a>

                                                          </br>
                                                      <?php endif; ?>
                                                      <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(url('admin/products/images/display/'. $product->products_id)); ?>"><?php echo e(trans('labels.ProductImages')); ?></a>
                                                      </br>
                                                      <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="<?php echo e($product->products_id); ?>"><?php echo e(trans('labels.DeleteProduct')); ?></a>
                                                      </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                                <div class="col-xs-12" style="background: #eee;">


                                  <?php
                                    if($results['products']->total()>0){
                                      $fromrecord = ($results['products']->currentpage()-1)*$results['products']->perpage()+1;
                                    }else{
                                      $fromrecord = 0;
                                    }
                                    if($results['products']->total() < $results['products']->currentpage()*$results['products']->perpage()){
                                      $torecord = $results['products']->total();
                                    }else{
                                      $torecord = $results['products']->currentpage()*$results['products']->perpage();
                                    }

                                  ?>
                                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                                    <div>Showing <?php echo e($fromrecord); ?> to <?php echo e($torecord); ?>

                                        of  <?php echo e($results['products']->total()); ?> entries
                                    </div>
                                  </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php echo e($results['products']->links()); ?>

                                </div>
                              </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- deleteProductModal -->
            <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteProductModalLabel"><?php echo e(trans('labels.DeleteProduct')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/products/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteThisProductDiloge')); ?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteProduct"><?php echo e(trans('labels.DeleteProduct')); ?></button>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/products/index.blade.php ENDPATH**/ ?>