<?php

use Illuminate\Database\Seeder;

class ManageRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('manage_role')->delete();
        
        \DB::table('manage_role')->insert(array (
            0 => 
            array (
                'manage_role_id' => 1,
                'user_types_id' => 1,
                'dashboard_view' => 1,
                'manufacturer_view' => 1,
                'manufacturer_create' => 1,
                'manufacturer_update' => 1,
                'manufacturer_delete' => 1,
                'categories_view' => 1,
                'categories_create' => 1,
                'categories_update' => 1,
                'categories_delete' => 1,
                'products_view' => 1,
                'products_create' => 1,
                'products_update' => 1,
                'products_delete' => 1,
                'news_view' => 1,
                'news_create' => 1,
                'news_update' => 1,
                'news_delete' => 1,
                'customers_view' => 1,
                'customers_create' => 1,
                'customers_update' => 1,
                'customers_delete' => 1,
                'tax_location_view' => 1,
                'tax_location_create' => 1,
                'tax_location_update' => 1,
                'tax_location_delete' => 1,
                'coupons_view' => 1,
                'coupons_create' => 1,
                'coupons_update' => 1,
                'coupons_delete' => 1,
                'notifications_view' => 1,
                'notifications_send' => 1,
                'orders_view' => 1,
                'orders_confirm' => 1,
                'shipping_methods_view' => 1,
                'shipping_methods_update' => 1,
                'payment_methods_view' => 1,
                'payment_methods_update' => 1,
                'reports_view' => 1,
                'website_setting_view' => 1,
                'website_setting_update' => 1,
                'application_setting_view' => 1,
                'application_setting_update' => 1,
                'general_setting_view' => 1,
                'general_setting_update' => 1,
                'manage_admins_view' => 1,
                'manage_admins_create' => 1,
                'manage_admins_update' => 1,
                'manage_admins_delete' => 1,
                'language_view' => 1,
                'language_create' => 1,
                'language_update' => 1,
                'language_delete' => 1,
                'profile_view' => 1,
                'profile_update' => 1,
                'admintype_view' => 1,
                'admintype_create' => 1,
                'admintype_update' => 1,
                'admintype_delete' => 1,
                'manage_admins_role' => 1,
                'add_media' => 1,
                'edit_media' => 1,
                'view_media' => 1,
                'delete_media' => 1,
                'edit_management' => 1,
                'reviews_view' => 1,
                'reviews_update' => 1,
            ),
        ));
        
        
    }
}