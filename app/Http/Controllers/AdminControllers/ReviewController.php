<?php

namespace App\Http\Controllers\AdminControllers;

use App\DataTables\ReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\ProductQuestion;
use App\Models\Core\Products;
use App\Models\Core\Reviews;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ReviewController extends Controller

{
    public function __construct(Products $products, Languages $language, Images $images,
                                Categories $category, Setting $setting, Reviews $reviews)
    {
        $this->category = $category;
        $this->reviews = $reviews;
        $this->language = $language;
        $this->images = $images;
        $this->products = $products;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;
    }

    public function reviews(Request $request)
    {


        $reviews = new ReviewsDataTable();
        $title = array('pageTitle' => Lang::get("labels.reviews"));
        $result = array();
        $data = $this->reviews->paginator();
        $result['reviews'] = $data;
        $result['commonContent'] = $this->Setting->commonContent();
        return $reviews->render('admin.reviews.index', ['title' => $title, 'result' => $result]);

    }

    public function editreviews($id, $status)
    {
        if ($status == 1) {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_status' => 1,
                ]);
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                ]);
        } elseif ($status == 0) {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                ]);
        } else {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                    'reviews_status' => -1,
                ]);
        }
        $message = Lang::get("labels.reviewupdateMessage");
        return redirect()->back()->withErrors([$message]);

    }

    public function getData($product, $main, $sub, $from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        if ($main == 'all' and $sub == 'all' and $product == 'all')
            $ids = 'all';
        elseif ($main > 0 and $sub == 'all' and $product == 'all')
            $ids = getProductsIdsAccordingForMainCategory($main);
        elseif (
            ($main == 'all' and $sub > 0 and $product == 'all') or
            ($main > 0 and $sub > 0 and $product == 'all'))
            $ids = getProductsIdsAccordingForSubCategory($sub);
        else
            $ids = [$product];
        $data = DB::table('reviews')
            ->leftJoin('users', 'reviews.customers_id', 'users.id')
            ->leftJoin('reviews_description', 'reviews.reviews_id', 'reviews_description.review_id')
            ->leftJoin('products_description', 'reviews.products_id', 'products_description.products_id')
            ->select('reviews.*',
                DB::raw("CONCAT(COALESCE(users.first_name,'') , '  ' ,COALESCE(users.last_name,'')) AS user"),
                'products_description.products_name');
        if (!($main == 'all' and $sub == 'all' and $product == 'all'))
            $data = $data->whereIn('reviews.products_id', $ids);
        $data = $data
            ->whereBetween('reviews.created_at', [$from_date, $to_date])
            ->groupBy('reviews.reviews_id')->get();
        return $data;
    }

    public function filter2(Request $request)
    {

        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getData($request->product, $request->main, $request->sub, $from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.reviews.btn.manage')
            ->addColumn('btn_id', 'admin.reviews.btn.id')
            ->rawColumns(['manage', 'btn_id'])
            ->make(true);
    }

    public function getCategories(Request $request)
    {
        $allData = [];
        $data = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id');
        if ($request->id == 'all') {
            $data = $data->where('categories.parent_id', '=', 0);
        } else
            $data = $data->where('categories.parent_id', '=', $request->id);
        $data = $data->where('language_id', 2)
            ->get();
        $options = '';
        if ($request->type == 'all')
            $options .= '<option value="all"> ' . trans('labels.all') . '</option>';
        foreach ($data as $category) {
            $options .= '<option value="' . $category->categories_id . '"> ' . $category->categories_name . '</option>';
        }
        $x = $data->first();
        $first_id = ($x != null) ? $x->categories_id : 0;
        $parent_id = ($x != null) ? $x->parent_id : 0;
        return response(['data' => $options, 'id' => $first_id, 'parent_id' => $parent_id], 200);


    }

    public function getProducts(Request $request)
    {
        $allData = [];
        $data = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
            ->where('products_description.language_id', '=', 2);
        if ($request->main_id == 'all' and $request->sub_id == 'all')
            $data = $data->where('products_to_categories.categories_id', '>', 0);
        elseif ($request->main_id != 'all' and $request->sub_id == 'all')
            $data = $data->where('categories.parent_id', '=', $request->main_id);
        else
            $data = $data->where('products_to_categories.categories_id', '=', $request->sub_id);
        $data = $data->where('categories_description.language_id', '=', 2)->get();
        $options = '';
//        if ($request->type == 'all')
        $options .= '<option value="all" selected> ' . trans('labels.all') . '</option>';
        foreach ($data as $product) {
            $options .= '<option value="' . $product->products_id . '"> ' . $product->products_name . '</option>';
        }
        return response(['data' => $options], 200);

    }

}
