<?php

namespace App\Http\Controllers\AdminControllers;

use App\DataTables\ViewCategoriesDataTable;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Coupon;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\ViewCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ViewCategoriesController extends Controller
{
    //
    public function __construct(Coupon $coupon, Setting $setting)
    {
        $this->Coupon = $coupon;
        $this->myVarSetting = new SiteSettingController($setting);
        $this->Setting = $setting;

    }

//    public function index(Request $request)
//    {
//        $title = array('pageTitle' => Lang::get("labels.ListingCoupons"));
//        $result = array();
//        $coupons = ViewCategory::sortable()
//            ->orderBy('created_at', 'DESC')
//            ->paginate(7);
//        $result['coupons'] = $coupons;
//        //get function from other controller
//        $result['currency'] = $this->myVarSetting->getSetting();
//        $result['commonContent'] = $this->Setting->commonContent();
//        return view("admin.view_categories.index", $title)
//            ->with('result', $result)->with('coupons', $coupons);
//
//    }

    public function index()
    {

        $reviews = new ViewCategoriesDataTable();
        $title = array('pageTitle' => Lang::get("labels.ListingCoupons"));
        $result['commonContent'] = $this->Setting->commonContent();
        return $reviews->render('admin.view_categories.index2', ['title' => $title, 'result' => $result,
            'dataTableType' => 'php']);
    }

    public function create(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddCoupon"));
        $result = array();
        $message = array();
        $result['message'] = $message;
        $products = $this->Coupon->cutomers();

        $images = new Images;
        $allimage = $images->getimages();
        $result['products'] = $products;
        $result['categories'] = ViewCategory::all();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.view_categories.add", $title)
            ->with('result', $result)
            ->with('old_products', [])
            ->with('old_image', null)
            ->with('allimage', $allimage)
            ->with('content', 'products');
    }

    public function store(Request $request)
    {
//        return dd($request);
        if ($request->content == 'products')
            $product_ids = ($request->products !== null) ? implode(',', $request->products) : '';
        else
            $product_ids = ($request->categories !== null) ? implode(',', $request->categories) : '';
        $validator = Validator::make(
            ['name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'image_id' => $request->image_id,
                'sort' => $request->sort,
            ], ['name_en' => 'required',
            'name_ar' => 'required',
            'image_id' => 'required',
            'sort' => 'required']);
        //check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //check coupon already exist
        ViewCategory::create(array_merge($request->all(), ['image' => $request->image_id, 'product_ids' => $product_ids]));
        return redirect('admin/view_categories/create')
            ->with('success', Lang::get("labels.ViewCategoryAddedMessage"));
    }


    public function edit(ViewCategory $viewCategory)
    {

        $title = array('pageTitle' => Lang::get("labels.EditViewCategories"));
        $result = array();
        $message = array();
        $result['message'] = $message;
        $result['viewCategory'] = $viewCategory;
        $result['categories'] = ViewCategory::all()->where('id', '<>', $viewCategory->id);

        $products = $this->Coupon->getproduct();
        $result['products'] = $products;
        $old_products = explode(',', $viewCategory->product_ids);
        $images = new Images;
        $allimage = $images->getimages();
        $old_image = ($viewCategory->imagePath->imagesTHUMBNAIL);
        $old_image = ($old_image != null) ? $old_image : $viewCategory->imagePath->imagesACTUAL;
        $old_image = ($old_image != null) ? $old_image->path : null;

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.view_categories.add", $title)->with('result', $result)
            ->with('viewCategory', $viewCategory)
            ->with('allimage', $allimage)
            ->with('old_image', $old_image)
            ->with('content', $viewCategory->content)
            ->with('old_products', $old_products);
    }

    public
    function update(Request $request, ViewCategory $viewCategory)
    {

//return dd($request);
        if ($request->image_id == null) {
            $uploadImage = $request->oldImage;
        } else {
            $uploadImage = $request->image_id;
        }

        if ($request->content == 'products')
            $product_ids = ($request->products !== null) ? implode(',', $request->products) : '';
        else
            $product_ids = ($request->categories !== null) ? implode(',', $request->categories) : '';

        $validator = Validator::make(
            ['name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'sort' => $request->sort,
            ], ['name_en' => 'required',
            'name_ar' => 'required',
            'sort' => 'required']);
        //check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } //check coupon already exist
        else {
            $viewCategory->update(array_merge($request->all(), ['image' => $uploadImage, 'product_ids' => $product_ids]));
            return redirect('admin/view_categories')
                ->with('success', Lang::get("labels.ViewCategoriesUpdatedMessage"));
        }

    }


    public
    function delete(Request $request)
    {
        $view_categories = DB::table('view_categories')->where('id', '=', $request->id)->delete();
        return redirect()->back()->withErrors([Lang::get("labels.view_categoriesDeletedMessage")]);
    }

}
