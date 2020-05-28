<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'U.S. Dollar',
                'code' => 'USD',
                'symbol_left' => '$',
                'symbol_right' => NULL,
                'decimal_point' => NULL,
                'thousands_point' => NULL,
                'decimal_places' => '2',
                'created_at' => '2019-09-06 08:33:11',
                'updated_at' => '2019-09-06 08:33:11',
                'value' => 1.0,
                'is_default' => 1,
                'status' => 1,
                'is_current' => 1,
            ),
            1 => 
            array (
                'id' => 9,
                'title' => 'AED',
                'code' => 'AED',
                'symbol_left' => 'د.إ',
                'symbol_right' => NULL,
                'decimal_point' => NULL,
                'thousands_point' => NULL,
                'decimal_places' => '2',
                'created_at' => '2019-10-11 12:09:42',
                'updated_at' => '2019-10-11 12:09:42',
                'value' => 3.67,
                'is_default' => 0,
                'status' => 1,
                'is_current' => 1,
            ),
        ));
        
        
    }
}