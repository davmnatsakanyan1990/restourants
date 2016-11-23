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

/*Route::get('/home', function () {
    return view('home');
});

Route::get('/current', function () {
    return view('current');
});
*/
use App\Models\Place;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layouts.main');
});

// Templates
Route::group(['prefix' => 'templates'], function () {
    Route::get('{folder}/{page}', function ($folder, $page) {
        return view('templates.' . $folder . '.' . $page)->render();
    });
});

/**
 * User route part
 */
Route::group([
    'prefix' => 'user',
    'namespace' => 'Auth'
],
    function(){
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('logout', 'AuthController@logout');

        Route::get('is_auth', 'AuthController@isAuth');

        Route::get('auth/{provider}', 'AuthController@redirectToProvider');
        Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
    });


//Route::auth();

/**
 * Admin route part
 */

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin\Auth',
],
    function(){
        Route::get('login', 'AuthController@showLoginForm');
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout');
    });

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
],
    function(){
        Route::get('dashboard', 'DashboardController@index');
    });

Route::group([
    'prefix' => 'admin/place',
    'namespace' => 'Admin',
],
    function(){
        Route::get('edit', 'PlaceController@edit');
        Route::post('update', 'PlaceController@update');
    });

Route::group([
    'prefix' => 'admin/profile',
    'namespace' => 'Admin',
],
    function(){
        Route::get('edit', 'AdminController@edit');
        Route::post('update/pers_info', 'AdminController@update_pers_info');
        Route::post('update/sec_info', 'AdminController@update_sec_info');
    });

Route::group([
    'prefix' => 'admin/payment',
    'namespace' => 'Admin',
],
    function(){
        Route::get('subscribe', 'PaymentController@subscribe');
        Route::post('pay','PaymentController@pay');
    });

/**
 * Comments route
 */
Route::group([
    'prefix' => 'comment',
],
    function(){
        Route::post('add', 'CommentController@create');
    });



Route::get('{city}/restaurants', 'PlaceController@index');
Route::get('{city}/restaurants/more', 'PlaceController@loadMore');
Route::get('{city}/restaurants/filter', 'PlaceController@filter');
Route::get('restaurants/category/{data}', 'PlaceController@getCategoryProducts');
Route::get('show/{id}', 'PlaceController@show');
Route::get('products/{menu_id}', 'PlaceController@products');

Route::get('comments', 'PlaceController@moreComments');
Route::get('sendmail/{email}', 'UserController@sendMail');


/**
 * Routes for API call
 */
Route::get('move/images', 'ApiController@movePlaceImages');
Route::post('fill/places', 'ApiController@fillPlace');
Route::get('fill/cuisines', 'ApiController@fillCuisines');
Route::get('fill/locations', 'ApiController@fillLocations');
Route::get('assign/category', 'ApiController@assignCategory');
Route::get('assign/type', 'ApiController@assignType');


Route::get('run_cron', function(){
    phpinfo();
});


