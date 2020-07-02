<?php $__env->startSection('content'); ?>
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Assign Categories')); ?> <small><?php echo e(trans('labels.Assign Categories')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/categoriesroles')); ?>"><i class="fa fa-bars"></i> <?php echo e(trans('labels.categoriesroles')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Assign Categories')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.Assign Categories')); ?> </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <!-- /.box-header -->
                        <br>                       
                        <?php if(session()->has('error')): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e(session()->get('error')); ?>

                            </div>
                          <?php endif; ?>
                          
                          <?php if(session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e(session()->get('success')); ?>

                            </div>
                          <?php endif; ?>
                        
                        <!-- form start -->                        
                         <div class="box-body">
                         
                            <?php echo Form::open(array('url' =>'admin/updatecategoriesroles', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                            <input type="hidden" name="categories_role_id" value="<?php echo e($result['data'][0]->categories_role_id); ?>">       
                             <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ChooseAdmin')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                  
                                      <select class="form-control field-validate" name="admin_id" disabled>
                                          <?php $__currentLoopData = $result['admins']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php if($result['data'][0]->admin_id==$admins->myid): ?> 
                                              <option value="<?php echo e($admins->myid); ?>"  ><?php echo e($admins->first_name); ?> <?php echo e($admins->last_name); ?></option>
                                              <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>      
                                                                                                               
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.ChooseAdminText')); ?>.</span>
                                      <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                              </div>
                                <?php
                                $cat_array = explode(',',$result['data'][0]->categories_ids);
                                ?>
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Categories')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                        <ul class="list-group list-group-root well">    
                                          <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                    
                                          <li href="#" class="list-group-item"><label style="width:100%"><input <?php if(in_array($categories->id,$cat_array)): ?> checked <?php endif; ?> id="categories_<?=$categories->id?>" type="checkbox" class=" required_one categories" name="categories[]" value="<?php echo e($categories->id); ?>" > <?php echo e($categories->name); ?></label></li>
                                              <?php if(!empty($categories->sub_categories)): ?>
                                              <ul class="list-group">
                                                    	<li class="list-group-item" >
                                                    <?php $__currentLoopData = $categories->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input type="checkbox" name="categories[]" class="required_one sub_categories sub_categories_<?=$categories->id?>" parents_id = '<?=$categories->id?>' value="<?php echo e($sub_category->sub_id); ?>" <?php if(in_array($sub_category->sub_id,$cat_array)): ?> checked <?php endif; ?>> <?php echo e($sub_category->sub_name); ?></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
                                                    
                                              </ul>
                                              <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                          
                                        </ul>                                          
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.ChooseCatgoryText')); ?>.</span>
                                      <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                  </div>
                                </div>
                                          
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Assign')); ?></button>
                                <a href="<?php echo e(URL::to('admin/categoriesroles')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\admins\roles\category\edit.blade.php ENDPATH**/ ?>