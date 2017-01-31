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

use App\Models\Admin;
use App\Models\AdminDetails;
use App\Models\Payment;
use App\Models\Place;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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
        Route::get('search', 'SearchController@search');
        Route::get('update', 'HomeController@update');
    });

Route::group([
    'prefix' => 'super_admin/places',
    'namespace' => 'SuperAdmin'
],
    function(){
        Route::get('all', 'PlaceController@index');
        Route::post('update/{place_id}', 'PlaceController@update');
        Route::get('export', 'PlaceController@exportPDF');
    });

Route::group([
    'prefix' => 'super_admin/group_admin',
    'namespace' => 'SuperAdmin'
],
    function(){
        Route::get('new', 'GroupAdminController@create');
        Route::post('save', 'GroupAdminController@save');
    });

/**
 * Group Admin route part
 */
Route::group([
    'prefix' => 'group_admin',
    'namespace' => 'GroupAdmin\Auth'
],
    function(){
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@logout');
    });
Route::group([
    'prefix' => 'group_admin',
    'namespace' => 'GroupAdmin'
],
    function(){
        Route::get('dashboard', 'PlaceController@index');
        Route::post('place/add_email', 'PlaceController@addEmail');
        Route::post('place/update_status', 'PlaceController@updateStatus');
        Route::get('place/cover/{place_id}', 'CoverController@index');
        Route::post('place/cover/add_cover', 'CoverController@create');
        Route::post('place/cover/delete/{image_id}', 'CoverController@delete');
        Route::post('notes/new', 'NoteController@create');
        Route::get('notes/all/{place_id}', 'NoteController@getAll');
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

//Route::group([
//    'prefix' => 'admin',
//    'namespace' => 'Admin\Auth'
//],
//    function(){
//        Route::post('password/email', 'PasswordController@sendResetLinkEmail');
//        Route::post('password/reset', 'PasswordController@reset');
//        Route::get('password/reset/{token?}', 'PasswordController@showResetForm');
//
//    });

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
],
    function(){
        Route::get('dashboard', 'DashboardController@index');
        Route::get('terms_of_use', function(){
            return view('admin/terms_of_use');
        });
        Route::get('privacy_policy', function(){
            return view('admin/privacy_policy');
        });
        Route::get('contact_us', 'ContactUsController@index');
        Route::post('contact_us/send', 'ContactUsController@send');
        
    });

Route::group([
    'prefix' => 'admin/place',
    'namespace' => 'Admin',
],
    function(){
        Route::get('edit', 'PlaceController@edit');
        Route::post('update', 'PlaceController@update');
        Route::post('add_cover', 'PlaceController@addCoverImages');
        Route::post('delete_cover_image/{id}', 'PlaceController@deleteCoverImage');
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
 Route::post('comment/add', 'CommentController@create');


/**
 * Angular Calls
 */
Route::post('{city}/restaurants', 'PlaceController@index');

Route::get('root/data', 'HomeController@getRootData');
Route::get('{city}/restaurants/more', 'PlaceController@loadMore');
Route::get('{city}/restaurants/filter', 'PlaceController@filter');
Route::get('restaurants/category/{data}', 'PlaceController@getCategoryProducts');
Route::get('show/{id}', 'PlaceController@show');
Route::get('products/{menu_id}', 'PlaceController@products');
Route::get('search', 'PlaceController@search');
Route::get('comments', 'PlaceController@moreComments');
Route::post('detect_user_city', 'HomeController@detectUserCity');
Route::get('sendmail/{email}', 'UserController@sendMail');
Route::post('add_location', 'HomeController@addLocation');
Route::post('register_owner', 'HomeController@registerOwner');
Route::post('noticed_mistake', 'HomeController@noticedMistake');
Route::post('noticed_mistake', 'HomeController@noticedMistake');
Route::post('contact_us', 'ContactUsController@sendMail');


/**
 * Routes for bot's call
 */
Route::get('move/images', 'ApiController@movePlaceImages');
Route::post('fill/places', 'ApiController@fillPlace');
Route::post('fill/cuisines', 'ApiController@fillCuisines');
Route::post('fill/locations', 'ApiController@fillLocations');
Route::get('assign/category', 'ApiController@assignCategory');
Route::get('assign/type', 'ApiController@assignType');

/*--------------------------------------*/

//Route::get('run_cron', function(){
//    $places1 = Place::whereNotNull('first_login')->where('plan_id', 1)->get()->toArray();
//
//    // get current date time in Unix format
//    $now = strtotime(date("Y-m-d H:i:s"));
//
//    if(count($places1) > 0) {
//        foreach ($places1 as $place) {
//
//            //get email sent time in Unix format
//            $activation_date = strtotime($place['first_login']);
//
//            // deactivate place after 5 day
//            if ($now > $activation_date + 432000) {
//                Place::where('id', $place['id'])->delete();
//            }
//        }
//    }
//
//    $places2 = Place::where('plan_id', 2)->get()->toArray();
//    foreach ($places2 as $place) {
//        $last_payment = Payment::where('place_id', $place['id'])->orderBy('created_at')->get()->last()->toArray();
//        $payment_date = strtotime($last_payment['created_at']);
//        if($now > $payment_date + 31536000){
//            Place::where('id', $place['id'])->delete();
//        }
//    }
//});

Route::get('email', function(){
    return view('emails.index');
});

Route::get('fill/support_ids', 'ApiController@fillSupportId');
Route::get('fill/admins', 'ApiController@fillAdmins');
Route::get('export_places', 'ApiController@exportPlaces');

Route::get('fill_emails', function(){
    $d = DB::table('places')
        ->join('company', 'places.mobile', '=', 'company.phone')
        ->select('places.id', 'company.email as company_email')
        ->where('company.email', '!=', '')
        ->get();

    foreach($d as $value){
        Place::where('id',  $value->id)->update(['email'=> $value->company_email]);
    }
});

Route::get('assign_cover_image_random', function(){
    $places = Place::with('coverImages')->get()->toArray();

    foreach($places as $place){
        if(count($place['cover_images']) == 0) {
            $collection = collect(config('coverimages'));
            $random = $collection->random(3)->toArray();
            foreach ($random as $img) {
                \App\Models\Image::create(['name' => $img, 'imageable_id' => $place['id'], 'imageable_type' => 'App\Models\Place', 'role' => 2]);
            }
        }
    }
});

Route::get('test', function(){
    return view('super_admin.pdf_places');
});

Route::any('{catchcall}',function() {
    return Redirect::to('/#/' . Request::path());
})->where('catchcall','(.*)');