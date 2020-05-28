<?php

use Illuminate\Database\Seeder;

class PaymentMethodsDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment_methods_detail')->delete();
        
        \DB::table('payment_methods_detail')->insert(array (
            0 => 
            array (
                'id' => 3,
                'payment_methods_id' => 1,
                'key' => 'merchant_id',
                'value' => 'wrv3cwbft6n3bg5g',
            ),
            1 => 
            array (
                'id' => 4,
                'payment_methods_id' => 1,
                'key' => 'public_key',
                'value' => '2bz5kxcj2gs3hdbx',
            ),
            2 => 
            array (
                'id' => 5,
                'payment_methods_id' => 1,
                'key' => 'private_key',
                'value' => '55ae08cb061e36dca59aaf2a883190bf',
            ),
            3 => 
            array (
                'id' => 9,
                'payment_methods_id' => 2,
                'key' => 'secret_key',
                'value' => 'sk_test_Gsz7jL4wRikI8YFaNzbwxKOF',
            ),
            4 => 
            array (
                'id' => 10,
                'payment_methods_id' => 2,
                'key' => 'publishable_key',
                'value' => 'pk_test_cCAEC6EejawuAvsvR9bhKrGR',
            ),
            5 => 
            array (
                'id' => 15,
                'payment_methods_id' => 3,
                'key' => 'id',
                'value' => 'AULJ0Q_kdXwEbi7PCBunUBJc4Kkg2vvdazF8kJoywAV9_i7iJMQphB9NLwdR0v2BAUlLF974iTrynbys',
            ),
            6 => 
            array (
                'id' => 18,
                'payment_methods_id' => 3,
                'key' => 'payment_currency',
                'value' => 'USD',
            ),
            7 => 
            array (
                'id' => 21,
                'payment_methods_id' => 5,
                'key' => 'api_key',
                'value' => 'c5a348bd5fcb4c866074c48e9c77c6c4',
            ),
            8 => 
            array (
                'id' => 22,
                'payment_methods_id' => 5,
                'key' => 'auth_token',
                'value' => '99448897defb4423b921fe47e0851b86',
            ),
            9 => 
            array (
                'id' => 23,
                'payment_methods_id' => 5,
                'key' => 'client_id',
                'value' => 'test_9l7MW8I7c2bwIw7q0koc6B1j5NrvzyhasQh',
            ),
            10 => 
            array (
                'id' => 24,
                'payment_methods_id' => 5,
                'key' => 'client_secret',
                'value' => 'test_m9Ey3Jqp9AfmyWKmUMktt4K3g1uMIdapledVRRYJha7WinxOsBVV5900QMlwvv3l2zRmzcYDEOKPh1cvnVedkAKtHOFFpJbqcoNCNrjx1FtZhtDMkEJFv9MJuXD',
            ),
            11 => 
            array (
                'id' => 32,
                'payment_methods_id' => 6,
                'key' => 'userid',
                'value' => '8a82941865340dc8016537cdac1e0841',
            ),
            12 => 
            array (
                'id' => 33,
                'payment_methods_id' => 6,
                'key' => 'password',
                'value' => 'sXrYy8pnsf',
            ),
            13 => 
            array (
                'id' => 34,
                'payment_methods_id' => 6,
                'key' => 'entityid',
                'value' => '8a82941865340dc8016537ce08db0845',
            ),
            14 => 
            array (
                'id' => 35,
                'payment_methods_id' => 7,
                'key' => 'RAZORPAY_KEY',
                'value' => 'rzp_test_izyMwtDZYAQeSA',
            ),
            15 => 
            array (
                'id' => 36,
                'payment_methods_id' => 7,
                'key' => 'RAZORPAY_SECRET',
                'value' => 'LBIgacPG7Da6mdOARfig205j',
            ),
            16 => 
            array (
                'id' => 37,
                'payment_methods_id' => 8,
                'key' => 'paytm_mid',
                'value' => 'QROqBU67944622696360',
            ),
            17 => 
            array (
                'id' => 39,
                'payment_methods_id' => 8,
                'key' => 'paytm_key',
                'value' => 'w#5bJEFYV5EU4vnP',
            ),
            18 => 
            array (
                'id' => 40,
                'payment_methods_id' => 8,
                'key' => 'current_domain_name',
                'value' => '',
            ),
        ));
        
        
    }
}