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

//Route::get('/product', function ()
//{
//    return 'test';
//});

//Route::middleware('auth:api')->get('/admin', function (Request $request) {
////    return $request->user();
//
////    Route::resource('product', 'ProductController');
//    Route::post('products_list', 'ProductController@getProductList')->name('get.products');
//});

Route::group(['prefix' =>  'admin' ], function () {
    Route::group(['middleware' => ['auth:api']], function() {
        Route::get('products_list', 'ProductController@getProductList');
        Route::post('product/create', 'ProductController@store');
    });
});



