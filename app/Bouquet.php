<?php

namespace App;

use App\Models\Core\Images;
use App\Models\Core\OrdersProduct;
use App\Models\Core\Products;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Bouquet extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $primaryKey = 'bouquet_id';
    protected $casts = [
        'products' => 'object'
    ];

    public function all_products()
    {
        return $this->belongsToJson(Products::class, 'products->product_id', 'products_id');
    }

    protected $fillable = [
        'bouquet_name_ar', 'bouquet_name_en', 'bouquet_price',
        'bouquet_description_ar', 'default_image', 'additional_images', 'bouquet_description_en',
        'expiry_date',
        'products', 'sort', 'count', 'free_shipping',
    ];
    public function imagePath()
    {
        return $this->belongsTo(Images::class, 'default_image', 'id');
    }

//DB::raw("(SELECT count(*) FROM orders_products WHERE orders_products_id=bouquets.bouquet_id and orders_products_type like '%bouquet%' ) as sold_count"),

    public function orders_products()
    {
        return $this->hasMany(OrdersProduct::class, 'products_id', 'bouquet_id')->where('orders_products_type',  'bouquet');
    }


}
