<?php $__env->startSection('content'); ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/profile')); ?>"><?php echo app('translator')->get('website.Profile'); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.Change Password'); ?></li>
      </ol>
    </div>
  </nav>
</div> 

<!-- page Content -->
<section class="page-area pro-content">
  <div class="container"> 
      <div class="row justify-content-center">
         
      
        <div class="col-12 col-sm-12 col-md-6">
            
          <div class="col-12 my-5">
              
             <h5><?php echo app('translator')->get('website.Change Password'); ?></h5>
             

             <hr style="margin-bottom: 0;">
                <div class="tab-content" id="registerTabContent">
                  <?php if(session()->has('success') ): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session()->get('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <?php endif; ?>

                  <?php if(session()->has('error') ): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session()->get('error')); ?>

                    </div>
                  <?php endif; ?>              

                
                  
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                      <div class="registration-process">
                      <form name="updateMyPassword" id="updateMyPassword" enctype="multipart/form-data" action="<?php echo e(URL::to('/updateMyPassword')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="from-group mb-3">
                          <div class="col-12"> <label for="current_password"><?php echo app('translator')->get('website.Current Password'); ?></label></div>
                          <div class="input-group col-12">                          
                            <input name="current_password" type="password" class="form-control" id="current_password" placeholder="<?php echo app('translator')->get('website.Current Password'); ?>">
                            <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter current password'); ?></span>
                          </div>
                        </div>
                        
                        <div class="from-group mb-3">
                          <div class="col-12"> <label for="password"><?php echo app('translator')->get('website.New Password'); ?></label></div>
                          <div class="input-group col-12">                             
                            <input name="new_password" type="password" class="form-control" id="new_password" placeholder="<?php echo app('translator')->get('website.New Password'); ?>">
                            <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your password and should be at least 6 characters long'); ?></span>
                          </div>
                        </div>

                        <div class="from-group mb-3">
                          <div class="col-12"> <label for="confirm_password"><?php echo app('translator')->get('website.Confirm Password'); ?></label></div>
                          <div class="input-group col-12">                             
                            <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="<?php echo app('translator')->get('website.New Password'); ?>">
                            <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your password and should be at least 6 characters long'); ?></span>
                          </div>
                        </div>

                        <div class="alert alert-danger fade show" hidden id="passowrd-error" role="alert">
                        </div>

                          <div class="col-12 col-sm-12">
                              <button type="submit" class="btn btn-secondary"><?php echo app('translator')->get('website.Update'); ?></button>                            
                          </div>
                      </form>
                      </div>
                      
                  </div>
                </div>
          </div>
        </div>

      </div>
  </div>
</section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/changepassword.blade.php ENDPATH**/ ?>