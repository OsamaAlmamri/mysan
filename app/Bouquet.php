<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{

    protected $primaryKey ='bouquet_id';

    protected $fillable = [
        'bouquet_name_ar', 'bouquet_name_en', 'bouquet_price',
        'bouquet_description_ar', 'bouquet_description_en', 'expiry_date',
        'bouquet_type', 'usage_count', 'usage_limit', 'free_shipping',
    ];
}
