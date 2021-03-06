<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Redirect ke halaman login ketika membuka aplikasi */
Route::get('/', function () {
    return redirect('login');
});

    // Authentication routes
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    // Registration routes (tidak digunakan)
    // Route::get('register', 'Auth\AuthController@getRegister');
    // Route::post('register', 'Auth\AuthController@postRegister');

    Route::group(['middleware' => 'auth'], function () {

    /* Dashboard sebagai halaman pertama setelah login */
        Route::get('home', 'DashboardController@getIndex');

    /* My Account (Update Profile & Password) */
        Route::get('user/profile', 'AuthController@getMyAccount');
        Route::post('user/update-profile', 'AuthController@postUpdateProfile');
        Route::post('user/update-password', 'AuthController@postUpdatePassword');

    /* Provide controller methods with object instead of ID */
        Route::model('item', 'App\Item');

    /* Datatable */
        Route::post('datatable/items', 'ItemController@datatable');
        Route::post('datatable/transactions', 'TransactionController@datatable');
        Route::post('datatable/report', 'ReportsController@datatable');

    /* Select2 */
        Route::post('select2/items', 'ItemController@select2');

    /* Master */
        Route::resource('item', 'ItemController');
        Route::controller('item', 'ItemController');

    /* Transaction */
            Route::get('transaction/print', 'TransactionController@printDoc');
        Route::resource('transaction', 'TransactionController');

    /* Report */
        Route::get('report', 'ReportsController@getIndex');
    /* System */
    });
