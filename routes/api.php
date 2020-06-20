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
    //getAllBlockPersonsPerZone,
    //saveIncommingBlockPersion,
    //getAllQuarantineTypes,
    //getMyAddBlockPerson,
    //getBlockPerson,
    //getAllZones,
    //getAllQuarantines,
    //getAllCheckPoint,
    //getAllBlockPersonsPerCenter,
    //userInfo,//


    Route::get('index', 'API\IndexController@index');
    Route::post('recursivecategories', 'API\IndexController@recursivecategories');
    Route::post('allCategories', 'API\IndexController@allCategories');
    Route::post('specialProducts', 'API\IndexController@filterData');

    Route::post('filterProducts', 'API\ProductsController@filterProducts');
    Route::post('shop', 'API\ProductsController@shop');
    Route::post('productDetail', 'API\ProductsController@productDetail');
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
    Route::post('wishlist', 'API\CustomersController@wishlist');
    Route::post('updateMyPassword', 'API\CustomersController@updateMyPassword');
//    Route::post('processPassword', 'API\CustomersController@processPassword');
    Route::post('updateMyProfile', 'API\CustomersController@updateMyProfile');






    Route::post('categoryProducts', 'API\IndexController@categoryProducts');
    Route::post('getProduct', 'API\IndexController@getProduct');
    Route::post('flash_sale', 'API\IndexController@flash_sale');
    Route::post('top_seller', 'API\IndexController@top_seller');
    Route::post('most_liked', 'API\IndexController@most_liked');
    Route::post('featured', 'API\IndexController@featured');
    Route::post('weeklySoldProducts', 'API\IndexController@weeklySoldProducts');



    Route::post('userInfo', 'API\AuthController@userInfo');//

});

