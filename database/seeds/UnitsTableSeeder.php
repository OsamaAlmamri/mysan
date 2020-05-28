<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'unit_id' => 1,
                'is_active' => 1,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
            1 => 
            array (
                'unit_id' => 2,
                'is_active' => 1,
                'created_at' => '2019-01-01 08:04:18',
                'updated_at' => '2019-01-01 08:04:18',
            ),
        ));
        
        
    }
}