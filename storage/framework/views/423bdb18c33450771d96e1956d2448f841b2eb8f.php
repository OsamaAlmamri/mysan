<?php $__env->startSection('content'); ?>
<!-- wishlist Content -->
<section class="wishlist-content my-4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-3">
				<div class="heading">
						<h2>
								<?php echo app('translator')->get('website.My Account'); ?>
						</h2>
						<hr >
					</div>

				<ul class="list-group">
						<li class="list-group-item">
								<a class="nav-link" href="<?php echo e(URL::to('/profile')); ?>">
										<i class="fas fa-user"></i>
									<?php echo app('translator')->get('website.Profile'); ?>
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="<?php echo e(URL::to('/wishlist')); ?>">
										<i class="fas fa-heart"></i>
								 <?php echo app('translator')->get('website.Wishlist'); ?>
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="<?php echo e(URL::to('/orders')); ?>">
										<i class="fas fa-shopping-cart"></i>
									<?php echo app('translator')->get('website.Orders'); ?>
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="<?php echo e(URL::to('/shipping-address')); ?>">
										<i class="fas fa-map-marker-alt"></i>
								 <?php echo app('translator')->get('website.Shipping Address'); ?>
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="<?php echo e(URL::to('/logout')); ?>">
										<i class="fas fa-power-off"></i>
									<?php echo app('translator')->get('website.Logout'); ?>
								</a>
						</li>
					</ul>

			</div>
			<div class="col-12 col-lg-9 ">
					<div class="heading">
							<h2>
									<?php echo app('translator')->get('website.Wishlist'); ?>
							</h2>
							<hr >
						</div>

					<div class="col-12 media-main">
						<?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="product">
							<article>

								<div class="media">
									<img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
									<div class="media-body">
									  <div class="row">
										<div class="col-12 col-md-8  texting">
										  <h3 class="title"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h3>
										  <?php												

										  if(!empty($products->discount_price)){
											  $discount_price = $products->discount_price * session('currency_value');
										  }
										  $orignal_price = $products->products_price * session('currency_value');
											  if(!empty($products->discount_price)){

												  if(($orignal_price+0)>0){
											  $discounted_price = $orignal_price-$discount_price;
											  $discount_percentage = $discounted_price/$orignal_price*100;
											  }else{
												  $discount_percentage = 0;
												  $discounted_price = 0;
										  }
										}
									   ?>

  
										  <div class="price"> <?php echo app('translator')->get('website.Total Price'); ?>: 
											<?php if(!empty($products->discount_price)): ?>
												<span><?php echo e(Session::get('symbol_left')); ?>&nbsp;<?php echo e($discount_price+0); ?>&nbsp;<?php echo e(Session::get('symbol_right')); ?></span>
												<del> <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></del>
												<?php else: ?>
												<span><?php echo e(Session::get('symbol_left')); ?>&nbsp;<?php echo e($orignal_price+0); ?>&nbsp;<?php echo e(Session::get('symbol_right')); ?></span>
												<?php endif; ?> 
										   </div>
										  <div class="wishlist-discription">
											<?=stripslashes($products->products_description)?>
										  </div>
										 
										  <div class="buttons">
											<?php if($products->products_type==0): ?>
											<?php if(!in_array($products->products_id,$result['cartArray'])): ?>
												<?php if($products->defaultStock==0): ?>

													<button type="button" class="btn  btn-danger swipe-to-top" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
												<?php elseif($products->products_min_order>1): ?>
												<a class="btn  btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
												<?php else: ?>
													<button type="button" class="btn  btn-secondary cart swipe-to-top" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
												<?php endif; ?>
												<?php else: ?>
													<button type="button" class="btn btn-secondary active swipe-to-top"><?php echo app('translator')->get('website.Added'); ?></button>
												<?php endif; ?>
											<?php elseif($products->products_type==1): ?>
												<a class="btn  btn-secondary swipe-to-top" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
											<?php elseif($products->products_type==2): ?>
												<a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn  btn-secondary swipe-to-top"><?php echo app('translator')->get('website.External Link'); ?></a>
											<?php endif; ?>
										  </div>
										</div>
										<div class="col-12 col-md-4 detail">
										  <div class="share"><a href="<?php echo e(URL::to("/UnlikeMyProduct")); ?>/<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Remove'); ?> &nbsp;<i class="fas fa-trash-alt"></i></a> </div>
										</div>
										</div>
									</div>									
								</div>								
							</article>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<hr class="border-line">

				<!-- ............the end..... -->
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/wishlist.blade.php ENDPATH**/ ?>