<?php $__env->startSection('content'); ?>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('website.News'); ?></li>
          </ol>
      </div>
    </nav>
</div>
<section class="pro-content">

  <div class="container">
    <div class="page-heading-title">
        <h2> <?php echo app('translator')->get('website.News'); ?> 
        </h2>
     
        </div>
</div>

<!-- Site Content -->
<section class="blog-content">
<div class="container">

 <div class="blog-area">

   <div class="row">
    <div class="col-12 col-lg-8">
      <div class="row">
    <div class="col-12 col-sm-12">
      <div class="blog-detail blog">
        <div class="blog-thumbnail">
          <span class="date-tag badge"><?php echo e(date('d-M-Y', strtotime($result['news'][0]->created_at))); ?></span>
          <img class="img-thumbnail" src="<?php echo e(asset('').$result['news'][0]->image); ?>" width="100%">          
        </div>
        
        <span class="tag">
          <?php echo e($result['news'][0]->categories_name); ?>                              
         </span>
        
        <h5 class="post-title">
          <a href="#">
          <?php echo e($result['news'][0]->news_name); ?></a>
        </h5>
        <div class="blog-title">
          <?php echo stripslashes($result['news'][0]->news_description); ?>
        </div>

        
         
      </div>
  </div>
  </div>
</div>

                     <div class="col-12 col-lg-4  d-lg-block d-xl-block blog-menu">
                       <div class="category-div">
                           <div class="heading">
                               <h2>
                                <?php echo app('translator')->get('website.Featured News'); ?>
                               </h2>
                               <hr style="margin-bottom: 0;">
                             </div>
                             <?php $__currentLoopData = $result['commonContent']['featuredNews']['news_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="media">
                                <div class="media-img">  
                                  <img src="<?php echo e(asset('').$news_data->image_path); ?>" alt="John Doe" width="100%">
                                  </div>
                                <div class="media-body">
                                <h5><a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>"><?php echo e($news_data->news_name); ?></a></h5>
                                  <div class="post-date">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo e(date('M d, Y', strtotime($news_data->created_at))); ?> 
                                  </div>
                                
                                </div>
                              </div>
                               	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </div>

                       <div class="category-div">
                       <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->                       
                     </div>
                   </div>
                 </div>
               </div>
             </div>
</section>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/news-detail.blade.php ENDPATH**/ ?>