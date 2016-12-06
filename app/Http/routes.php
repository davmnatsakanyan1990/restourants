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

use App\Models\Place;

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
 * Super admin route part
 */
Route::group([
    'prefix' => 'super_admin',
    'namespace' => 'SuperAdmin\Auth'
],
    function(){
        Route::get('login', 'AuthController@showLoginForm');
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout');
    });

Route::group([
    'prefix' => 'super_admin',
    'namespace' => 'SuperAdmin'
],
    function(){
        Route::get('dashboard', 'HomeController@index');
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
        Route::post('place_order','PaymentController@placeOrder');
        Route::get('checkout','PaymentController@checkout');
        Route::post('enterprise/sendmail','PaymentController@sendMail');
        Route::get('{country}/states','PaymentController@getStates');
        
    });

Route::group([
    'prefix' => 'admin/billing_details',
    'namespace' => 'Admin',
],
    function(){
        Route::get('edit', 'BillingDetailsController@edit');
        Route::post('update','BillingDetailsController@update');
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
Route::get('root/data', 'HomeController@getRootData');
Route::get('{city}/restaurants/more', 'PlaceController@loadMore');
Route::get('{city}/restaurants/filter', 'PlaceController@filter');
Route::get('restaurants/category/{data}', 'PlaceController@getCategoryProducts');
Route::get('show/{id}', 'PlaceController@show');
Route::get('products/{menu_id}', 'PlaceController@products');
Route::get('search', 'PlaceController@search');

Route::get('comments', 'PlaceController@moreComments');
Route::get('sendmail/{email}', 'UserController@sendMail');
Route::post('add_organization', 'HomeController@addOrganization');
Route::post('detect_user_city', 'HomeController@detectUserCity');


/**
 * Routes for API call
 */
Route::get('move/images', 'ApiController@movePlaceImages');
Route::post('fill/places', 'ApiController@fillPlace');
Route::get('fill/cuisines', 'ApiController@fillCuisines');
Route::get('fill/locations', 'ApiController@fillLocations');
Route::get('assign/category', 'ApiController@assignCategory');
Route::get('assign/type', 'ApiController@assignType');
Route::get('fill/support_ids', 'ApiController@fillSupportId');


Route::get('run_cron', function(){
    $places = Place::whereNotNull('first_login')->where('plan_id', 1)->get()->toArray();

    // get current date time in Unix format
    $now = strtotime(date("Y-m-d H:i:s"));

    foreach($places as $place){

        //get email sent time in Unix format
        $activation_date = strtotime($place['first_login']);

        // deactivate place after 5 day
        if($now > $activation_date + 432000){
            Place::where('id', $place['id'])->delete();
        }
    }
});

Route::get('test', function (\Illuminate\Support\Facades\Request $request){
    dd($request->ip());
});


