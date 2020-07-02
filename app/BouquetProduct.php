<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BouquetProduct extends Model
{
    //     $table->unsignedBigInteger('');
    //            $table->unsignedBigInteger('product_id');
    //            $table->integer('quantity');
    //            $table->string('product_option_values')->nullable();

    protected $primaryKey = 'bouquet_product_id';

    protected $fillable = [
        'bouquet_id', 'product_id', 'quantity', 'product_option_values',
    ];

}
