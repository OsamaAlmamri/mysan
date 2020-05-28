<?php

use Illuminate\Database\Seeder;

class OrdersStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('orders_status')->delete();

        \DB::table('orders_status')->insert(array (
            0 =>
            array (
                'orders_status_id' => 1,
                'public_flag' => 0,
                'downloads_flag' => 0,
                'role_id' => 2,
            ),
            1 =>
            array (
                'orders_status_id' => 2,
                'public_flag' => 0,
                'downloads_flag' => 0,
                'role_id' => 2,
            ),
            2 =>
            array (
                'orders_status_id' => 3,
                'public_flag' => 0,
                'downloads_flag' => 0,
                'role_id' => 2,
            ),
            3 =>
            array (
                'orders_status_id' => 4,
                'public_flag' => 0,
                'downloads_flag' => 0,
                'role_id' => 2,
            ),            
        ));
    }
}
