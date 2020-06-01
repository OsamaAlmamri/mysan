<!-- contact Content -->

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.Contact Us'); ?></li>
          </ol>
      </div>
    </nav>
</div> 

<section class="pro-content">
        
  <div class="container">
    <div class="page-heading-title">
        <h2> <?php echo app('translator')->get('website.Contact Us'); ?> 
        </h2>
     
        </div>
</div>

<section class="contact-content">
  <div class="container"> 
    <div class="row">
      <div class="col-12 col-sm-12">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="form-start">
                  
                  <?php if(session()->has('success') ): ?>
                     <div class="alert alert-success">
                         <?php echo e(session()->get('success')); ?>

                     </div>
                  <?php endif; ?>

                  <form enctype="multipart/form-data" action="<?php echo e(URL::to('/processContactUs')); ?>" method="post">
                    <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden">
                      <label class="first-label" for="email"><?php echo app('translator')->get('website.Full Name'); ?></label>
                      <div class="input-group"> 
                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo app('translator')->get('website.Please enter your name'); ?>" aria-describedby="inputGroupPrepend" required>
                        <div class="help-block error-content invalid-feedback" hidden><?php echo app('translator')->get('website.Please enter your name'); ?></div>
                      
                      </div>
                      <label for="email"><?php echo app('translator')->get('website.Email'); ?></label>
                      <div class="input-group">                     
                          <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="Enter Email here.." aria-describedby="inputGroupPrepend" required>
                          <div class="help-block error-content invalid-feedback" hidden><?php echo app('translator')->get('website.Please enter your valid email address'); ?></div>
                      </div>  
                      <label for="email"><?php echo app('translator')->get('website.Message'); ?></label>
                      <textarea type="text" name="message"  placeholder="write your message here..." rows="5" cols="56"></textarea>
                      <div class="help-block error-content invalid-feedback" hidden><?php echo app('translator')->get('website.Please enter your message'); ?></div>

                      <button type="submit" class="btn btn-secondary swipe-to-top"><?php echo app('translator')->get('website.Submit'); ?> <i class="fas fa-location-arrow"></i>                 
                     
                    </form>
                </div>
          </div>     
        
          <div class="col-12 col-lg-5">
                <div id="map" style="height:400px; margin-top: 5px;">
                  
                </div>
                <script>
                  var map;
                  function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                      center: {lat: -34.397, lng: 150.644},
                      zoom: 8
                    });
                  }
                </script>
                <?php if($result['commonContent']['setting'][62]->value): ?>
                <script src="https://maps.googleapis.com/maps/api/js?key=".<?php echo e($result['commonContent']['setting'][62]->value); ?>."&callback=initMap"
                async defer></script>
                 <?php endif; ?>
                <p class="info">
                    <?php echo app('translator')->get('website.Contact us text'); ?>
                </p>
          </div> 
          <div class="col-12 col-lg-3">
             
              <div class="">
                  <ul class="contact-info pl-0 mb-0"  >
                      <li> <i class="fas fa-mobile-alt"></i><span><a href="#"><?php echo e($result['commonContent']['setting'][11]->value); ?></a></span> </li>
                      <li> <i class="fas fa-map-marker"></i><span><a href="#"><?php echo app('translator')->get('website.Ecommerce'); ?><br><?php echo app('translator')->get('website.Demo Store 3654123'); ?></a></span> </li>
                      <li> <i class="fas fa-envelope"></i><span> <a href="mailto:<?php echo e($result['commonContent']['setting'][3]->value); ?>"><?php echo e($result['commonContent']['setting'][3]->value); ?></a> </span> </li>
                      <li> <i class="fas fa-tty"></i><span> <a href="#"><?php echo e($result['commonContent']['setting'][11]->value); ?></a> </span> </li>
                 
                    </ul>         
                </div>
        
          </div>
        
        </div>
      </div>
    </div>
    
  </div>      
</section>

</section><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/contacts/contact1.blade.php ENDPATH**/ ?>