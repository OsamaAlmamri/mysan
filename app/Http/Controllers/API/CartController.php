<?php

namespace App\Http\Controllers\API;

//use Mail;
//validator is builtin class in laravel
use App\Models\API\Cart;
use App\Models\API\Index;

//for password encryption or hash protected
use App\Models\API\Products;

//for authenitcate login data
use App\tempStorage;
use Carbon;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Lang;
use Session;

class CartController extends BaseAPIController
{

    public function __construct(
        Index $index,
        tempStorage $tempStorage,
        Products $products,
        Cart $cart
    )
    {
        $this->index = $index;
        $this->tempStorage = $tempStorage;
        $this->products = $products;
        $this->cart = $cart;

    }

    //myCart
    public function viewcart(Request $request)
    {

        $data = array();


        $result['cart'] = $this->cart->myCart($data,  getApiLanguage($request));
//        //apply coupon
//        $coupon = $this->tempStorage->getMultiTemp('coupon');
//        if ($coupon->count() > 0) {
//            $session_coupon_data = session('coupon');
//            session(['coupon' => array()]);
//            $response = array();
//            if (!empty($session_coupon_data)) {
//                foreach ($session_coupon_data as $key => $session_coupon) {
//                    $response = $this->cart->common_apply_coupon($session_coupon->code);
//                }
//            }
//        }
        return $this->sendNotFormatResponse($result);
    }

    //eidtCart
    public function editcart(Request $request, $id, $slug)
    {

        $title = array('pageTitle' => Lang::get('website.Product Detail'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsBySlug($slug);

        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category)) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;

        $i = 0;
        foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
            if ($i == 0) {
                $postCategoryId = $postCategory->categories_id;
                $i++;
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();

        $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $top_seller = $this->products->products($data);
        $result['top_seller'] = $top_seller;

        $result['cart'] = $this->cart->myCart($id);

        return view("web.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }

    //deleteCart


    public function deleteCart(Request $request)
    {

        $check = $this->cart->deleteCart($request);


        $session_coupon_data = $this->tempStorage->getMultiTemp('coupon');
        $this->tempStorage::where('user_id', auth()->user()->id)->delete();

        $response = array();
        if (!empty($session_coupon_data)) {
            foreach ($session_coupon_data as $key => $session_coupon) {
                $response = $this->cart->common_apply_coupon($session_coupon->val2);
            }
        }

        $message = Lang::get("website.Cart item has been deleted successfully");
        return $this->sendResponse($check, $message);
    }

    //getCart
    public function cartIdArray($request)
    {
        $this->cart->cartIdArray($request);
    }

    //updatesinglecart
    public function updatesinglecart(Request $request)
    {
        $this->cart->updatesinglecart($request);
        $final_theme = $this->index->finalTheme();
        return view("web.headers.cartButtons.cartButton" . $final_theme->header)->with('result', $result);
    }

    //addToCart
    public function addToCart(Request $request)
    {

        /*
         * {"data":[
  {
    "option_id": 1,
    "attributes_id":55
  },

  {
    "option_id": 1,
    "attributes_id": 56
  }
]}
         */

        $result = $this->cart->addToCart($request);
//        if (!empty($result['status']) && $result['status'] == 'exceed') {
//        }
        return $result;

//        $final_theme = $this->index->finalTheme();
//        return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
    }

    //addToCartFixed
    public function addToCartFixed(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
        return view("web.headers.cartButtons.cartButtonFixed")->with('result', $result);
    }

    //updateCart
    public function updateCart(Request $request)
    {
        $customers_id = auth()->id();
        $session_id = Session::getId();
        $carts=json_decode($request->data,false);
        foreach ($carts as $carts ) {
            $this->cart->updateRecord($carts->customers_basket_id, $customers_id, $session_id, $carts->quantity);
        }
        $message = Lang::get("website.Cart has been updated successfully");
        return $this->sendResponse('', $message);
    }

    //apply_coupon
    public function apply_coupon(Request $request)
    {

        $result = array();
        $coupon_code = $request->coupon_code;
        $carts = $this->cart->myCart(array());
//        return $carts;
        if (count($carts) > 0) {
            $response = $this->cart->common_apply_coupon($coupon_code);
        } else {
            $response = array('success' => '0', 'message' => Lang::get("website.Coupon can not be apllied to empty cart"));
        }
        return $this->sendNotFormatResponse(($response));
    }

    //removeCoupon
    public function removeCoupon(Request $request)
    {
        $coupons_id = $request->id;
        $session_coupon_data = $this->tempStorage->getMultiTemp('coupon');
        $this->tempStorage::where('user_id', auth()->id())->delete();

        $response = array();
        if (!empty($session_coupon_data)) {
            foreach ($session_coupon_data as $key => $session_coupon) {
                if ($session_coupon->val != $coupons_id) {
                    $response = $this->cart->common_apply_coupon($session_coupon->val2);
                }
            }
        }
        return $this->sendNotFormatResponse(($response));
    }

}
