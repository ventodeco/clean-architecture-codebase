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

Route::middleware('jwt.check')->group(function () {

    // Home
    Route::get('', 'PageController@home');

    // Register/Login
    Route::post('/users', 'AuthApi\RegisterController');
    Route::post('/users/login', 'AuthApi\LoginController');
    Route::post('/auth/login', 'AuthApi\LoginController');

    // ==    Orders      ==
    Route::get('orders', 'Order\IndexController');
    Route::get('orders/{id}', 'Order\ShowController');
    Route::post('orders', 'Order\StoreController');

    // ==    Products    ==
    Route::get('products', 'Product\IndexController');
    Route::get('products/{slug}', 'Product\ShowController');
    Route::get('products/by_id/{id}', 'Product\GetController@byId');
    Route::get('products/by_tag/{tagName}', 'Product\GetController@byTag');
    Route::get('products/by_category/{categoryName}', 'Product\GetController@byCategory');
    Route::post('products', 'Product\StoreController');

    // Comments
    Route::get('products/{productSlug}/comments', 'Comment\IndexController');
    Route::post('products/{productSlug}/comments/', 'Comment\StoreController');
    Route::put('products/{productSlug}/comments/{comment}', 'Comment\UpdateController');
    Route::delete('products/{productSlug}/comments/{comment}', 'Comment\DestroyController');

    // Tags
    Route::get('tags', 'Tag\IndexController');
    Route::post('tags', 'Tag\StoreController');

    // Categories
    Route::get('categories', 'Category\IndexController');
    Route::post('categories', 'Category\StoreController');

    // Addresses
    Route::get('addresses', 'Address\ShowController');
});