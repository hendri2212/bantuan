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
Route::get('products', 'ProductController@products');
Route::get('count', 'DisasterController@count');
Route::prefix('admin')->group(function($route){
    $route->post('login', 'AdminController@login');

    $route->get('disaster', 'DisasterController@getForAdmin');
    $route->post('disaster', 'DisasterController@store');
    $route->get('disaster/{id}', 'DisasterController@show');
    $route->post('disaster/{id}', 'DisasterController@update');
    $route->delete('disaster/{id}', 'DisasterController@destroy');
    $route->get('user', 'UserController@getForAdmin');
    $route->get('products', 'ProductController@getForAdmin');
    $route->get('admin', 'AdminController@index');
    $route->post('admin', 'AdminController@store');
    $route->get('admin/{id}', 'AdminController@show');
    $route->post('admin/{id}', 'AdminController@update');
    $route->delete('admin/{id}', 'AdminController@destroy');
    $route->get('admin', 'AdminController@index');
    $route->get('category', 'CategoryController@getForAdmin');
    $route->post('category', 'CategoryController@store');
    $route->get('category/{id}', 'CategoryController@show');
    $route->post('category/{id}', 'CategoryController@update');
    $route->delete('category/{id}', 'CategoryController@destroy');
});
