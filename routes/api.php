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
//Route::post('register', 'API\AuthController@register');
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


    Route::get('/page', 'API\IndexController@page');
    Route::get('index','API\IndexController@index');
    Route::get('/contact', 'API\IndexController@contactus');
    Route::post('/processContactUs', 'API\IndexController@processContactUs');

    Route::get('/setcookie', 'API\IndexController@setcookie');
    Route::get('/newsletter', 'API\IndexController@newsletter');

    Route::get('/subscribeMail', 'API\IndexController@subscribeMail');









    Route::post('getAllBlockPersonsPerZone', 'API\ProjectApiController@getAllBlockPersonsPerZone');//
    Route::post('saveIncommingBlockPersion', 'API\ProjectApiController@saveIncommingBlockPersion');
    Route::post('getAllUsers', 'API\ProjectApiController@getAllUsers');//
    Route::post('getAllQuarantineTypes', 'API\ProjectApiController@getAllQuarantineTypes');//
    Route::post('getMyAddBlockPerson', 'API\ProjectApiController@getMyAddBlockPerson');//
    Route::post('getBlockPerson', 'API\ProjectApiController@getBlockPerson');//
    Route::post('getAllZones', 'API\ProjectApiController@getAllZones');//
    Route::post('getAllQuarantines', 'API\ProjectApiController@getAllQuarantines');//
    Route::post('getAllCheckPoint', 'API\ProjectApiController@getAllCheckPoint');//
    Route::post('getAllBlockPersonsPerCenter', 'API\ProjectApiController@getAllBlockPersonsPerCenter');//
    Route::post('getMyAddBlockPerson', 'API\ProjectApiController@getMyAddBlockPerson');//




    Route::post('userInfo', 'API\AuthController@userInfo');//

});

