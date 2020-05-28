<?php

use Illuminate\Database\Seeder;

class MenuTranslationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_translation')->delete();
        
        \DB::table('menu_translation')->insert(array (
            0 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'language_id' => 1,
                'menu_name' => 'Home',
            ),
            1 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'language_id' => 2,
                'menu_name' => 'Homee',
            ),
            2 => 
            array (
                'id' => 11,
                'menu_id' => 2,
                'language_id' => 1,
                'menu_name' => 'SHOP',
            ),
            3 => 
            array (
                'id' => 12,
                'menu_id' => 2,
                'language_id' => 2,
                'menu_name' => 'SHOP',
            ),
            4 => 
            array (
                'id' => 25,
                'menu_id' => 3,
                'language_id' => 1,
                'menu_name' => 'INFO PAGES',
            ),
            5 => 
            array (
                'id' => 26,
                'menu_id' => 3,
                'language_id' => 2,
                'menu_name' => 'INFO PAGES',
            ),
            6 => 
            array (
                'id' => 33,
                'menu_id' => 18,
                'language_id' => 1,
                'menu_name' => 'About Us',
            ),
            7 => 
            array (
                'id' => 34,
                'menu_id' => 18,
                'language_id' => 2,
                'menu_name' => 'About Us',
            ),
            8 => 
            array (
                'id' => 35,
                'menu_id' => 19,
                'language_id' => 1,
                'menu_name' => 'Privacy Policy',
            ),
            9 => 
            array (
                'id' => 36,
                'menu_id' => 19,
                'language_id' => 2,
                'menu_name' => 'Privacy Policy',
            ),
            10 => 
            array (
                'id' => 37,
                'menu_id' => 20,
                'language_id' => 1,
                'menu_name' => 'News',
            ),
            11 => 
            array (
                'id' => 38,
                'menu_id' => 20,
                'language_id' => 2,
                'menu_name' => 'News',
            ),
            12 => 
            array (
                'id' => 39,
                'menu_id' => 21,
                'language_id' => 1,
                'menu_name' => 'Demo',
            ),
            13 => 
            array (
                'id' => 40,
                'menu_id' => 21,
                'language_id' => 2,
                'menu_name' => 'Demo',
            ),
            14 => 
            array (
                'id' => 41,
                'menu_id' => 22,
                'language_id' => 1,
                'menu_name' => 'Contact Us',
            ),
            15 => 
            array (
                'id' => 42,
                'menu_id' => 22,
                'language_id' => 2,
                'menu_name' => 'Contact Us',
            ),
            16 => 
            array (
                'id' => 45,
                'menu_id' => 24,
                'language_id' => 1,
                'menu_name' => 'Sub Menu 1',
            ),
            17 => 
            array (
                'id' => 46,
                'menu_id' => 24,
                'language_id' => 2,
                'menu_name' => 'Sub Menu 1',
            ),
            18 => 
            array (
                'id' => 47,
                'menu_id' => 25,
                'language_id' => 1,
                'menu_name' => 'Sub Menu 12',
            ),
            19 => 
            array (
                'id' => 48,
                'menu_id' => 25,
                'language_id' => 2,
                'menu_name' => 'Sub Menu 12',
            ),
        ));
        
        
    }
}