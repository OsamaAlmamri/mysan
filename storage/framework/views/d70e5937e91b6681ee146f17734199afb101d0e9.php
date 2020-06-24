<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!--->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.AdminProfile')); ?> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.AdminProfile')); ?> </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab"><?php echo e(trans('labels.Profile')); ?></a></li>
              <li><a href="#passwordDiv" data-toggle="tab"><?php echo e(trans('labels.Password')); ?></a></li>
            </ul>
            <div class="tab-content">
              <div class=" active tab-pane" id="profile">

            	  <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>
                <!-- The timeline -->
                   <?php echo Form::open(array('url' =>'admin/admin/update', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                      <?php echo Form::hidden('myid', auth()->user()->myid, array('class'=>'form-control', 'id'=>'myid')); ?>


                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><?php echo e(trans('labels.AdminFirstName')); ?></label>
                        <div class="col-sm-10">
                          <?php echo Form::text('first_name', Auth()->user()->first_name, array('class'=>'form-control', 'id'=>'first_name')); ?>

                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                          <?php echo e(trans('labels.AdminFirstNameText')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label"><?php echo e(trans('labels.LastName')); ?></label>

                        <div class="col-sm-10">
                          <?php echo Form::text('last_name', auth()->user()->last_name, array('class'=>'form-control', 'id'=>'last_name')); ?>

                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                          <?php echo e(trans('labels.AdminLastNameText')); ?></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label"><?php echo e(trans('labels.Address')); ?> </label>
                        <div class="col-sm-10">
                          <?php echo Form::text('address', $result['admin']->entry_street_address, array('class'=>'form-control', 'id'=>'address')); ?>

                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                          <?php echo e(trans('labels.AddressText')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label"><?php echo e(trans('labels.City')); ?>

                        </label>

                        <div class="col-sm-10">
                         <?php echo Form::text('city', $result['admin']->entry_city, array('class'=>'form-control', 'id'=>'city')); ?>

                         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CityText')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label"><?php echo e(trans('labels.Country')); ?></label>
    					           <div class="col-sm-10">
                            <select class="form-control" name="country" id="entry_country_id">
                            	<option value=""><?php echo e(trans('labels.SelectCountry')); ?></option>
                            	<?php $__currentLoopData = $result['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            		<option <?php if($result['admin']->entry_country_id==$countries->countries_id): ?> selected <?php endif; ?> value="<?php echo e($countries->countries_id); ?>"><?php echo e($countries->countries_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CountryText')); ?></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label"><?php echo e(trans('labels.State')); ?></label>
    					             <div class="col-sm-10">
                           <select class="form-control zoneContent" name="state">
                            	<option value=""><?php echo e(trans('labels.SelectZone')); ?></option>
                            	<?php $__currentLoopData = $result['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            		<option <?php if($result['admin']->entry_state==$zones->zone_id): ?> selected <?php endif; ?> value="<?php echo e($zones->zone_id); ?>"><?php echo e($zones->zone_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.SelectZoneText')); ?></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label"><?php echo e(trans('labels.Phone')); ?></label>

                        <div class="col-sm-10">
                         <?php echo Form::text('phone', auth()->user()->phone, array('class'=>'form-control', 'id'=>'phone')); ?>

                         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                         <?php echo e(trans('labels.PhoneText')); ?></span>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success"><?php echo e(trans('labels.Submit')); ?></button>
                        </div>
                      </div>
                    <?php echo Form::close(); ?>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="passwordDiv">
                 <?php echo Form::open(array('url' =>'admin/admin/updatepassword', 'onSubmit'=>'return validatePasswordForm()', 'id'=>'updateAdminPassword', 'name'=>'updateAdminPassword' , 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>


                  <div class="form-group form-group-email">
                    <label for="email" class="col-sm-2 control-label"><?php echo e(trans('labels.Email')); ?></label>
					          <div class="col-sm-10">
                      <input type="text" class="form-control" id="email" value="<?php echo e($result['admin']->email); ?>" name="email" placeholder="email">
                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AdminPasswordRestriction')); ?></span>
                      <span style="display: none" class="help-block"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label"><?php echo e(trans('labels.NewPassword')); ?></label>
					          <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AdminPasswordRestriction')); ?></span>
                      <span style="display: none" class="help-block"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="re-password" class="col-sm-2 control-label"><?php echo e(trans('labels.Re-EnterPassword')); ?></label>
					          <div class="col-sm-10">
                      <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Re-Enter Password">
                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AdminPasswordRestriction')); ?></span>
                      <span style="display: none" class="help-block"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger"><?php echo e(trans('labels.Submit')); ?></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/admin/profile.blade.php ENDPATH**/ ?>