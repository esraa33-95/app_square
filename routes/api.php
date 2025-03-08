<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Front\AuthController;
use App\Http\Controllers\Api\Front\ProductController;
use App\Http\Controllers\Api\Front\ZoneController;
use App\Http\Controllers\Api\Front\AreaController;
use App\Http\Controllers\Api\Front\CartController;
use App\Http\Controllers\Api\Front\CategoryController;
use App\Http\Controllers\Api\Front\LocationController;
use App\Http\Controllers\Api\Front\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//task1
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login');
    Route::post('auth/logout', 'logout');
    Route::post('auth/forgot-password',  'sendResetLink');
    Route::post('auth/reset-password', 'resetPassword');
});


Route::middleware(['auth:sanctum'])->group(function () {
 //category
Route::group([
    'controller'=>CategoryController::class,
],function(){
Route::get('categories/index','index');
Route::post('categories/store', 'store');

 });

//product
Route::group([
    'controller'=>ProductController::class,
],function(){
Route::get('products/index','index');
Route::post('products/store', 'store');

 });

 //zone
 Route::group([
    'controller'=>ZoneController::class,
],function(){
Route::get('zones/index','index');
Route::post('zones/store', 'store');
Route::get('zones/{zoneId}',  'showAreasByZone');
 });

//area
 Route::group([
    'controller'=>AreaController::class,
],function(){
Route::post('area/store', 'store');

 });

//location
 Route::group([
    'controller'=>LocationController::class,
],function(){

Route::post('location/store', 'store');

 });

 //cart
 Route::group([
    'controller'=>CartController::class,
    
],function(){
Route::post('add/{productId}','addToCart');
Route::get('cart', 'getCart');
Route::delete('remove/{productId}', 'removefromcart');

 });



 Route::group([
    'controller'=>OrderController::class,
    
],function(){
Route::post('order/{userId}','createOrder');
Route::delete('delete/{id}', 'cancelOrder');
Route::get('orders', 'getUserOrders');

 });
});
  