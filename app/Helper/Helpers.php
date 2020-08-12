<?php


use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Products;
use App\Models\Core\ProductsToCategory;
use App\Models\Core\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Table;


function formatDateToTimeLine($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return array(
        'month' => Carbon::parse($date)->monthName,
        'day' => Carbon::parse($date)->day,
        'all' => Carbon::parse($date)->day . '/' . Carbon::parse($date)->shortMonthName . '/' . Carbon::parse($date)->year,
    );
}

function dateFormFormat($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return Carbon::parse($date)->month . '/' . Carbon::parse($date)->day . '/' . Carbon::parse($date)->year;
}

function dateFormat($date)
{
//    return $expiryDate = str_replace('/', '-', $date);

    $y = '';
    if (isset($date)) {
        $x = (explode('-', $date));
        $y = $x[1] . '/' . $x[2] . '/' . $x[0];
    }
    return $y;

}


function getSetting()
{
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $setting = $myVarsetting->getSetting();
    return $setting;
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            if (setting('default_lang') != null)
                return setting('default_lang');
            else
                return 'ar';
        }

    }
}

function getProductsIdsAccordingForMainCategory($id)
{
    $ids = [];
    $products = ProductsToCategory::whereIn('categories_id', function ($query) use ($id) {
        $query->select('categories_id')
            ->from(with(new Categories())->getTable())
            ->where('parent_id', $id);
    })->orWhere('categories_id', $id)->get();
    foreach ($products as $product)
        $ids[] = $product->products_id;
    return $ids;
}

function getProductsIdsAccordingForSubCategory($id)
{
    $ids = [];
    $products = ProductsToCategory::all()->where('categories_id', $id);
    foreach ($products as $product)
        $ids[] = $product->products_id;
    return $ids;
}

function getAllImages()
{

    $images = new Images;
    return $images->getimages();
}

function getLanguage()
{
    $language = DB::table('languages')->get();
    return $language;
//    $all = [array('languages_id' => 'en', "name" => 'English'), array('languages_id' => 'ar', "name" => 'Arabic')];
//
//    $all = collect($all)->reject(function ($item) {
//    });
//    return $all;
}

function setEntryDateAttribute($input)
{
    return Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
}

if (!function_exists('datatable_lang')) {
    function datatable_lang()
    {
        return [
            'sEmptyTable' => trans('dataTable.sEmptyTable'),
            'sInfo' => trans('dataTable.sInfo'),
            'sInfoEmpty' => trans('dataTable.sInfoEmpty'),
            'sInfoFiltered' => trans('dataTable.sInfoFiltered'),
            'sInfoPostFix' => trans('dataTable.sInfoPostFix'),
            'sLengthMenu' => trans('dataTable.sLengthMenu'),
            'sInfoThousands' => trans('dataTable.sInfoThousands'),
            'sLoadingRecords' => trans('dataTable.sLoadingRecords'),
            'sProcessing' => trans('dataTable.sProcessing'),
            'sZeroRecords' => trans('dataTable.sZeroRecords'),
            'sSearch' => trans('dataTable.sSearch'),
            'oPaginate' => [
                'sNext' => trans('dataTable.sNext'),
                'sPrevious' => trans('dataTable.sPrevious'),
                'sFirst' => trans('dataTable.sFirst'),
                'sLast' => trans('dataTable.sLast'),
            ],
            'oAria' => [
                'sSortAscending' => trans('dataTable.sSortAscending'),
                'sSortDescending' => trans('dataTable.sSortDescending'),
            ],
        ];

    }
}


function changeOrder($request, $sortData, $sortData_id = 'id', $colSort = 'sort')
{
    foreach ($sortData as $element) {
        $element->timestamps = false; // To disable update_at field updation
        $id = $element->$sortData_id;
        foreach ($request->order as $order) {
            if ($order['id'] == $id) {
                $element->update([$colSort => $order['position']]);
            }
        }
    }

    return 1;
}

function getProductName($products_id, $language_id = 2)
{
    $data = DB::table('products_description')->where('products_id', '=', $products_id)
        ->where('language_id', '=', $language_id)->first();
    return $data->products_name;
}

function getProductOptionName($products_options_id, $language_id = 2)
{
    $data = DB::table('products_options_descriptions')
        ->where('products_options_id','=',$products_options_id)
        ->where('language_id','=',$language_id)
        ->first();
    return $data->options_name;
}

function getAttributeOptionName($products_options_id, $language_id = 2)
{
    $data = DB::table('products_options_values_descriptions')
        ->where('products_options_values_descriptions_id','=',$products_options_id)
//        ->where('language_id','=',$language_id)
        ->first();
    return $data->options_values_name;
}

function getApiLanguage($request)
{
    return (!empty($request->lang)) ? $request->lang : 2;
}

function getCategoriesToSelect()
{
    $items = DB::table('categories')
        ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
        ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
        ->where('language_id', '=', 2)
        ->where('parent_id', '0')
        //->orderby('categories_id','ASC')
        ->get();
    $data=[];
    $data[0]=trans('labels.MainCategories');
    foreach ($items as $item)
    {
        $data[$item->categories_id]=$item->categories_name;
    }
    return $data;
}
