<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'AdminController@index');
    });

    Route::get('/update', function() {

        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        dd('Updated');
    });

    Route::resource('roles', 'RoleController');
    Route::get('user_roles_list', 'RoleController@getRoles')->name('get.user_roles');

    Route::resource('permissions', 'PermissionController');

    Route::resource('users', 'UserController');
    Route::get('users_list', 'UserController@getUserList')->name('get.users');
    Route::get('my_profile', [\Modules\Admin\Http\Controllers\UserController::class, 'show'])->middleware('auth');


    Route::get('change_password', 'UserController@changePasswordView');
    Route::post('change_password', 'UserController@updatePassword');

    Route::post('user/change_status', 'UserController@userChangeStatus');

    Route::post('change_user_theme', 'UserController@changeUserTheme');

    Route::post('media_upload', 'MediaController@uploadMedia');
    Route::post('delete_media', 'MediaController@deleteMedia');
    Route::post('update_media_order', 'MediaController@updateMediaOrder');

    Route::post('control-form-upload', 'ProductController@controlFormUploadPost')->name('control-form.upload.post');
    Route::post('br-form-upload', 'ProductController@BRFormUploadPost')->name('br-form.upload.post');

    Route::get('get_configs_list', 'ConfigController@getConfigsList')->name('get.all_configs');
    Route::get('get_config_categories_list', 'ConfigCategoriesController@getConfigCategoriesList')->name('get.all_config_categories');

    Route::resource('configurations', 'ConfigController');
    Route::resource('config_categories', 'ConfigCategoriesController');

    Route::resource('product', 'ProductController');
    Route::get('products_list', 'ProductController@getProductList')->name('get.products');
});
