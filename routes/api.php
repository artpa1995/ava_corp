<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\WordpressDataController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ShopifyZapierController;
use App\Http\Controllers\ApisdataGetController;


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

Route::post('register_app', [PassportAuthController::class, 'register_app']);
// Route::post('login', [PassportAuthController::class, 'login_app']);

// Route::middleware('auth:api')->group(function () {
//     // Route::resource('Wordpress_apps', WordpressDataController::class);

//     Route::controller(WordpressDataController::class)->group(function () {

//         Route::get('/Wordpress_apps/index', 'index');
        
//         Route::post('/Wordpress_apps/store', 'store');
    
//     });
    
// });
use App\Http\Controllers\PassportClientController;

Route::controller(PassportClientController::class)->group(function () {
    Route::get('/create_client', 'create');
    Route::get('/redirect', 'redirect_client');
    Route::get('/auth/callback', 'auth_callback');

});
Route::middleware('auth:api')->group(function () {

    Route::controller(WordpressDataController::class)->group(function () {
         Route::post('getformdata','getDatafrom');
    });
      
});

Route::post('getformdata-shopify', [ShopifyZapierController::class, 'getDatafrom']);//->middleware('auth:api');

// Route::get('webhook-url', function (Illuminate\Http\Request $request) {

Route::get('/webhook-url/{username}/{password}', function ($username, $password) {

  return response()->json(['code' => 200, 'username' => $username, 'password' => $password]);
    
    
    return response('OK', 200);
});
// ->middleware('zapier');

// Route::post('getformdata', [ApisdataGetController::class, 'getDatafrom']);
// Route::post('getDatafrom', [WordpressDataController::class, 'getDatafrom']);