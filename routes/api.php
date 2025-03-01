<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
//Route::post('projects/info', 'API\ProjectsController@getInfo');
//Route::post('projects/all', 'API\ProjectsController@getProjects');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});


Route::post('recursivecategories', 'API\IndexController@recursivecategories');
Route::post('allCategories', 'API\IndexController@allCategories');
Route::post('currencies', 'API\IndexController@currencies');
Route::post('manufacturers', 'API\IndexController@manufacturers');
Route::post('zones', 'API\ShippingAddressController@ajaxZones');
Route::post('filterProducts', 'API\ProductsController@shop');
Route::post('shop', 'API\ProductsController@shop');
Route::post('productDetail', 'API\ProductsController@productDetail');
Route::post('categoryProducts', 'API\ProductsController@shop');
Route::post('flash_sale', 'API\ProductsController@shop');
Route::post('top_seller', 'API\ProductsController@shop');
Route::post('most_liked', 'API\ProductsController@shop');
Route::post('featured', 'API\ProductsController@shop');
Route::post('specialProducts', 'API\ProductsController@shop');
Route::post('add_devices', 'API\IndexController@add_devices');
Route::post('index', 'API\IndexController@index');
Route::middleware('auth:api')->group(function () {
    Route::post('add_auth_devices', 'API\IndexController@add_auth_devices');
    Route::post('reviews', 'API\ProductsController@reviews');
    Route::post('addQuestion', 'API\ProductsController@addQuestion');
    Route::post('addReplay', 'API\ProductsController@addReplay');
    Route::post('updateQuestion', 'API\ProductsController@updateQuestion');
    Route::post('deleteQuestion', 'API\ProductsController@deleteQuestion');
    Route::post('updateReplay', 'API\ProductsController@updateReplay');
    Route::post('deleteReplay', 'API\ProductsController@deleteReplay');
    Route::post('likeMyProduct', 'API\CustomersController@likeMyProduct');
    Route::post('addToCart', 'API\CartController@addToCart');
    Route::post('deleteFromCart', 'API\CartController@deleteCart');

    Route::post('getquantity', 'API\ProductsController@getquantity');
    Route::post('apply_coupon', 'API\CartController@apply_coupon');
    Route::post('removeCoupon', 'API\CartController@removeCoupon');
    Route::post('updateCart', 'API\CartController@updateCart');

    Route::post('viewcart', 'API\CartController@viewcart');
    Route::post('updateMyPassword', 'API\CustomersController@updateMyPassword');
//    Route::post('processPassword', 'API\CustomersController@processPassword');
    Route::post('updateMyProfile', 'API\CustomersController@updateMyProfile');


    Route::post('my_address', 'API\ShippingAddressController@my_address');
    Route::post('shipping_address', 'API\ShippingAddressController@shippingAddress');
    Route::post('addMyAddress', 'API\ShippingAddressController@addMyAddress');
    Route::post('myDefaultAddress', 'API\ShippingAddressController@myDefaultAddress');
    Route::post('update_address', 'API\ShippingAddressController@updateAddress');
    Route::post('wishlist', 'API\ProductsController@shop');
    Route::post('delete_address', 'API\ShippingAddressController@deleteAddress');


    Route::post('getProduct', 'API\IndexController@getProduct');


    /**********************************************/
    Route::get('guest_checkout', 'API\OrdersController@guest_checkout');
    Route::post('checkout', 'API\OrdersController@checkout');
    Route::post('checkout_shipping_address', 'API\OrdersController@checkout_shipping_address');
    Route::post('checkout_billing_address', 'API\OrdersController@checkout_billing_address');
    Route::post('checkout_payment_method', 'API\OrdersController@checkout_payment_method');
    Route::post('paymentComponent', 'API\OrdersController@paymentComponent');
    Route::post('place_order', 'API\OrdersController@place_order');
    Route::get('orders', 'API\OrdersController@orders');
    Route::post('updatestatus/', 'API\OrdersController@updatestatus');
    Route::post('myorders', 'API\OrdersController@myorders');
    Route::get('stripeForm', 'API\OrdersController@stripeForm');
    Route::get('view-order/{id}', 'API\OrdersController@viewOrder');
    Route::post('pay-instamojo', 'API\OrdersController@payIinstamojo');
    Route::get('thankyou', 'API\OrdersController@thankyou');


    Route::post('userInfo', 'API\AuthController@userInfo');//

});
