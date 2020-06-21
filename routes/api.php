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
Route::middleware('auth:api')->group(function () {

    Route::get('index', 'API\IndexController@index');
    Route::post('recursivecategories', 'API\IndexController@recursivecategories');
    Route::post('allCategories', 'API\IndexController@allCategories');
    Route::post('specialProducts', 'API\IndexController@filterData');


    Route::post('reviews', 'API\ProductsController@reviews');
    Route::post('currencies', 'API\IndexController@currencies');
    Route::post('manufacturers', 'API\IndexController@manufacturers');

    Route::post('likeMyProduct', 'API\CustomersController@likeMyProduct');
    Route::post('addToCart', 'API\CartController@addToCart');
    Route::post('deleteCart', 'API\CartController@deleteCart');

    Route::post('getquantity', 'API\ProductsController@getquantity');
    Route::post('apply_coupon', 'API\CartController@apply_coupon');
    Route::post('removeCoupon', 'API\CartController@removeCoupon');
    Route::post('updateCart', 'API\CartController@updateCart');
    Route::post('viewcart', 'API\CartController@viewcart');
    Route::post('updateMyPassword', 'API\CustomersController@updateMyPassword');
//    Route::post('processPassword', 'API\CustomersController@processPassword');
    Route::post('updateMyProfile', 'API\CustomersController@updateMyProfile');


    Route::post('shipping_address', 'API\ShippingAddressController@shippingAddress');
    Route::post('addMyAddress', 'API\ShippingAddressController@addMyAddress');
    Route::post('myDefaultAddress', 'API\ShippingAddressController@myDefaultAddress');
    Route::post('update_address', 'API\ShippingAddressController@updateAddress');
    Route::post('delete_address', 'API\ShippingAddressController@deleteAddress');
    Route::post('zones', 'API\ShippingAddressController@ajaxZones');

    Route::post('filterProducts', 'API\ProductsController@shop');
    Route::post('shop', 'API\ProductsController@shop');
    Route::post('productDetail', 'API\ProductsController@productDetail');
    Route::post('wishlist', 'API\ProductsController@shop');
    Route::post('categoryProducts', 'API\ProductsController@shop');
    Route::post('flash_sale', 'API\ProductsController@shop');
    Route::post('top_seller', 'API\ProductsController@shop');
    Route::post('most_liked', 'API\ProductsController@shop');
    Route::post('featured', 'API\ProductsController@shop');


    Route::post('getProduct', 'API\IndexController@getProduct');




    Route::post('userInfo', 'API\AuthController@userInfo');//

});

