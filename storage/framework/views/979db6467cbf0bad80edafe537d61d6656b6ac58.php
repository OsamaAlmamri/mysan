<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.Theme Setting')); ?>

          <?php if($data['section_id'] == 1): ?>
          <small>Home Page...</small>
          <?php elseif($data['section_id'] == 2): ?>
          <small>Cart Page Settings...</small>
          <?php elseif($data['section_id'] == 3): ?>
          <small>Blog Page Settings...</small>
          <?php elseif($data['section_id'] == 4): ?>
          <small>Detail Page Settings...</small>
          <?php elseif($data['section_id'] == 5): ?>
          <small>Shop Page Settings...</small>
          <?php elseif($data['section_id'] == 7): ?>
            <small>Colors Settings</small>
          
          <?php elseif($data['section_id'] == 8): ?>
          <small><?php echo app('translator')->get('labels.Login Page Settings'); ?> </small>
          <?php elseif($data['section_id'] == 9): ?>
          <small><?php echo app('translator')->get('labels.News Page Settings'); ?> </small>
          <?php elseif($data['section_id'] == 10): ?>
          <small><?php echo app('translator')->get('labels.Banner Transition Settings'); ?> </small>
                        
                       
          <?php else: ?>
          <small>Contact Page Settings...</small>
          <?php endif; ?>

          </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li ><?php echo e(trans('labels.link_site_settings')); ?></li>
            <li ><?php echo e(trans('labels.Theme Setting')); ?></li>
            <?php if($data['section_id'] == 1): ?>
            <li class="active">Home Page</li>
            <?php elseif($data['section_id'] == 2): ?>
            <li class="active">Cart Page Settings</li>
            <?php elseif($data['section_id'] == 3): ?>
            <li class="active">Blog Page Settings</li>
            <?php elseif($data['section_id'] == 4): ?>
            <li class="active">Detail Page Settings</li>
            <?php elseif($data['section_id'] == 5): ?>
            <li class="active">Shop Page Settings</li>
            <?php elseif($data['section_id'] == 6): ?>
            <li class="active">Shop Page Settings</li>
            <?php elseif($data['section_id'] == 7): ?>
            <li class="active">Colors Settings</li>
            <?php elseif($data['section_id'] == 8): ?>
            <li class="active"><?php echo app('translator')->get('labels.Login Page Settings'); ?> </li>
            <?php elseif($data['section_id'] == 9): ?>
            <li class="active"><?php echo app('translator')->get('labels.News Page Settings'); ?> </li>            
            <?php elseif($data['section_id'] == 10): ?>
              <li class="active"><?php echo app('translator')->get('labels.Banner Transition Settings'); ?> </li>
            <?php endif; ?>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="box-shadow:none;">

        <div class="row">
          <div class="col-md-2">
          </div>
            <div class="col-md-8">
                    <div class="box-header">
                        <?php if($data['section_id'] == 1): ?>
                        <h3 class="box-title">Home Page Settings </h3>
                        <?php elseif($data['section_id'] == 2): ?>
                        <h3 class="box-title">Cart Page Settings </h3>
                        <?php elseif($data['section_id'] == 3): ?>
                        <h3 class="box-title">Blog Page Settings </h3>
                        <?php elseif($data['section_id'] == 4): ?>
                        <h3 class="box-title">Detail Page Settings </h3>
                        <?php elseif($data['section_id'] == 5): ?>
                        <h3 class="box-title">Shop Page Settings </h3>
                        <?php elseif($data['section_id'] == 6): ?>
                        <h3 class="box-title">Contact Page Settings</h3>
                        <?php elseif($data['section_id'] == 8): ?>
                        <h3 class="box-title"><?php echo app('translator')->get('labels.Login Page Settings'); ?> </h3>
                        <?php elseif($data['section_id'] == 9): ?>
                        <h3 class="box-title"><?php echo app('translator')->get('labels.News Page Settings'); ?> </h3>
                        <?php elseif($data['section_id'] == 10): ?>
                        <h3 class="box-title"><?php echo app('translator')->get('labels.Banner Transition Settings'); ?> </h3>
                        
                        <?php else: ?>
                        <h3 class="box-title">Colors Settings</h3>
                        <?php endif; ?>
                    </div>

                    <!-- /.box-header -->
                    <div id="app">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style="box-shadow: 2px 4px 21px lightgrey"class="box box-info">
                                    <?php if($data['section_id'] == 1): ?>

                                    <?php  $dataa = json_encode(array('data' =>$data,'current_theme' => $current_theme)); 
                                    ?>
                                    
                                    <theme-component :data="<?php echo e($dataa); ?>"></theme-component>
                                    <?php endif; ?>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <?php if( count($errors) > 0): ?>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="alert alert-success" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                    <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                                    <?php echo e($error); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php echo Form::open(array('url' =>'admin/theme/setting/setPages', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                        <input type="hidden" name="page" value="<?php echo e($data['section_id']); ?>" />

                                      <?php if($data['section_id'] == 2): ?>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.cart')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" onchange="showCartImage();" id="cart_id" name="cart_id">
                                                      <?php $__currentLoopData = $data['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php  if($cart['id'] == $current_theme->cart){ ?>
                                                          <option selected value="<?php echo e($cart['id']); ?>"><?php echo e($cart['name']); ?></option>
                                                        <?php }else{ ?>
                                                          <option value="<?php echo e($cart['id']); ?>"><?php echo e($cart['name']); ?></option>
                                                        <?php } ?>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.cart')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    <img id="cart_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/cart1.png')); ?>" />
                                                    <img id="cart_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/cart2.png')); ?>" />

                                                </div>
                                            </div>

                                      <?php endif; ?>
                                      <?php if($data['section_id'] == 3): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.news')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" name="news_id">
                                                  <?php $__currentLoopData = $data['blog']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($news['id'] == $current_theme->news){ ?>
                                                      <option selected value="<?php echo e($news['id']); ?>"><?php echo e($news['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($news['id']); ?>"><?php echo e($news['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.news')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                      <?php endif; ?>
                                        <?php if($data['section_id'] == 4): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.detail')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" onchange="showDetailImage();" id="detail_id" name="detail_id">
                                                  <?php $__currentLoopData = $data['detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($detail['id'] == $current_theme->detail){ ?>
                                                      <option selected value="<?php echo e($detail['id']); ?>"><?php echo e($detail['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($detail['id']); ?>"><?php echo e($detail['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.detail')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="detail_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail1.png')); ?>" />
                                                <img id="detail_image2" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail2.png')); ?>" />
                                                <img id="detail_image3" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail3.png')); ?>" />
                                                <img id="detail_image4" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail4.png')); ?>" />
                                                <img id="detail_image5" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail5.png')); ?>" />
                                                <img id="detail_image6" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/detail6.png')); ?>" />

                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($data['section_id'] == 5): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.shop')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" onchange="showShopImage();" id="shop_id" name="shop_id">
                                                  <?php $__currentLoopData = $data['shop']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($shop['id'] == $current_theme->shop){ ?>
                                                      <option selected value="<?php echo e($shop['id']); ?>"><?php echo e($shop['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($shop['id']); ?>"><?php echo e($shop['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.shop')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="shop_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/shop1.png')); ?>" />
                                                <img id="shop_image2" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/shop2.png')); ?>" />
                                                <img id="shop_image3" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/shop3.png')); ?>" />
                                                <img id="shop_image4" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/shop4.png')); ?>" />
                                                <img id="shop_image5" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/shop5.png')); ?>" />

                                            </div>
                                        </div>
                                        <?php endif; ?>
                                          <?php if($data['section_id'] == 6): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.contact')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showContactImage();" id="contact_id" name="contact_id">
                                                  <?php $__currentLoopData = $data['contact']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($contact['id'] == $current_theme->contact){ ?>
                                                      <option selected value="<?php echo e($contact['id']); ?>"><?php echo e($contact['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($contact['id']); ?>"><?php echo e($contact['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.contact')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="contact_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/contact1.png')); ?>" />
                                                <img id="contact_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/contact2.png')); ?>" />
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($data['section_id'] == 7): ?>
                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Colors</label>
                                          <div class="col-sm-10 col-md-4">
                                            <select name="web_color_style" class="form-control">
                                                <option <?php if($data['settings'][81]->value == 'app'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app">Default</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.1'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.1"> <?php echo app('translator')->get('labels.app_theme_2'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.2'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.2"> <?php echo app('translator')->get('labels.app_theme_3'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.3'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.3"> <?php echo app('translator')->get('labels.app_theme_4'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.4'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.4"> <?php echo app('translator')->get('labels.app_theme_5'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.5'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.5"> <?php echo app('translator')->get('labels.app_theme_6'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.6'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.6"> <?php echo app('translator')->get('labels.app_theme_7'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.7'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.7"> <?php echo app('translator')->get('labels.app_theme_8'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.8'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.8"> <?php echo app('translator')->get('labels.app_theme_9'); ?></option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.9'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.9"> Orange</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.10'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.10"> Cameo</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.11'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.11"> Americano</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.12'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.12"> Cranberry</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.13'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.13"> Pale Sky</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.14'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.14"> Sheen Green</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.15'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.15"> Cyan / Aqua</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.16'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.16"> Crete</option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.17'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.17"> Downy </option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.18'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.18"> Tonys Pink </option>
                                                <option <?php if($data['settings'][81]->value == 'app.theme.19'): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="app.theme.19"> Black </option>
                                                        
                                                        
                                            </select> 
                                          </div>
                                      </div>
                                      <?php endif; ?>

                                      <?php if($data['section_id'] == 8): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Login')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showLoginImage();" id="login_id" name="login_id">
                                                  <?php $__currentLoopData = $data['login']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $login): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($login['id'] == $current_theme->login){ ?>
                                                      <option selected value="<?php echo e($login['id']); ?>"><?php echo e($login['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($login['id']); ?>"><?php echo e($login['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.login')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="login_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/login1.png')); ?>" />
                                                <img id="login_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/login2.png')); ?>" />
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if($data['section_id'] == 9): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.News')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showNewsImage();" id="news_id" name="news_id">
                                                  <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($news['id'] == $current_theme->news){ ?>
                                                      <option selected value="<?php echo e($news['id']); ?>"><?php echo e($news['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($news['id']); ?>"><?php echo e($news['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.News')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="news_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/news1.png')); ?>" />
                                                <img id="news_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/news2.png')); ?>" />
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if($data['section_id'] == 10): ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Transition')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showTransitionImage();" id="transitions_id" name="transitions_id">
                                                  <?php $__currentLoopData = $data['transitions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php  if($transition['id'] == $current_theme->transitions){ ?>
                                                      <option selected value="<?php echo e($transition['id']); ?>"><?php echo e($transition['name']); ?></option>
                                                    <?php }else{ ?>
                                                      <option value="<?php echo e($transition['id']); ?>"><?php echo e($transition['name']); ?></option>
                                                    <?php } ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Transition')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                <img id="transition_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/transition1.png')); ?>" />
                                                <img id="transition_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/transition2.png')); ?>" />
                                                <img id="transition_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/transition3.png')); ?>" />
                                                <img id="transition_image2"  style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/transition4.png')); ?>" />
                                                <img id="transition_image1" style="display: none" width="350px;" src="<?php echo e(asset('images/prototypes/transition5.png')); ?>" />
                                            </div>
                                        </div>
                                        <?php endif; ?>                                      

                                        

<!--
                                        <!-- /.box-body -->
                                        <?php if($data['section_id'] != 1): ?>
                                        <div class=" text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Apply')); ?> </button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($data['section_id'] == 1): ?>
                                        <div class=" text-center">
                                            <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back </a>
                                        </div>
                                        <?php endif; ?>
                                        <!-- /.box-footer -->
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
</div>
<script src="<?php echo e(asset('web/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/theme/index.blade.php ENDPATH**/ ?>