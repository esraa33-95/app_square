<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Front\AuthController;
use App\Http\Controllers\Api\Front\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//task1
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login');
    Route::post('auth/logout', 'logout');
});




//task2
Route::group([
    'controller'=>ProductController::class,
],function(){
Route::get('products', 'index');
Route::post('products', 'store');

 });