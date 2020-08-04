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


    public function index(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.bouquets.index2", $title)->with('result', $result);

    }

    public
    function changeOrder(Request $request)
    {
        $sortData = Bouquet::all();
        changeOrder($request, $sortData, 'bouquet_id');
        return response('Update Successfully.', 200);
    }

    public function getData($from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        $data = DB::table('bouquets')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'bouquets.default_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('bouquets.*',
                DB::raw("(SELECT count(*) FROM orders_products WHERE orders_products_id=bouquets.bouquet_id and orders_products_type like '%bouquet%' ) as sold_count"),
                'image_categories.path as path')
            ->whereBetween('bouquets.created_at', [$from_date, $to_date])
            ->get();
        return $data;
    }

    public function filter2(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getData($from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('btn_sort', 'admin.sortFiles.btn_sort')
            ->addColumn('manage', 'admin.bouquets.btn.manage')
            ->addColumn('btn_image', 'admin.bouquets.btn.image')
            ->addColumn('info', 'admin.bouquets.btn.info')
            ->rawColumns(['btn_sort','manage', 'btn_image', 'info'])
            ->make(true);
    }


    public function store(Request $request)
    {

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
            'expiry_date' => setEntryDateAttribute($request->expiry_date),
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
