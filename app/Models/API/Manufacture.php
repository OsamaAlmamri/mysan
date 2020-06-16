<?php

namespace App\Models\API;

use App\Models\Core\Manufacturers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manufacture extends Model
{


    public function getter($lang)
    {
        if ($lang == null) {
            $lang = '1';
        }
        $manufacturers = Manufacturers::sortable(['manufacturers_id' => 'desc'])->leftJoin('manufacturers_info', 'manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
            ->leftJoin('images', 'images.id', '=', 'manufacturers.manufacturer_image')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'manufacturers.manufacturer_image')
            ->select('manufacturers.manufacturers_id as id', 'manufacturers.manufacturer_image as image', 'manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url', 'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date', 'image_categories.path as path')
            ->where('manufacturers_info.languages_id', $lang)
            ->where('image_categories.image_type', '=', 'THUMBNAIL' or 'image_categories.image_type', '=', 'ACTUAL')->get();
        return $manufacturers;
    }
}
