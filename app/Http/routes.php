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

        Route::get('auth/facebook', 'AuthController@redirectToProvider');
        Route::get('auth/facebook/callback', 'AuthController@handleProviderCallback');
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

/**
 * Comments route
 */
Route::group([
    'prefix' => 'comment',
],
    function(){
        Route::post('add', 'CommentController@create');
    });



Route::get('restaurants', 'PlaceController@index');
Route::get('restaurants/more', 'PlaceController@loadMore');
Route::get('restaurants/filter', 'PlaceController@filter');
Route::get('show/{id}', 'PlaceController@show');
Route::get('products/{menu_id}', 'PlaceController@products');


/**
 * Routes for API call
 */
Route::get('move/images', 'ApiController@movePlaceImages');
Route::post('fill/places', 'ApiController@fillPlace');
Route::get('fill/cuisines', 'ApiController@fillCuisines');
Route::get('fill/locations', 'ApiController@fillLocations');
Route::get('assign/category', 'ApiController@assignCategory');
Route::get('assign/type', 'ApiController@assignType');


Route::get('test', function(){
    $d=json_encode(['city'=>'fff', 'cate' => [1,2,3]]);
    dd($d);
});


