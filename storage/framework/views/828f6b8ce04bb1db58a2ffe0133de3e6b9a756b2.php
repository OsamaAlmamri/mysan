<?php $__env->startSection('content'); ?>

<!-- checkout Content -->
<section class="checkout-area">

<?php if(session::get('paytm') == 'success'): ?>
<?php Session(['paytm' => 'sasa']); ?>
<script>
jQuery(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready
 jQuery("#update_cart_form").submit();
});

</script>
<?php endif; ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo app('translator')->get('website.Checkout'); ?></a></li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">
                <?php if(session('step')==0): ?>
                      <?php echo app('translator')->get('website.Shipping Address'); ?>
                    <?php elseif(session('step')==1): ?>
                      <?php echo app('translator')->get('website.Billing Address'); ?>
                    <?php elseif(session('step')==2): ?>
                      <?php echo app('translator')->get('website.Shipping Methods'); ?>
                    <?php elseif(session('step')==3): ?>
                      <?php echo app('translator')->get('website.Order Detail'); ?>
                    <?php endif; ?>
              </a>
            </li>
          </ol>
      </div>
    </nav>
</div> 
<section class="pro-content">

  <div class="container">
    <div class="page-heading-title">
      <h2> <?php echo app('translator')->get('website.Checkout'); ?> </h2>

      </div>
  </div>
 <!-- checkout Content -->
 <section class="checkout-area">
 <div class="container">
   <div class="row">
     <div class="col-12 col-xl-9 checkout-left">
       <input type="hidden" id="hyperpayresponse" value="<?php if(!empty(session('paymentResponse'))): ?> <?php if(session('paymentResponse')=='success'): ?> <?php echo e(session('paymentResponse')); ?> <?php else: ?> <?php echo e(session('paymentResponse')); ?>  <?php endif; ?> <?php endif; ?>">
       <div class="alert alert-danger alert-dismissible" id="paymentError" role="alert" style="display:none;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <?php if(!empty(session('paymentResponse')) and session('paymentResponse')=='error'): ?> <?php echo e(session('paymentResponseData')); ?> <?php endif; ?>
       </div>
         <div class="row">
           <div class="checkout-module">
             <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link <?php if(session('step')==0): ?> active <?php elseif(session('step')>0): ?>  <?php endif; ?>" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">
                    <span class="d-flex d-lg-none">1</span>
                    <span class="d-none d-lg-flex"><?php echo app('translator')->get('website.Shipping Address'); ?></span></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link <?php if(session('step')==1): ?> active <?php elseif(session('step')>1): ?> <?php endif; ?>" <?php if(session('step')>=1): ?> id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  <?php endif; ?> ><?php echo app('translator')->get('website.Billing Address'); ?></a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link <?php if(session('step')==2): ?> active <?php elseif(session('step')>2): ?>  <?php endif; ?>" <?php if(session('step')>=2): ?> id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" <?php endif; ?>> <?php echo app('translator')->get('website.Shipping Methods'); ?></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?php if(session('step')==3): ?> active <?php elseif(session('step')>3): ?> <?php endif; ?>"  <?php if(session('step')>=3): ?> id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"<?php endif; ?>><?php echo app('translator')->get('website.Order Detail'); ?></a>
                   </li>
               </ul>
               <ul class="nav nav-pills mb-3 checkoutd-nav d-flex d-lg-none" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link <?php if(session('step')==0): ?> active <?php elseif(session('step')>0): ?> active-check <?php endif; ?>" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">1</a>
                 </li>
                 <li class="nav-item second">
                   <a class="nav-link <?php if(session('step')==1): ?> active <?php elseif(session('step')>1): ?> active-check <?php endif; ?>" <?php if(session('step')>=1): ?> id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  <?php endif; ?> >2</a>
                 </li>
                 <li class="nav-item third">
                   <a class="nav-link <?php if(session('step')==2): ?> active <?php elseif(session('step')>2): ?> active-check <?php endif; ?>" <?php if(session('step')>=2): ?> id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" <?php endif; ?>>3</a>
                 </li>
                 <li class="nav-item fourth">
                   <a class="nav-link <?php if(session('step')==3): ?> active <?php elseif(session('step')>3): ?> active-check <?php endif; ?>"  <?php if(session('step')>=3): ?> id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"<?php endif; ?>>4</a>
                   </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade <?php if(session('step') == 0): ?> show active <?php endif; ?>" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                   <form name="signup" enctype="multipart/form-data" class="form-validate"  action="<?php echo e(URL::to('/checkout_shipping_address')); ?>" method="post">
                     <input type="hidden" required name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                     <div class="form-row">
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.First Name'); ?></label>
                        <input type="text"  required class="form-control field-validate" id="firstname" name="firstname" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->firstname); ?><?php endif; ?>" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your first name'); ?></span>
                      </div>
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.Last Name'); ?></label>
                        <input type="text" required class="form-control field-validate" id="lastname" name="lastname" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->lastname); ?><?php endif; ?>" aria-describedby="NameHelp1" placeholder="Enter Your Last Name">
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
                      </div>
                      
                      <?php if(Session::get('guest_checkout') == 1){ ?>
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.Email'); ?></label>
                        <input type="text" required class="form-control field-validate" id="email" name="email" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->email); ?><?php endif; ?>" aria-describedby="NameHelp1" placeholder="Enter Your Email">
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your email'); ?></span>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.Company'); ?></label>
                        <input type="text" required class="form-control field-validate" id="company" aria-describedby="companyHelp" placeholder="Enter Your Company Name" name="company" value="<?php if(!empty(session('shipping_address'))): ?> <?php echo e(session('shipping_address')->company); ?><?php endif; ?>">
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your company name'); ?></span>
                      </div>

                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.Address'); ?></label>
                        <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="<?php echo app('translator')->get('website.Please enter your address'); ?>" value="<?php if(!empty(session('shipping_address'))): ?> <?php echo e(session('shipping_address')->street); ?><?php endif; ?>">
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your address'); ?></span>
                      </div>
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.Country'); ?></label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                              <option value="" selected><?php echo app('translator')->get('website.Select Country'); ?></option>
                              <?php if(!empty($result['countries'])): ?>
                                <?php $__currentLoopData = $result['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($countries->countries_id); ?>" <?php if(!empty(session('shipping_address'))): ?> <?php if(session('shipping_address')->countries_id == $countries->countries_id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($countries->countries_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                              </select>
                        </div>
                        <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please select your country'); ?></span>
                      </div>
                      <div class="form-group">
                        <label for=""> <?php echo app('translator')->get('website.State'); ?></label>
                        <div class="input-group select-control">
                            <select required class="form-control field-validate" id="entry_zone_id"  name="zone_id" aria-describedby="stateHelp">
                              <option value=""><?php echo app('translator')->get('website.Select State'); ?></option>
                                <?php if(!empty($result['zones'])): ?>
                                <?php $__currentLoopData = $result['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($zones->zone_id); ?>" <?php if(!empty(session('shipping_address'))): ?> <?php if(session('shipping_address')->zone_id == $zones->zone_id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($zones->zone_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>

                                <option value="-1" <?php if(!empty(session('shipping_address'))): ?> <?php if(session('shipping_address')->zone_id == 'Other'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo app('translator')->get('website.Other'); ?></option>
                              </select>
                        </div>
                          <small id="stateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                          <label for=""> <?php echo app('translator')->get('website.City'); ?></label>
                            <input required type="text" class="form-control field-validate" id="city" name="city" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->city); ?><?php endif; ?>" placeholder="Enter Your City">
                            <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your city'); ?></span>
                        </div>
                        <div class="form-group">
                          <label for=""> <?php echo app('translator')->get('website.Zip/Postal Code'); ?></label>
                          <input required type="number" class="form-control" id="postcode" aria-describedby="zpcodeHelp" placeholder="<?php echo app('translator')->get('website.Enter Your Zip / Postal Code'); ?>" name="postcode" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->postcode); ?><?php endif; ?>">
                          <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your Zip/Postal Code'); ?></span>
                        </div>
                        <div class="form-group">
                          <label for=""> <?php echo app('translator')->get('website.Phone'); ?></label>
                          <input required type="text" class="form-control" id="delivery_phone" aria-describedby="numberHelp" placeholder="<?php echo app('translator')->get('website.Enter Your Phone Number'); ?>" name="delivery_phone" value="<?php if(!empty(session('shipping_address'))): ?><?php echo e(session('shipping_address')->delivery_phone); ?><?php endif; ?>">
                          <span style="color:red;" class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your valid phone number'); ?></span>
                        </div>
                                                
                      </div>
                      <div class="form-row">
                        <div class="form-group">
                          <button type="submit"  class="btn swipe-to-top btn-secondary"><?php echo app('translator')->get('website.Continue'); ?></button>
                        </div>
                      </div>
                   </form>
                 </div>
                 <div class="tab-pane fade <?php if(session('step') == 1): ?> show active <?php endif; ?>"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">
                     <form name="signup" enctype="multipart/form-data" action="<?php echo e(URL::to('/checkout_billing_address')); ?>" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                       <div class="form-row">
                         <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.First Name'); ?></label>
                             <input type="text" class="form-control same_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_firstname" name="billing_firstname" value="<?php if(!empty(session('billing_address'))): ?><?php echo e(session('billing_address')->billing_firstname); ?><?php endif; ?>" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your first name'); ?></span>
                           </div>
                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.Last Name'); ?></label>
                             <input type="text" class="form-control same_address" id="exampleInputName2" aria-describedby="NameHelp2" placeholder="Enter Your Name" <?php if(!empty(session('billing_address'))>0): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_lastname" name="billing_lastname" value="<?php if(!empty(session('billing_address'))>0): ?><?php echo e(session('billing_address')->billing_lastname); ?><?php endif; ?>">
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your last name'); ?></span>
                           </div>

                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.Company'); ?></label>
                             <input type="text" class="form-control same_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_company" name="billing_company" value="<?php if(!empty(session('billing_address'))): ?><?php echo e(session('billing_address')->billing_company); ?><?php endif; ?>" id="exampleInputCompany1" aria-describedby="companyHelp" placeholder="Enter Your Company Name">
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your company name'); ?></span>
                           </div>

                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.Address'); ?></label>
                             <input type="text" class="form-control same_address" id="exampleInputAddress1" aria-describedby="addressHelp" placeholder="Enter Your Address" <?php if(!empty(session('22'))>0): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_street" name="billing_street" value="<?php if(!empty(session('billing_address'))>0): ?><?php echo e(session('billing_address')->billing_street); ?><?php endif; ?>">
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your address'); ?></span>
                           </div>
                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.Country'); ?></label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> disabled <?php endif; ?> <?php else: ?> disabled <?php endif; ?>>
                                   <option value=""  ><?php echo app('translator')->get('website.Select Country'); ?></option>
                                   <?php if(!empty($result['countries'])): ?>
                                     <?php $__currentLoopData = $result['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($countries->countries_id); ?>" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->billing_countries_id == $countries->countries_id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($countries->countries_name); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please select your country'); ?></span>
                           </div>
                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.State'); ?></label>
                             <div class="input-group select-control">
                                 <select required class="form-control same_address_select" name="billing_zone_id" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> disabled <?php endif; ?> <?php else: ?> disabled <?php endif; ?> id="billing_zone_id" aria-describedby="stateHelp">
                                   <option value="" ><?php echo app('translator')->get('website.Select State'); ?></option>
                                   <?php if(!empty($result['zones'])): ?>
                                     <?php $__currentLoopData = $result['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$zones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($zones->zone_id); ?>" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->billing_zone_id == $zones->zone_id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($zones->zone_name); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>
                                     <option value="-1" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->billing_zone_id == 'Other'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo app('translator')->get('website.Other'); ?></option>
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please select your state'); ?></span>
                           </div>
                           <div class="form-group">
                            <label for=""> <?php echo app('translator')->get('website.City'); ?></label>
                               <input type="text" class="form-control same_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_city" name="billing_city" value="<?php if(!empty(session('billing_address'))): ?><?php echo e(session('billing_address')->billing_city); ?><?php endif; ?>" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your city'); ?></span>
                           </div>
                             <div class="form-group">
                              <label for=""> <?php echo app('translator')->get('website.Zip/Postal Code'); ?></label>
                               <input type="text" class="form-control same_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_zip" name="billing_zip" value="<?php if(!empty(session('billing_address'))): ?><?php echo e(session('billing_address')->billing_zip); ?><?php endif; ?>" aria-describedby="zpcodeHelp" placeholder="Enter Your Zip / Postal Code">
                               <small id="zpcodeHelp" class="form-text text-muted"></small>
                             </div>
                             <div class="form-group">
                              <label for=""> <?php echo app('translator')->get('website.Phone'); ?></label>
                               <input type="text" class="form-control same_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> readonly <?php endif; ?> <?php else: ?> readonly <?php endif; ?>  id="billing_phone" name="billing_phone" value="<?php if(!empty(session('billing_address'))): ?><?php echo e(session('billing_address')->billing_phone); ?><?php endif; ?>" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your valid phone number'); ?></span>
                             </div>
                            </div>
                             <div class="form-row">
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" <?php if(!empty(session('billing_address'))): ?> <?php if(session('billing_address')->same_billing_address==1): ?> checked <?php endif; ?> <?php else: ?> checked  <?php endif; ?> > <?php echo app('translator')->get('website.Same shipping and billing address'); ?>
                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>
                             </div>
                             <div class="form-row">
                              <div class="form-group">
                               <button type="submit"  class="btn swipe-to-top btn-secondary"><span><?php echo app('translator')->get('website.Continue'); ?></span></button>
                              </div>
                             </div>
                       </form>
                 </div>
                 <div class="tab-pane fade  <?php if(session('step') == 2): ?> show active <?php endif; ?>" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p><?php echo app('translator')->get('website.Please select a prefered shipping method to use on this order'); ?></p></div>
                             </div>

                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="<?php echo e(URL::to('/checkout_payment_method')); ?>">
                              <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                                <?php if(!empty($result['shipping_methods'])>0): ?>
                                    <input type="hidden" name="mehtod_name" id="mehtod_name">
                                    <input type="hidden" name="shipping_price" id="shipping_price">

                                     <?php $__currentLoopData = $result['shipping_methods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping_methods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="heading">
                                            <h2><?php echo e($shipping_methods['name']); ?></h2>
                                            <hr>
                                        </div>
                                        <div class="form-check">

                                            <div class="form-row">
                                                <?php if($shipping_methods['success']==1): ?>
                                                <ul class="list"style="list-style:none; padding: 0px;">
                                                    <?php $__currentLoopData = $shipping_methods['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php
                                                         if($services['shipping_method']=='upsShipping')
                                                            $method_name=$shipping_methods['name'].'('.$services['name'].')';
                                                         else{
                                                            $method_name=$services['name'];
                                                            }
                                                        ?>
                                                        <li>
                                                        <input class="shipping_data" id="<?php echo e($method_name); ?>" type="radio" name="shipping_method" value="<?php echo e($services['shipping_method']); ?>" shipping_price="<?php echo e($services['rate']); ?>"  method_name="<?php echo e($method_name); ?>" <?php if(!empty(session('shipping_detail')) and !empty(session('shipping_detail')) > 0): ?>
                                                        <?php if(session('shipping_detail')->mehtod_name == $method_name): ?> checked <?php endif; ?>
                                                        <?php elseif($shipping_methods['is_default']==1): ?> checked <?php endif; ?>
                                                        <?php if($shipping_methods['is_default']==1): ?> checked <?php endif; ?>
                                                        >
                                                       
                                                        
                                                         <label for="<?php echo e($method_name); ?>"><?php echo e($services['name']); ?> --- <?php echo e(Session::get('symbol_left')); ?><?php echo e($services['rate']* session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></label>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <?php else: ?>
                                                    <ul class="list"style="list-style:none; padding: 0px;">
                                                        <li><?php echo app('translator')->get('website.Your location does not support this'); ?> <?php echo e($shipping_methods['name']); ?>.</li>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo app('translator')->get('website.Please select your shipping method'); ?>
                                </div>

                                <div class="row">
                                  <div class="col-12 col-sm-12">
                                  <button type="submit"class="btn swipe-to-top btn-secondary"><?php echo app('translator')->get('website.Continue'); ?></button>
                                  </div>
                                </div>
                              </form>

                 </div>
                 <div class="tab-pane fade <?php if(session('step') == 3): ?> show active <?php endif; ?>" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">
                               <?php
                                   $price = 0;
                               ?>
                               <form method='POST' id="update_cart_form" action='<?php echo e(URL::to('/place_order')); ?>' >
                                 <?php echo csrf_field(); ?>


                                       <table class="table top-table">
                                           
                                           <?php $__currentLoopData = $result['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <?php
                                              $orignal_price = $products->final_price * session('currency_value');
                                              $price+= $orignal_price * $products->customers_basket_quantity;
                                           ?>

                                           <tbody>

                                            <tr class="d-flex">
                                              <td class="col-12 col-md-3" >
                                                <input type="hidden" name="cart[]" value="<?php echo e($products->customers_basket_id); ?>">
                                                <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="cart-thumb">
                                                    <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>" alt="">
                                                </a>
                                              </td>
                                              <td class="col-12 col-md-5 justify-content-start">
                                                  <div class="item-detail">
                                                      <span class="pro-info">
                                                        <?php $__currentLoopData = $products->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($category->categories_name); ?><?php if(++$key === count($products->categories)): ?> <?php else: ?>, <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                      </span>
                                                      <h5 class="pro-title">
                                                          
                                                        <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>">
                                                          <?php echo e($products->products_name); ?>

                                                        </a>
                                                       
                                                      </h5>
                                                      
                                                      <div class="item-attributes">
                                                        <?php if(isset($products->attributes)): ?>
                                                          <?php $__currentLoopData = $products->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <small><?php echo e($attributes->attribute_name); ?> : <?php echo e($attributes->attribute_value); ?></small>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                      </div>
                                                      <div class="item-controls">

                                                          <button  type="button" class="btn" >
                                                            <a  href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><span class="fas fa-pencil-alt"></span></a>
                                                        </button>
                                                        <button  type="button" class="btn" >
                                                            <a href="<?php echo e(URL::to('/deleteCart?id='.$products->customers_basket_id)); ?>"><span class="fas fa-times"></span></a>
                                                        </button>
                                                      </div>
                                                    </div>
                                                </td>
                                                <?php                                                      
                                                    $orignal_price = $products->final_price * session('currency_value');
                                                ?>
                                              <td class="item-price col-12 col-md-2"><span><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></span></td>
                                              <td class="col-12 col-md-1">
                                                  <div class="input-group item-quantity">                                                      
                                                    <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="<?php echo e($products->customers_basket_quantity); ?>">                    
                                                  </div>
                                              </td>
                                              <td class="align-middle item-total col-12 col-md-1 justify-content-end"><?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></td>
                                            </tr>

                                           </tbody>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </table>
                                                   <?php
                                                      if(!empty(session('coupon_discount'))){
                                                        $coupon_amount = session('currency_value') * session('coupon_discount');  
                                                      }else{
                                                        $coupon_amount = 0;
                                                      }

                                                      if(!empty(session('tax_rate'))){
                                                        $tax_rate = session('currency_value') * session('tax_rate');  
                                                      }else{
                                                        $tax_rate = 0;
                                                      }

                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                           $shipping_price = session('shipping_detail')->shipping_price;
                                                           $shipping_name = session('shipping_detail')->mehtod_name;
                                                       }else{
                                                           $shipping_price = 0;
                                                           $shipping_name = '';
                                                       }

                                                      // dd($price,$tax_rate,$shipping_price);
                                                       $tax_rate = number_format((float)$tax_rate, 2, '.', '');
                                                       $coupon_discount = number_format((float)$coupon_amount, 2, '.', '');
                                                       $total_price = ($price+$tax_rate+($shipping_price*session('currency_value')))-$coupon_discount;
                                                       session(['total_price'=>($total_price)]);

                                                    ?>
                               </form>

                               <div class="col-12 col-sm-12">
                                    <div class="row">
                                        <div class="heading">
                                            <h4><?php echo app('translator')->get('website.orderNotesandSummary'); ?></h4>
                                            
                                          </div>
                                      
                                      <div class="form-group" style="width:100%; padding:0;">
                                        <label for="exampleFormControlTextarea1"><?php echo app('translator')->get('website.Please write notes of your order'); ?></label>
                                          <textarea name="comments" id="exampleFormControlTextarea1"  class="form-control" id="order_comments" rows="3"><?php if(!empty(session('order_comments'))): ?><?php echo e(session('order_comments')); ?><?php endif; ?></textarea>
                                        </div>
                                    </div>
                                      
                                </div>

                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading">
                                           <h2><?php echo app('translator')->get('website.Payment Methods'); ?></h2>
                                           <hr>
                                         </div>

                                         <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo app('translator')->get('website.Please select your payment method'); ?>
                                         </div>

                                         
                                         <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="<?php echo e(URL::to('/order_detail')); ?>">
                                          <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                                      
                                         <div class="form-group" style="width:100%; padding:0;">
                                          <label for="exampleFormControlTextarea1" style="width:100%; margin-bottom:30px;"><?php echo app('translator')->get('website.Please select a prefered payment method to use on this order'); ?></label>
                                          
                                          <?php $__currentLoopData = $result['payment_methods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_methods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          
                                            <?php if($payment_methods['active']==1): ?>
                                                <input id="payment_currency" type="hidden" onClick="paymentMethods();" name="payment_currency" value="<?php echo e($payment_methods['payment_currency']); ?>">
                                              <?php if($payment_methods['payment_method']=='braintree'): ?>

                                                  <input id="<?php echo e($payment_methods['payment_method']); ?>_public_key" type="hidden" name="public_key" value="<?php echo e($payment_methods['public_key']); ?>">
                                                  <input id="<?php echo e($payment_methods['payment_method']); ?>_environment" type="hidden" name="<?php echo e($payment_methods['payment_method']); ?>_environment" value="<?php echo e($payment_methods['environment']); ?>">
                                          
                                          
                                                <div class="form-check form-check-inline">
                                                    <input id="<?php echo e($payment_methods['payment_method']); ?>_label" type="radio" onClick="paymentMethods();" name="payment_method" class="form-check-input payment_method" value="<?php echo e($payment_methods['payment_method']); ?>" <?php if(!empty(session('payment_method'))): ?> <?php if(session('payment_method')==$payment_methods['payment_method']): ?> checked <?php endif; ?> <?php endif; ?>>
                                                    <label class="form-check-label" for="<?php echo e($payment_methods['payment_method']); ?>_label"><img src="<?php echo e(asset('web/images/miscellaneous').'/'.$payment_methods['payment_method'].'.png'); ?>" alt="<?php echo e($payment_methods['name']); ?>"></label>
                                                </div>
                                              <?php else: ?>
                                                  <input id="<?php echo e($payment_methods['payment_method']); ?>_public_key" type="hidden" name="public_key" value="<?php echo e($payment_methods['public_key']); ?>">
                                                  <input id="<?php echo e($payment_methods['payment_method']); ?>_environment" type="hidden" name="<?php echo e($payment_methods['payment_method']); ?>_environment" value="<?php echo e($payment_methods['environment']); ?>">
                                                  <div class="form-check form-check-inline">
                                                    <input onClick="paymentMethods();" id="<?php echo e($payment_methods['payment_method']); ?>_label" type="radio" name="payment_method" class="form-check-input payment_method" value="<?php echo e($payment_methods['payment_method']); ?>" <?php if(!empty(session('payment_method'))): ?> <?php if(session('payment_method')==$payment_methods['payment_method']): ?> checked <?php endif; ?> <?php endif; ?>>
                                                    <label class="form-check-label" for="<?php echo e($payment_methods['payment_method']); ?>_label"><img width="100px" src="<?php echo e(asset('web/images/miscellaneous/').'/'.$payment_methods['payment_method'].'.png'); ?>" alt="<?php echo e($payment_methods['name']); ?>"></label>
                                                  </div>
                                              <?php endif; ?>  
                                            <?php endif; ?>

                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                                                 
                                        </div>
                                         </form>
                                          
                                           <div class="button">

                                                           <!--- paypal -->
                                                           <div id="paypal_button" class="payment_btns" style="display: none"></div>

                                                           <button id="braintree_button" style="display: none" class="btn btn-dark payment_btns" data-toggle="modal" data-target="#braintreeModel" ><?php echo app('translator')->get('website.Order Now'); ?></button>

                                                           <button id="stripe_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#stripeModel" ><?php echo app('translator')->get('website.Order Now'); ?></button>

                                                           <button id="cash_on_delivery_button" class="btn btn-dark payment_btns" style="display: none"><?php echo app('translator')->get('website.Order Now'); ?></button>
                                                           <button id="razor_pay_button" class="razorpay-payment-button btn btn-dark payment_btns"  style="display: none"  type="button"><?php echo app('translator')->get('website.Order Now'); ?></button>
                                                           <a href="<?php echo e(URL::to('/store_paytm')); ?>/<?php echo e($total_price); ?>" id="pay_tm_button" class="btn btn-dark payment_btns"  style="display: none"  type="button"><?php echo app('translator')->get('website.Order Now'); ?></a>

                                                           <button id="instamojo_button" class="btn btn-dark payment_btns" style="display: none" data-toggle="modal" data-target="#instamojoModel"><?php echo app('translator')->get('website.Order Now'); ?></button>

                                                           <a href="<?php echo e(URL::to('/checkout/hyperpay')); ?>" id="hyperpay_button" class="btn btn-dark payment_btns" style="display: none"><?php echo app('translator')->get('website.Order Now'); ?></a>

                                          </div>
                                       </div>
                                       <!-- The braintree Modal -->
                                       <div class="modal fade" id="braintreeModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="checkout" method="post" action="<?php echo e(URL::to('/place_order')); ?>">
                                                 <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title"><?php echo app('translator')->get('website.BrainTree Payment'); ?></h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body">
                                                         <div id="payment-form"></div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="submit" class="btn btn-dark"><?php echo app('translator')->get('website.Pay'); ?> <?php echo e(Session::get('symbol_left')); ?><?php echo e(number_format((float)$total_price+0, 2, '.', '')); ?><?php echo e(Session::get('symbol_right')); ?></button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The instamojo Modal -->
                                       <div class="modal fade" id="instamojoModel">
                                         <div class="modal-dialog">
                                           <div class="modal-content">
                                               <form id="instamojo_form" method="post" action="">
                                                 <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
                                                 <input type="hidden" name="amount" value="<?php echo e(number_format((float)$total_price+0, 2, '.', '')); ?>">
                                                   <!-- Modal Header -->
                                                   <div class="modal-header">
                                                       <h4 class="modal-title"><?php echo app('translator')->get('website.Instamojo Payment'); ?></h4>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                  <div class="modal-body">
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Full Name'); ?></label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="firstName" id="firstName" placeholder="<?php echo app('translator')->get('website.Full Name'); ?>" class="form-control">
                                    										<span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your full name'); ?></span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Email'); ?></label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="email_id" id="email_id" placeholder="<?php echo app('translator')->get('website.Email'); ?>" class="form-control">
                                    										<span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your email address'); ?></span>
                                    								 </div>
                                    								</div>
                                                    <div class="from-group mb-3">
                                    									<div class="col-12"> <label for="inlineFormInputGroup"><?php echo app('translator')->get('website.Phone Number'); ?></label></div>
                                    									<div class="input-group col-12">
                                    										<input type="text" name="phone_number" id="insta_phone_number" placeholder="<?php echo app('translator')->get('website.Phone Number'); ?>" class="form-control">
                                    										<span class="help-block error-content" hidden><?php echo app('translator')->get('website.Please enter your valid phone number'); ?></span>
                                    								 </div>
                                    								</div>

                                                        <div class="alert alert-danger alert-dismissible" id="insta_mojo_error" role="alert" style="display: none">
                                                           <span class="sr-only"><?php echo app('translator')->get('website.Error'); ?>:</span>
                                                           <span id="instamojo-error-text"></span>
                                                       </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" id="pay_instamojo" class="btn btn-dark"><?php echo app('translator')->get('website.Pay'); ?> <?php echo e($web_setting[19]->value); ?><?php echo e(number_format((float)$total_price+0, 2, '.', '')); ?></button>
                                                   </div>
                                               </form>
                                           </div>
                                          </div>
                                       </div>

                                       <!-- The stripe Modal -->
                                       <div class="modal fade" id="stripeModel">
                                           <div class="modal-dialog">
                                               <div class="modal-content">

                                               <main>
                                               <div class="container-lg">
                                                   <div class="cell example example2">
                                                       <form>
                                                         <div class="row">
                                                           <div class="field">
                                                             <div id="example2-card-number" class="input empty"></div>
                                                             <label for="example2-card-number" data-tid="elements_examples.form.card_number_label"><?php echo app('translator')->get('website.Card number'); ?></label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                         <div class="row">
                                                           <div class="field half-width">
                                                             <div id="example2-card-expiry" class="input empty"></div>
                                                             <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label"><?php echo app('translator')->get('website.Expiration'); ?></label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                           <div class="field half-width">
                                                             <div id="example2-card-cvc" class="input empty"></div>
                                                             <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label"><?php echo app('translator')->get('website.CVC'); ?></label>
                                                             <div class="baseline"></div>
                                                           </div>
                                                         </div>
                                                       <button type="submit" class="btn btn-dark" data-tid="elements_examples.form.pay_button"><?php echo app('translator')->get('website.Pay'); ?> <?php echo e($web_setting[19]->value); ?><?php echo e(number_format((float)$total_price+0, 2, '.', '')); ?></button>

                                                         <div class="error" role="alert"><svg xmlns="https://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                                             <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                                             <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                                           </svg>
                                                           <span class="message"></span></div>
                                                       </form>
                                                                   <div class="success">
                                                                     <div class="icon">
                                                                       <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                                         <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                                                         <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                                                       </svg>
                                                                     </div>
                                                                     <h3 class="title" data-tid="elements_examples.success.title"><?php echo app('translator')->get('website.Payment successful'); ?></h3>
                                                                     <p class="message"><span data-tid="elements_examples.success.message"><?php echo app('translator')->get('website.Thanks You Your payment has been processed successfully'); ?></p>
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </main>
                                                   </div>
                                             </div>
                                         </div>

                                   </div>

                 </div>
               </div>
         </div>
         </div>
     </div>
     
     <div class="col-12 col-xl-3 checkout-right cart-page-one cart-area">
      <table class="table right-table">
        <thead>
          <tr>
            <th scope="col" colspan="2" align="center"><?php echo app('translator')->get('website.Order Summary'); ?></th>                    
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row"><?php echo app('translator')->get('website.SubTotal'); ?></th>
            <td align="right"><?php echo e(Session::get('symbol_left')); ?><?php echo e($price+0); ?><?php echo e(Session::get('symbol_right')); ?></td>

          </tr>
          <tr>
            <th scope="row"><?php echo app('translator')->get('website.Discount'); ?></th>
            <td align="right"><?php echo e(Session::get('symbol_left')); ?><?php echo e(number_format((float)$coupon_discount, 2, '.', '')+0*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>

          </tr>
          <tr>
              <th scope="row"><?php echo app('translator')->get('website.Tax'); ?></th>
              <td align="right"><?php echo e(Session::get('symbol_left')); ?><?php echo e($tax_rate*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>

            </tr>
            <tr>
                <th scope="row"><?php echo app('translator')->get('website.Shipping Cost'); ?></th>
                <td align="right"><?php echo e(Session::get('symbol_left')); ?><?php echo e($shipping_price*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>

              </tr>
          <tr class="item-price">
            <th scope="row"><?php echo app('translator')->get('website.Total'); ?></th>
            <td align="right" ><?php echo e(Session::get('symbol_left')); ?><?php echo e(number_format((float)$total_price+0, 2, '.', '')+0*session('currency_value')); ?><?php echo e(Session::get('symbol_right')); ?></td>

          </tr>
      
        </tbody>
        
      </table>

       </div>
   </div>
 </div>
</section>
</section>

<script>
jQuery(document).on('click', '#cash_on_delivery_button', function(e){
	jQuery("#update_cart_form").submit();
});
</script>
<script>
    $('#rzp-footer-form').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
        return false;
    })
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        jQuery("#paymentDetail").removeAttr('style');
        jQuery('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        jQuery('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        jQuery.ajax({
            method: 'post',
            url: "<?php echo route('dopayment'); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
                jQuery("#update_cart_form").submit();
                console.log(r);
            }
        })
    }
</script>
<?php

if(!empty($result['payment_methods'][6]) and $result['payment_methods'][6]['active'] == 1){

$rezorpay_key =  $result['payment_methods'][6]['RAZORPAY_KEY'];

if(!empty($result['commonContent']['setting'][79]->value)){
  $name = $result['commonContent']['setting'][79]->value;
}else{
  $name = Lang::get('website.Ecommerce');
}

$logo = $result['commonContent']['setting'][15]->value;
 ?>
<script>
    var options = {
        key: "<?php echo e($rezorpay_key); ?>",
        amount: '<?php echo (float) round($total_price, 2)*100;?>',
        name: '<?php echo e($name); ?>',
        image: '<?php echo e($logo); ?>',
        handler: demoSuccessHandler
    }
</script>
<script>
    window.r = new Razorpay(options);
    document.getElementById('razor_pay_button').onclick = function () {
        r.open()
    }
</script>

<?php
}
?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/checkout.blade.php ENDPATH**/ ?>