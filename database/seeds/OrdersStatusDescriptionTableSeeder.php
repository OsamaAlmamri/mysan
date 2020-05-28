<?php

use Illuminate\Database\Seeder;

class OrdersStatusDescriptionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('orders_status_description')->delete();

        \DB::table('orders_status_description')->insert(array (
            0 =>
            array (
                'orders_status_description_id' => 1,
                'orders_status_id' => 1,
                'orders_status_name' => 'Pending',
                'language_id' => 1,
            ),
            1 =>
            array (
                'orders_status_description_id' => 2,
                'orders_status_id' => 2,
                'orders_status_name' => 'Completed',
                'language_id' => 1,
            ),
            2 =>
            array (
                'orders_status_description_id' => 3,
                'orders_status_id' => 3,
                'orders_status_name' => 'Cancel',
                'language_id' => 1,
            ),
            3 =>
            array (
                'orders_status_description_id' => 4,
                'orders_status_id' => 4,
                'orders_status_name' => 'Return',
                'language_id' => 1,
            ),
        ));


    }
}
