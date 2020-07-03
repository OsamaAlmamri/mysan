
  <section class="pro-content pro-blog">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
            <div class="pro-heading-title">
                <h2> <?php echo app('translator')->get('website.From our News'); ?> 
                </h2>
                <p><?php echo app('translator')->get('website.From our News Text'); ?> 
                </p>
            </div>
          </div>
      </div>
    </div>
    <div class="general-product">
      <div class="container  p-0">
          <div class="blog-carousel-js">
             <?php $__currentLoopData = $result['news']['news_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

             <div class="">
							<div class="blog">
							  <div class="blog-thumbnail">
                    <span class="date-tag badge"><?php echo e(date('d-M-Y', strtotime($news_data->created_at))); ?></span>
                    <a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>">
                      <img class="img-thumbnail" src="<?php echo e(asset('').$news_data->image_path); ?>" width="100%" alt="<?php echo e($news_data->news_name); ?>">
                    </a>
                    <div class="over"></div>
							  </div>
							  <div class="blog-detial">
								  <span class="tag">
									 <?php echo e($news_data->categories_name); ?>                              
								  </span>
								  <h5><a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>">
									<?php echo e($news_data->news_name); ?></a>
								  </h5>
								
									  <div class="blog-description">
                      <p>
                      <?php
                        $descriptions = strip_tags($news_data->news_description);
                        echo stripslashes($descriptions);
                      ?>
                      </p>
									  </div>
									  <span class="blink"><a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>"> <?php echo app('translator')->get('website.Read More'); ?> .. </a></span>
							  </div>
							 
							</div>
						</div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              
              
          </div>  
      </div>
    </div>  
</section><?php /**PATH F:\sites\mysan\resources\views/web/product-sections/blog_section.blade.php ENDPATH**/ ?>