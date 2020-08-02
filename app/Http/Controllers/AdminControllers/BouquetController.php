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
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.bouquets.add1", $title)->with('result', $result);

    }


    public function store(Request $request)
    {
        $expiryDate = str_replace('/', '-', $request->expiry_date);
        $request->expiry_date = strtotime($expiryDate);
        $products = [];
        foreach ($request->products as $product) {
            $ops = [];
            foreach ($product['options'] as $op)
                $ops[] = $op;
            $product['options'] = $ops;
            $products[] = $product;
        }
        $b = Bouquet::create(array_merge($request->all(), [
            'bouquet_name_en' => $request->bouquet_name_1,
            'bouquet_name_ar' => $request->bouquet_name_2,
            'bouquet_description_en' => $request->bouquet_description_1,
            'bouquet_description_ar' => $request->bouquet_description_2,
            'default_image' => $request->image_id,
            'products' => $products,
        ]));
        return redirect()->back()
            ->with('success', Lang::get("labels.BouquetAddedMessage"));

    }

    public function create(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.bouquets.add1", $title)
            ->with('result', $result)
            ->with('old_image', null);
    }


}
