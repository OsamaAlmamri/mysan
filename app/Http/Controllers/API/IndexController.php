<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Web\ThemeController;
use App\Models\Core\Categories;
use App\Models\API\Currency;
use App\Models\API\Index;
use App\Models\API\Languages;
use App\Models\API\News;
use App\Models\API\Order;
use App\Models\API\Products;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class IndexController extends BaseAPIController
{

    public function __construct(
        Index $index,
        News $news,
        Languages $languages,
        Products $products,
        Currency $currency,
        Order $order,
        Categories $categories
    )
    {
        $this->index = $index;
        $this->order = $order;
        $this->news = $news;
        $this->categories = $categories;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->theme = new ThemeController();
    }


    public function index()
    {


        $result = array();
        $this->index->commonContent();

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 12;
        }

        /**  MINIMUM PRICE **/
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        /**  MAXIMUM PRICE  **/
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }
        /*************************************************************************/
        /*********************************************************************/
        /**                     FETCH NEWEST PRODUCTS                       **/
        /*********************************************************************/


        $data = array(

            'page_number' => '0',
            'type' => '',
            'limit' => 10,
            'min_price' => $min_price,
            'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);

        $newest_products = $this->products->products($data);
        $result['products'] = $newest_products;
        /*********************************************************************/
        /**                     Compare Counts                              **/
        /*********************************************************************/

        /*********************************************************************/

        /***************************************************************/
        /**   CART ARRAY RECORDS TO CHECK WETHER OR NOT DISPLAYED--   **/
        /**  --PRODUCT HAS BEEN ALREADY ADDE TO CART OR NOT           **/
        /***************************************************************/
        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
        /**************************************************************/

//special products
        $data = array('page_number' => '0', 'type' => 'special', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        $special_products = $this->products->products($data);
        $result['special'] = $special_products;
//Flash sale

        $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        $flash_sale = $this->products->products($data);
        $result['flash_sale'] = $flash_sale;
// //top seller
        $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        $top_seller = $this->products->products($data);
        $result['top_seller'] = $top_seller;

//most liked
        $data = array('page_number' => '0', 'type' => 'mostliked', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        $most_liked = $this->products->products($data);
        $result['most_liked'] = $most_liked;

//is feature
        $data = array('page_number' => '0', 'type' => 'is_feature', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        $featured = $this->products->products($data);
        $result['featured'] = $featured;

        $data = array('page_number' => '0', 'type' => '', 'limit' => '15', 'is_feature' => 1,'lang' => (!empty($request->lang))?$request->lang:2);
        $news = $this->news->getAllNews($data);
        $result['news'] = $news;
//current time

        $currentDate = Carbon\Carbon::now();
        $currentDate = $currentDate->toDateTimeString();

        //liked products
        $result['liked_products'] = $this->products->likedProducts();

        $orders = $this->order->getOrders();
        if (count($orders) > 0) {
            $allOrders = $orders;
        } else {
            $allOrders = $this->order->allOrders();
        }

        $temp_i = array();
        foreach ($allOrders as $orders_data) {
            $mostOrdered = $this->order->mostOrders($orders_data);
            foreach ($mostOrdered as $mostOrderedData) {
                $temp_i[] = $mostOrderedData->products_id;
            }
        }
        $detail = array();
        $temp_i = array_unique($temp_i);
        foreach ($temp_i as $temp_data) {
            $data = array('page_number' => '0', 'type' => 'topseller', 'products_id' => $temp_data, 'limit' => 7, 'min_price' => '', 'max_price' => '','lang' => (!empty($request->lang))?$request->lang:2);
            $single_product = $this->products->products($data);
            if (!empty($single_product['product_data'][0])) {
                $detail[] = $single_product['product_data'][0];
            }
        }

        $result['weeklySoldProducts'] =
            array('success' => '1',
                'product_data' => $detail,
                'message' => "Returned all products.",
                'total_record' => count($detail));


//        return dd($result);
        return $this->sendResponse($result, '');

//        return view("web.index", ['title' => $title, 'final_theme' => $final_theme])->with(['result' => $result]);
    }

    public function filterData(Request $request)
    {

        /*********************************************************************/
//        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $title = array('pageTitle' => Lang::get("website.Home"));
        /********************************************************************/

        /*********************************************************************/
        /**                   GENERAL SETTINGS TO FETCH PRODUCTS           **/
        /*******************************************************************/

        /**  SET LIMIT OF PRODUCTS  **/
        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 12;
        }

        /**  MINIMUM PRICE **/
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        /**  MAXIMUM PRICE  **/
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }
        /**  MAXIMUM PRICE  **/
        if (isset($request->type)) {
            $type = $request->type;
        } else {
            $type = 'is_feature';
        }

        /*************************************************************************/
        /*********************************************************************/
        /**                     FETCH NEWEST PRODUCTS                       **/
        /*********************************************************************/


        if ($type === 'newest')
            $data = array(
                'page_number' => '0',
                'type' => '',
                'limit' => 10,
                'min_price' => $min_price,
                'max_price' => $max_price
            ,'lang' => (!empty($request->lang))?$request->lang:2);
        elseif ($type === 'special_products')
            $data = array('page_number' => '0',
                'type' => 'special',
                'limit' => $limit,
                'min_price' => $min_price,
                'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        elseif ($type === 'flash_sale')
            $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);
        elseif ($type === 'top_seller')
            $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);

        elseif ($type === 'most_liked')
            $data = array('page_number' => '0', 'type' => 'mostliked', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);

//        elseif ($type == 'is_feature')
        else
            $data = array('page_number' => '0', 'type' => 'is_feature', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'lang' => (!empty($request->lang))?$request->lang:2);


        $featured = $this->products->products($data);
        return $this->sendNotFormatResponse($featured);


    }

    public function recursivecategories(Request $request)
    {
        $lang = (isset($request->lang) and $request->lang < 3) ? $request->lang : 2;
        $result = $this->categories->recursivecategories2($lang);
        return $this->sendResponse($result, '');
    }

    public function allCategories(Request $request)
    {
        $lang = (isset($request->lang) and $request->lang < 3) ? $request->lang : 2;
        $parent = (isset($request->parent)) ? $request->parent : 0;
        $result = $this->categories->allCategories2($lang, $parent);
        return $this->sendResponse($result, '');
    }

    public function getProduct(Request $request)
    {
        $lang = (isset($request->lang) and $request->lang < 3) ? $request->lang : 2;
        $parent = (isset($request->parent)) ? $request->parent : 0;
        $result = $this->products->getProduct($request);
        return $this->sendResponse($result, '');
    }


}
