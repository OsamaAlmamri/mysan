<?php

namespace App\Http\Controllers\AdminControllers;

use App\Bouquet;
use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\Products;
use App\Models\Core\Reviews;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class BouquetController extends Controller
{

    public function __construct(Products $products, Languages $language, Images $images, Categories $category, Setting $setting,
                                Manufacturers $manufacturer, Reviews $reviews)
    {
        $this->category = $category;
        $this->reviews = $reviews;
        $this->language = $language;
        $this->images = $images;
        $this->manufacturer = $manufacturer;
        $this->products = $products;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;

    }


    public function addinventoryfromsidebar(Request $request)
    {
//        return dd('ddddd');
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.bouquets.add1", $title)->with('result', $result);

    }

    public function store(Request $request)
    {
        $b=Bouquet::find(6);
        return dd($b->all_products);
        foreach ( ($b->products) as $pro )
        return dd($pro->options);

        Bouquet::create(array_merge($request->all(),[
            'bouquet_name_ar'=>'',
            'bouquet_name_en'=>'',
            'bouquet_price'=>'',
            'bouquet_description_ar'=>'',
            'default_image'=>'',
            'additional_images'=>'',
            'bouquet_description_en'=>'',
            'expiry_date'=>'',
            'sort'=>1,
            'bouquet_type'=>'1',
            'usage_count'=>'',
            'usage_limit'=>1,
            'free_shipping'=>'',
        ]));

    }


}
