<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            
            <li class="treeview <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>">
                    <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
                </a>
            </li>

            <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.media')); ?></span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(url('admin/media/add')); ?>">

                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> <?php echo e(trans('labels.media')); ?> </span>
                            </a>
                        </li>

                        <li class="treeview <?php echo e(Request::is('admin/media/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addimages') ? 'active' : ''); ?> <?php echo e(Request::is('admin/uploadimage/*') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(url('admin/media/display')); ?>">

                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> <?php echo e(trans('labels.Media Setings')); ?> </span>
                            </a>
                        </li>
                    </ul>
                </li>

            <?php endif; ?>

            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->general_setting_view == 1): ?>

                <li class="treeview <?php echo e(Request::is('admin/currencies/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/filter') ? 'active' : ''); ?>">
                    <a href="<?php echo e(URL::to('admin/currencies/display')); ?>">
                        <i class="fa fa-circle-o"></i> <?php echo e(trans('labels.currency')); ?>

                    </a>
                </li>
            <?php endif; ?>

            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->customers_view == 1): ?>

                <li class="treeview <?php echo e(Request::is('admin/customers/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/address/display/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/filter') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(URL::to('admin/customers/display')); ?>">
                        <i class="fa fa-users" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_customers')); ?></span>
                    </a>
                </li>
            <?php endif; ?>



            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->products_view == 1
