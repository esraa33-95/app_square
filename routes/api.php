<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Front\AuthController;
use App\Http\Controllers\Api\Front\ProductController;
use App\Http\Controllers\Api\Front\ZoneController;
use App\Http\Controllers\Api\Front\AreaController;
use App\Http\Controllers\Api\Front\LocationController;

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




//task2
Route::group([
    'controller'=>ProductController::class,
],function(){
Route::get('products', 'index');
Route::post('products', 'store');

 });

 //zone

 Route::group([
    'controller'=>ZoneController::class,
],function(){
Route::get('zones', 'index');
Route::post('store-zone', 'store');
Route::get('zones/{zoneId}',  'showAreasByZone');


 });

//area
 Route::group([
    'controller'=>AreaController::class,
],function(){
Route::get('areas', 'index');
Route::post('store-area', 'store');

 });

 Route::group([
    'controller'=>LocationController::class,
],function(){

Route::post('store-location', 'store');

 });