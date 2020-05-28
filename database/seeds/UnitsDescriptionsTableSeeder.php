<?php

use Illuminate\Database\Seeder;

class UnitsDescriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units_descriptions')->delete();
        
        \DB::table('units_descriptions')->insert(array (
            0 => 
            array (
                'units_description_id' => 1,
                'units_name' => 'Gram',
                'languages_id' => 1,
                'unit_id' => 1,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
            1 => 
            array (
                'units_description_id' => 2,
                'units_name' => 'غرام',
                'languages_id' => 2,
                'unit_id' => 1,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
            2 => 
            array (
                'units_description_id' => 3,
                'units_name' => 'Kilogram',
                'languages_id' => 1,
                'unit_id' => 2,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
            3 => 
            array (
                'units_description_id' => 4,
                'units_name' => 'كيلوغرام',
                'languages_id' => 2,
                'unit_id' => 2,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
        ));
        
        
    }
}