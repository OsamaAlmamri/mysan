<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sort_order' => 1,
                'sub_sort_order' => NULL,
                'parent_id' => 0,
                'type' => 1,
                'external_link' => NULL,
                'link' => '/',
                'page_id' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'sort_order' => 2,
                'sub_sort_order' => NULL,
                'parent_id' => 0,
                'type' => 1,
                'external_link' => NULL,
                'link' => 'shop',
                'page_id' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'sort_order' => 4,
                'sub_sort_order' => NULL,
                'parent_id' => 0,
                'type' => 1,
                'external_link' => NULL,
                'link' => '#',
                'page_id' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 18,
                'sort_order' => NULL,
                'sub_sort_order' => 4,
                'parent_id' => 3,
                'type' => 1,
                'external_link' => NULL,
                'link' => '/page?name=about-us',
                'page_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 19,
                'sort_order' => NULL,
                'sub_sort_order' => 2,
                'parent_id' => 3,
                'type' => 1,
                'external_link' => NULL,
                'link' => '/page?name=privacy-policy',
                'page_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 20,
                'sort_order' => 5,
                'sub_sort_order' => NULL,
                'parent_id' => 0,
                'type' => 1,
                'external_link' => NULL,
                'link' => '#',
                'page_id' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            // 6 => 
            // array (
            //     'id' => 21,
            //     'sort_order' => NULL,
            //     'sub_sort_order' => 1,
            //     'parent_id' => 20,
            //     'type' => 1,
            //     'external_link' => NULL,
            //     'link' => 'news?category=demo',
            //     'page_id' => 1,
            //     'status' => 1,
            //     'created_at' => NULL,
            //     'updated_at' => NULL,
            // ),
            7 => 
            array (
                'id' => 22,
                'sort_order' => 6,
                'sub_sort_order' => NULL,
                'parent_id' => 0,
                'type' => 1,
                'external_link' => NULL,
                'link' => 'contact',
                'page_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 24,
                'sort_order' => NULL,
                'sub_sort_order' => 3,
                'parent_id' => 3,
                'type' => 1,
                'external_link' => NULL,
                'link' => 'page?name=about-us',
                'page_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 25,
                'sort_order' => NULL,
                'sub_sort_order' => 1,
                'parent_id' => 3,
                'type' => 1,
                'external_link' => NULL,
                'link' => 'page?name=privacy-policy',
                'page_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}