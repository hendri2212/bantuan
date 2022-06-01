<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('disaster', 'DisasterController');
Route::resource('user', 'UserController');
Route::resource('categories', 'CategoryController');
Route::resource('product', 'ProductController');
Route::get('profile/{id}', 'UserController@profile');
Route::get('products/{id}', 'ProductController@products');
Route::prefix('admin')->group(function($route){
    $route->get('disaster', 'DisasterController@getForAdmin');
});