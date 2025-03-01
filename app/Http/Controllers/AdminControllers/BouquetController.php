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

    public function __construct(Products $products,
                                Languages $language, Images $images,Setting $setting )
    {

        $this->language = $language;
        $this->images = $images;

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
                DB::raw("(SELECT count(*) FROM orders_products WHERE products_id=bouquets.bouquet_id and orders_products_type like '%bouquet%' ) as sold_count"),
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
            ->rawColumns(['btn_sort', 'manage', 'btn_image', 'info'])
            ->make(true);
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

private function products_to_json($request)
{
    $products = [];
    foreach ($request->products as $product) {
        $ops = [];
        foreach ($product['options'] as $op)
            $ops[] = $op;
        $product['options'] = $ops;
        $products[] = $product;
    }
    return$products;
}
    public function store(Request $request)
    {
//        return dd($request);
        $products = $this->products_to_json($request);
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

    public function edit(Bouquet $bouquet)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        $old_image = ($bouquet->imagePath->imagesTHUMBNAIL);
        $old_image = ($old_image != null) ? $old_image : $bouquet->imagePath->imagesACTUAL;
        $old_image = ($old_image != null) ? $old_image->path : null;
        $products=$bouquet->products;
        foreach ($products as $product) {
            $product->product = getProductName($product->products_id);
            foreach ( $product->options as $option) {

                $option->option_name = getProductOptionName($option->option_id);
                $option->attribute_name = getAttributeOptionName($option->attribute_id);

            }

        }

        return view("admin.bouquets.add1", $title)
            ->with('result', $result)
            ->with('bouquet', $bouquet)
            ->with('products', $products)
            ->with('old_image', $old_image);
    }

    public
    function update(Request $request, Bouquet $bouquet )
    {

//return dd($request);
        if ($request->image_id == null) {
            $uploadImage = $request->oldImage;
        } else {
            $uploadImage = $request->image_id;
        }
        $products = $this->products_to_json($request);
        $bouquet->update(array_merge($request->all(), [
            'bouquet_name_en' => $request->bouquet_name_1,
            'bouquet_name_ar' => $request->bouquet_name_2,
            'bouquet_description_en' => $request->bouquet_description_1,
            'bouquet_description_ar' => $request->bouquet_description_2,
            'default_image' => $uploadImage,
            'expiry_date' => setEntryDateAttribute($request->expiry_date),
            'products' => $products]));
        return redirect()->route('bouquets.index')
            ->with('success', Lang::get("labels.product_question_updateMessage"));


    }
    public function delete($id)
    {
        $bouquet = Bouquet::find(decrypt($id));
        if ($bouquet->orders_products->count() > 0)
            return redirect()->back()->with('danger', 'Not allow to delete because this bouquet has related data  ');
        $bouquet->delete();
        return redirect()->back()->with('success', 'bouquet deleted successfully');
    }

}
