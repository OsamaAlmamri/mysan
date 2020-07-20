<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {{--        <li class="header">{{ trans('labels.navigation') }}</li>--}}
            <li class="treeview {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/dashboard/this_month')}}">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('labels.header_dashboard') }}</span>
                </a>
            </li>

            @if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1)
                <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-picture-o"></i> <span>{{ trans('labels.media') }}</span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} ">
                            <a href="{{url('admin/media/add')}}">

                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> {{ trans('labels.media') }} </span>
                            </a>
                        </li>

                        <li class="treeview {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }} ">
                            <a href="{{url('admin/media/display')}}">

                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> {{ trans('labels.Media Setings') }} </span>
                            </a>
                        </li>
                    </ul>
                </li>

            @endif

            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->general_setting_view == 1)

                <li class="treeview {{ Request::is('admin/currencies/display') ? 'active' : '' }} {{ Request::is('admin/currencies/add') ? 'active' : '' }} {{ Request::is('admin/currencies/edit/*') ? 'active' : '' }} {{ Request::is('admin/currencies/filter') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/currencies/display')}}">
                        <i class="fa fa-circle-o"></i> {{ trans('labels.currency') }}
                    </a>
                </li>
            @endif

            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->customers_view == 1)

                <li class="treeview {{ Request::is('admin/customers/display') ? 'active' : '' }}  {{ Request::is('admin/customers/add') ? 'active' : '' }}  {{ Request::is('admin/customers/edit/*') ? 'active' : '' }} {{ Request::is('admin/customers/address/display/*') ? 'active' : '' }} {{ Request::is('admin/customers/filter') ? 'active' : '' }} ">
                    <a href="{{ URL::to('admin/customers/display')}}">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>{{ trans('labels.link_customers') }}</span>
                    </a>
                </li>
            @endif



            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->products_view == 1
