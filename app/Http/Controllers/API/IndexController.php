<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Web\ThemeController;
use App\Models\API\Manufacture;
use App\Models\Core\Categories;
use App\Models\API\Currency;
use App\Models\API\Index;
use App\Models\API\Languages;
use App\Models\API\News;
use App\Models\API\Order;
use App\Models\API\Products;
use App\Models\Core\Device;
use App\ViewCategory;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Validator;

class IndexController extends BaseAPIController
{

    public function __construct(
        Index $index,
        News $news,
        Languages $languages,
        ViewCategory $viewCategories,
        Products $products,
        Currency $currency,
        Order $order,
        Categories $categories,
        Manufacture $manufacturers
    )
    {
        $this->index = $index;
        $this->order = $order;
        $this->news = $news;
        $this->categories = $categories;
        $this->languages = $languages;
        $this->products = $products;
        $this->viewCategories = $viewCategories;
        $this->currencies = $currency;
        $this->manufacturers = $manufacturers;
        $this->theme = new ThemeController();
    }


    public function getViewCategories($data, $lang)
    {

        $allViewCategories = ViewCategory::all()->where('parent', 1)->sortBy('sort');
        $categories = [];
        foreach ($allViewCategories as $category) {
            if ($category->content == 'products')
                $products = $this->products->products($data, explode(',', $category->product_ids))['product_data'];
            else
                $products = $this->viewCategories->subViewCategories(explode(',', $category->product_ids), $lang);
            $categories[] = array(
                'id' => $category->id,
                'content' => $category->content,
                'image' => $category->imagePath->imagesTHUMBNAIL->path,
                'name' => ($lang == 1) ? $category->name_en : $category->name_ar,
                'products' => $products,
            );
        }
        return $categories;


    }

    public function index(Request $request)
    {
        $result = array();
        $this->index->commonContent();

        $limit = (!empty($request->limit)) ? $request->limit : 12;
        $max_price = (!empty($request->max_price)) ? $request->max_price : '';
        $min_price = (!empty($request->min_price)) ? $request->min_price : '';
        $search = (!empty($request->search)) ? $request->search : '';
        $lang =  getApiLanguage($request);
        $page_number = (!empty($request->page)) ? $request->page : 0;

        //getViewCategories
        $data = array('page_number' => '0', 'type' => 'ViewCategories', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
        $special_products = $this->getViewCategories($data, $lang);
        $result['data'] = $special_products;

//
//        $data = array('page_number' => $page_number, 'type' => '', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//
//        $newest_products = $this->products->products($data);
//        $result['newest_products'] = $newest_products['product_data'];
//        /***************************************************************/
//        $cart = '';
//        $result['cartArray'] = $this->products->cartIdArray($cart);
//        /**************************************************************/
//
//
////special products
//        $data = array('page_number' => '0', 'type' => 'special', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//        $special_products = $this->products->products($data);
//        $result['special_products'] = $special_products['product_data'];
//
//        //Flash sale
//
//        $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//        $flash_sale = $this->products->products($data);
//        $result['flash_sale_products'] = $flash_sale['product_data'];
//// //top seller
//        $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//        $top_seller = $this->products->products($data);
//        $result['top_seller_products'] = $top_seller['product_data'];
//
////most liked
//        $data = array('page_number' => '0', 'type' => 'mostliked', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//        $most_liked = $this->products->products($data);
//        $result['most_liked_products'] = $most_liked['product_data'];
//
////is feature
//        $data = array('page_number' => '0', 'type' => 'is_feature', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => $lang);
//        $featured = $this->products->products($data);
//        $result['featured_products'] = $featured['product_data'];
//
////current time
//        $currentDate = Carbon\Carbon::now();
//        $currentDate = $currentDate->toDateTimeString();
//
//        //liked products
//        $result['liked_products'] = $this->products->likedProducts();
//        $orders = $this->order->getOrders();
//        if (count($orders) > 0) {
//            $allOrders = $orders;
//        } else {
//            $allOrders = $this->order->allOrders();
//        }
//
//        $temp_i = array();
//        foreach ($allOrders as $orders_data) {
//            $mostOrdered = $this->order->mostOrders($orders_data);
//            foreach ($mostOrdered as $mostOrderedData) {
//                $temp_i[] = $mostOrderedData->products_id;
//            }
//        }
//        $detail = array();
//        $temp_i = array_unique($temp_i);
//        foreach ($temp_i as $temp_data) {
//            $data = array('page_number' => '0', 'type' => 'topseller', 'products_id' => $temp_data, 'limit' => 7, 'min_price' => '', 'max_price' => '', 'lang' => $lang);
//            $single_product = $this->products->products($data);
//            if (!empty($single_product['product_data'][0])) {
//                $detail[] = $single_product['product_data'][0];
//            }
//        }
//        $result['weeklySoldProducts'] = $detail;

        return $this->sendNotFormatResponse($result);
    }

    public function recursivecategories(Request $request)
    {
        $lang =  getApiLanguage($request);
        $result = $this->categories->recursivecategories2($lang);
        return $this->sendResponse($result, '');
    }

    public function allCategories(Request $request)
    {
        $lang =  getApiLanguage($request);
        $parent = (isset($request->parent)) ? $request->parent : 0;
        $result = $this->categories->allCategories2($lang, $parent);
        return $this->sendResponse($result, '');
    }

    public function getProduct(Request $request)
    {
        $lang =  getApiLanguage($request);
        $parent = (isset($request->parent)) ? $request->parent : 0;
        $result = $this->products->getProduct($request);
        return $this->sendResponse($result, '');
    }

    public function currencies(Request $request)
    {
        $result = $this->currencies->getter();
        return $this->sendResponse($result, 'currencies');
    }

    public function manufacturers(Request $request)
    {
        $result = $this->manufacturers->getter($request->lang);
        return $this->sendResponse($result, 'currencies');
    }

    public function add_devices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
            'device_type' => 'required',
            'device_model' => 'required',
            'manufacturer' => 'required',
            'device_mac' => 'required',
            'device_os' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('error validation', $validator->errors(), 422);
        }
        $devices = Device::where('device_mac', $request->device_mac)
            ->where('device_id', 'not like', $request->device_id)
            ->where('user_id', '=', 0)
            ->delete();
        $device = Device::all()
            ->where('device_id', 'like', $request->device_id)
            ->where('device_mac', 'like', $request->device_mac)
            ->where('user_id', '=', 0)
            ->first();
        $data = $request->all();
        if ($device == null)
            Device::create($data);
        else
            $device->update($data);
        return $this->sendResponse(1, '');
    }

    public function add_auth_devices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
            'device_type' => 'required',
            'device_model' => 'required',
            'manufacturer' => 'required',
            'device_mac' => 'required',
            'device_os' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('error validation', $validator->errors(), 422);
        }
        $devices = Device::where('device_mac', $request->device_mac)
            ->where('device_id', 'not like', $request->device_id)->delete();
        $device = Device::all()
            ->where('device_id', 'like', $request->device_id)
            ->where('device_mac', 'like', $request->device_mac)
            ->first();
        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        if ($device == null)
            Device::create($data);
        else
            $device->update($data);
        return $this->sendResponse(1, '');
    }


}