or $result['commonContent']['roles'] != null and $result['commonContent']['roles']->categories_view == 1 ): ?>
                <li class="treeview <?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Catalog')); ?></span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manufacturer_view == 1): ?>
                            <li class="<?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/manufacturers/display')); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manufacturer')); ?></a></li>
                        <?php endif; ?>
                        <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1): ?>
                            <li class="<?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/categories/display')); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_main_categories')); ?></a></li>
                        <?php endif; ?>

                        <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1): ?>
                            <li class="<?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/products/attributes/display' )); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans('labels.products_attributes')); ?></a></li>
                            
                            
                            
                            <li class="<?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/products/display')); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
                            <li class="<?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(URL::to('admin/products/inventory/display')); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
                            
                            
                            
                        <?php endif; ?>
                        <?php
                        $status_check = DB::table('reviews')->where('reviews_read', 0)->first();
                        ?>
                        <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->reviews_view == 1): ?>

                            <li class="<?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/reviews/display')); ?>">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span><?php echo e(trans('labels.reviews')); ?></span><?php if($result['commonContent']['new_reviews']>0): ?>
                                        <span
                                            class="label label-success pull-left"><?php echo e($result['commonContent']['new_reviews']); ?> <?php echo e(trans('labels.new')); ?></span><?php endif; ?>
                                </a>
                            </li>
                            <li class="<?php echo e(Request::is('admin/product_questions/display') ? 'active' : ''); ?>">
                                <a href="<?php echo e(URL::to('admin/product_questions/display')); ?>">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span><?php echo e(trans('labels.product_questions')); ?></span><?php if($result['commonContent']['new_product_questions']>0): ?>
                                        <span
                                            class="label label-success pull-left"><?php echo e($result['commonContent']['new_product_questions']); ?> <?php echo e(trans('labels.new')); ?></span><?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->orders_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
                    <a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
                        <span> <?php echo e(trans('labels.link_orders')); ?></span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(URL::to('admin/orderstatus')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_order_status')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(URL::to('admin/orders/display')); ?>">
                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> <?php echo e(trans('labels.link_orders')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->reports_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> <?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        <span><?php echo e(trans('labels.link_reports')); ?></span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?> "><a
                                href="<?php echo e(URL::to('admin/lowinstock')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_low_stock')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> "><a
                                href="<?php echo e(URL::to('admin/outofstock')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_out_of_stock_products')); ?></a>
                        </li>
                    <!-- <li class="<?php echo e(Request::is('admin/productsstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/stockin')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.stockin')); ?></a></li>-->
                        <li class="<?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> "><a
                                href="<?php echo e(URL::to('admin/statscustomers')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_customer_orders_total')); ?></a>
                        </li>
                        <li class="<?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/statsproductspurchased')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_total_purchased')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/statsproductsliked')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_liked')); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>



            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->tax_location_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/countries/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span><?php echo e(trans('labels.link_tax_location')); ?></span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        
                        
                        
                        
                        <li class="<?php echo e(Request::is('admin/zones/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/edit/*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(URL::to('admin/zones/display')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_zones')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(URL::to('admin/tax/taxclass/display')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_class')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(URL::to('admin/tax/taxrates/display')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_rates')); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->coupons_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/coupons/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editcoupons/*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(URL::to('admin/coupons/display')); ?>"><i class="fa fa-tablet" aria-hidden="true"></i>
                        <span><?php echo e(trans('labels.link_coupons')); ?></span></a>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shipping_methods_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/shippingmethods/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/flateRate/display') ? 'active' : ''); ?>">
                    <a href="#">
                        
                        <i class="fa fa-truck"
                           aria-hidden="true"></i>
                        <span> <?php echo e(trans('labels.link_shipping_methods')); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->payment_methods_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/paymentmethods/index') ? 'active' : ''); ?> <?php echo e(Request::is('admin/paymentmethods/display/*') ? 'active' : ''); ?>">
                    <a href="#">
                        
                        <i class="fa fa-credit-card"
                           aria-hidden="true"></i> <span>
              <?php echo e(trans('labels.link_payment_methods')); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->notifications_view == 1): ?>
                <li class="treeview <?php echo e(Request::is('admin/pushnotification') ? 'active' : ''); ?><?php echo e(Request::is('admin/devices/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/viewdevices/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/notifications') ? 'active' : ''); ?>">
                    <a href="#">
                        
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span><?php echo e(trans('labels.link_notifications')); ?></span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="<?php echo e(Request::is('admin/pushnotification') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/pushnotification')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_setting')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/devices/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/viewdevices/*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(URL::to('admin/devices/display')); ?>"><i
                                    class="fa fa-circle-o"></i><?php echo e(trans('labels.link_devices')); ?> </a>
                        </li>
                        <li class="<?php echo e(Request::is('admin/devices/notifications') ? 'active' : ''); ?> ">
                            <a href="<?php echo e(URL::to('admin/devices/notifications')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_send_notifications')); ?></a>
                        </li>
                    </ul>

                </li>
            <?php endif; ?>

            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->general_setting_view == 1): ?>

                <li class="treeview <?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/setting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/alertsetting') ? 'active' : ''); ?>  ">
                    <a href="#">
                        <i class="fa fa-gears" aria-hidden="true"></i>
                        <span> <?php echo e(trans('labels.link_general_settings')); ?></span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">

                        <li class="<?php echo e(Request::is('admin/setting') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/setting')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_store_setting')); ?></a></li>
                        
                        
                        
                        
                        <li class="<?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/googlesettings')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_google')); ?></a></li>

                        
                        
                        


                    </ul>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->manage_admins_view == 1): ?>

                <li class="treeview <?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span> <?php echo e(trans('labels.Manage Admins')); ?></span> <i class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="<?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(URL::to('admin/admins')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_admins')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manage_roles')); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_management == 1): ?>

            <!--------create middlewares -------->
                <li class="treeview  <?php echo e(Request::is('admin/managements/restore') ? 'active' : ''); ?> <?php echo e(Request::is('admin/managements/backup') ? 'active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-gears" aria-hidden="true"></i>
                        <span> <?php echo e(trans('labels.Backup / Restore')); ?></span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="<?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/managements/backup')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.backup')); ?></a></li>
                        <li class="<?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?>"><a
                                href="<?php echo e(URL::to('admin/managements/import')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans('labels.restore')); ?></a></li>

                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<?php /**PATH F:\sites\mysan\resources\views/admin/common/sidebar.blade.php ENDPATH**/ ?>