or $result['commonContent']['roles'] != null and $result['commonContent']['roles']->categories_view == 1 )
                <li class="treeview {{ Request::is('admin/reviews/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }} {{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/addunit') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} {{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/editattributes/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }} {{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }} {{ Request::is('admin/products/inventory/display') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>{{ trans('labels.Catalog') }}</span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manufacturer_view == 1)
                            <li class="{{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/manufacturers/display')}}"><i
                                        class="fa fa-circle-o"></i> {{ trans('labels.link_manufacturer') }}</a></li>
                        @endif
                        @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1)
                            <li class="{{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/categories/display')}}"><i
                                        class="fa fa-circle-o"></i> {{ trans('labels.link_main_categories') }}</a></li>
                        @endif

                        @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1)
                            <li class="{{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/*') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/products/attributes/display' )}}"><i
                                        class="fa fa-circle-o"></i> {{ trans('labels.products_attributes') }}</a></li>
                            {{--                                                        <li class="{{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/addunit') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} ">--}}
                            {{--                                                            <a href="{{ URL::to('admin/units')}}"><i--}}
                            {{--                                                                    class="fa fa-circle-o"></i> {{ trans('labels.link_units') }}</a></li>--}}
                            <li class="{{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/products/display')}}"><i
                                        class="fa fa-circle-o"></i> {{ trans('labels.link_all_products') }}</a></li>
                            <li class="{{ Request::is('admin/products/inventory/display') ? 'active' : '' }}"><a
                                    href="{{ URL::to('admin/products/inventory/display')}}"><i
                                        class="fa fa-circle-o"></i> {{ trans('labels.inventory') }}</a></li>
                            {{--                            <li class="{{ Request::is('admin/bouquet/display') ? 'active' : '' }}"><a--}}
                            {{--                                    href="{{ URL::to('admin/bouquet/display')}}"><i--}}
                            {{--                                        class="fa fa-circle-o"></i> {{ trans('labels.bouquet') }}</a></li>--}}
                        @endif
                        <?php
                        $status_check = DB::table('reviews')->where('reviews_read', 0)->first();
                        ?>
                        @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->reviews_view == 1)

                            <li class="{{ Request::is('admin/reviews/display') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/reviews/display')}}">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span>{{ trans('labels.reviews') }}</span>@if($result['commonContent']['new_reviews']>0)
                                        <span
                                            class="label label-success pull-left">{{$result['commonContent']['new_reviews']}} {{ trans('labels.new') }}</span>@endif
                                </a>
                            </li>
                            <li class="{{ Request::is('admin/product_questions/display') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/product_questions/display')}}">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <span>{{ trans('labels.product_questions') }}</span>@if($result['commonContent']['new_product_questions']>0)
                                        <span
                                            class="label label-success pull-left">{{$result['commonContent']['new_product_questions']}} {{ trans('labels.new') }}</span>@endif
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->orders_view == 1)
                <li class="treeview {{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} {{ Request::is('admin/orders/display') ? 'active' : '' }} {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
                        <span> {{ trans('labels.link_orders') }}</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} ">
                            <a href="{{ URL::to('admin/orderstatus')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_order_status') }}</a></li>
                        <li class="{{ Request::is('admin/orders/display') ? 'active' : '' }} {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/orders/display')}}">
                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <span> {{ trans('labels.link_orders') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->reports_view == 1)
                <li class="treeview {{ Request::is('admin/statscustomers') ? 'active' : '' }} {{ Request::is('admin/outofstock') ? 'active' : '' }} {{ Request::is('admin/statsproductspurchased') ? 'active' : '' }} {{ Request::is('admin/statsproductsliked') ? 'active' : '' }} {{ Request::is('admin/lowinstock') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        <span>{{ trans('labels.link_reports') }}</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/lowinstock') ? 'active' : '' }} "><a
                                href="{{ URL::to('admin/lowinstock')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_products_low_stock') }}</a></li>
                        <li class="{{ Request::is('admin/outofstock') ? 'active' : '' }} "><a
                                href="{{ URL::to('admin/outofstock')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_out_of_stock_products') }}</a>
                        </li>
                    <!-- <li class="{{ Request::is('admin/productsstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/stockin')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.stockin') }}</a></li>-->
                        <li class="{{ Request::is('admin/statscustomers') ? 'active' : '' }} "><a
                                href="{{ URL::to('admin/statscustomers')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_customer_orders_total') }}</a>
                        </li>
                        <li class="{{ Request::is('admin/report/inventory') ? 'active' : '' }}"><a
                                href="{{ route('report.show','inventory')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_total_purchased') }}</a></li>
                        <li class="{{ Request::is('admin/report/like') ? 'active' : '' }}"><a
                                href="{{ route('report.show','like')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_products_liked') }}</a></li>
                    </ul>
                </li>
            @endif



            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->tax_location_view == 1)
                <li class="treeview {{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} {{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span>{{ trans('labels.link_tax_location') }}</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        {{--                        <li class="{{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} ">--}}
                        {{--                            <a href="{{ URL::to('admin/countries/display')}}"><i--}}
                        {{--                                    class="fa fa-circle-o"></i> {{ trans('labels.link_countries') }}</a></li>--}}
                        {{--                        --}}
                        <li class="{{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/zones/display')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_zones') }}</a></li>
                        <li class="{{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} ">
                            <a href="{{ URL::to('admin/tax/taxclass/display')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_tax_class') }}</a></li>
                        <li class="{{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }} ">
                            <a href="{{ URL::to('admin/tax/taxrates/display')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_tax_rates') }}</a></li>
                    </ul>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->coupons_view == 1)
                <li class="treeview {{ Request::is('admin/coupons/display') ? 'active' : '' }} {{ Request::is('admin/coupons/*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/coupons/display')}}"><i class="fa fa-tablet" aria-hidden="true"></i>
                        <span>{{ trans('labels.link_coupons') }}</span></a>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->coupons_view == 1)
                <li class="treeview  {{ Request::is('admin/view_categories/*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/view_categories')}}"><i class="fa fa-tablet" aria-hidden="true"></i>
                        <span>{{ trans('labels.link_view_categories') }}</span></a>
                </li>

            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shipping_methods_view == 1)
                <li class="treeview {{ Request::is('admin/shippingmethods/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/flateRate/display') ? 'active' : '' }}">
                    <a href="#">
                        {{--                    <a href="{{ URL::to('admin/shippingmethods/display')}}">--}}
                        <i class="fa fa-truck"
                           aria-hidden="true"></i>
                        <span> {{ trans('labels.link_shipping_methods') }}</span>
                    </a>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->payment_methods_view == 1)
                <li class="treeview {{ Request::is('admin/paymentmethods/index') ? 'active' : '' }} {{ Request::is('admin/paymentmethods/display/*') ? 'active' : '' }}">
                    <a href="#">
                        {{--                    <a href="{{ URL::to('admin/paymentmethods/index')}}">--}}
                        <i class="fa fa-credit-card"
                           aria-hidden="true"></i> <span>
              {{ trans('labels.link_payment_methods') }}</span>
                    </a>
                </li>
            @endif
            {{--            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->news_view == 1)--}}
            {{--                <li class="treeview {{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }} {{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }}">--}}
            {{--                    <a href="#">--}}
            {{--                        <i class="fa fa-database" aria-hidden="true"></i>--}}
            {{--                        <span>      {{ trans('labels.Blog') }}</span> <i class="fa fa-angle-left pull-left"></i>--}}
            {{--                    </a>--}}
            {{--                    <ul class="treeview-menu">--}}
            {{--                        <li class="{{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }}">--}}
            {{--                            <a href="{{ URL::to('admin/newscategories/display')}}"><i--}}
            {{--                                    class="fa fa-circle-o"></i>{{ trans('labels.link_news_categories') }}</a></li>--}}
            {{--                        <li class="{{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }}">--}}
            {{--                            <a href="{{ URL::to('admin/news/display')}}"><i--}}
            {{--                                    class="fa fa-circle-o"></i> {{ trans('labels.link_sub_news') }}</a></li>--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--            @endif--}}

            @if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->notifications_view == 1)
                <li class="treeview {{ Request::is('admin/pushnotification') ? 'active' : '' }}{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }} {{ Request::is('admin/devices/notifications') ? 'active' : '' }}">
                    <a href="#">
                        {{--                    <a href="{{ URL::to('admin/devices/display')}} ">--}}
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span>{{ trans('labels.link_notifications') }}</span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/pushnotification') ? 'active' : '' }}"><a
                                href="{{ URL::to('admin/pushnotification')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>
                        <li class="{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/devices/display')}}"><i
                                    class="fa fa-circle-o"></i>{{ trans('labels.link_devices') }} </a>
                        </li>
                        <li class="{{ Request::is('admin/devices/notifications') ? 'active' : '' }} ">
                            <a href="{{ URL::to('admin/devices/notifications') }}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_send_notifications') }}</a>
                        </li>
                    </ul>

                </li>
            @endif

            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->general_setting_view == 1)

                <li class="treeview {{ Request::is('admin/facebooksettings') ? 'active' : '' }} {{ Request::is('admin/setting') ? 'active' : '' }} {{ Request::is('admin/googlesettings') ? 'active' : '' }}  {{ Request::is('admin/alertsetting') ? 'active' : '' }}  ">
                    <a href="#">
                        <i class="fa fa-gears" aria-hidden="true"></i>
                        <span> {{ trans('labels.link_general_settings') }}</span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">

                        <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a
                                href="{{ URL::to('admin/setting')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_store_setting') }}</a></li>
                        {{--                        <li class="{{ Request::is('admin/facebooksettings') ? 'active' : '' }}"><a--}}
                        {{--                                href="{{ URL::to('admin/facebooksettings')}}"><i--}}
                        {{--                                    class="fa fa-circle-o"></i> {{ trans('labels.link_facebook') }}</a></li>--}}
                        {{--                        --}}
                        <li class="{{ Request::is('admin/googlesettings') ? 'active' : '' }}"><a
                                href="{{ URL::to('admin/googlesettings')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_google') }}</a></li>

                        {{--                                                <li class="{{ Request::is('admin/alertsetting') ? 'active' : '' }}"><a--}}
                        {{--                                                        href="{{ URL::to('admin/alertsetting')}}"><i--}}
                        {{--                                                            class="fa fa-circle-o"></i> {{ trans('labels.alertSetting') }}</a></li>--}}


                    </ul>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->manage_admins_view == 1)

                <li class="treeview {{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }} {{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span> {{ trans('labels.Manage Admins') }}</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/admins')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_admins') }}</a></li>
                        <li class="{{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/manageroles')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.link_manage_roles') }}</a></li>
                    </ul>
                </li>
            @endif
            @if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_management == 1)

            <!--------create middlewares -------->
                <li class="treeview  {{ Request::is('admin/managements/restore') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-gears" aria-hidden="true"></i>
                        <span> {{ trans('labels.Backup / Restore') }}</span> <i
                            class="fa fa-angle-left pull-left"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a
                                href="{{ URL::to('admin/managements/backup')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.backup') }}</a></li>
                        <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a
                                href="{{ URL::to('admin/managements/import')}}"><i
                                    class="fa fa-circle-o"></i> {{ trans('labels.restore') }}</a></li>

                    </ul>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
