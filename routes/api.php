<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FrontController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('product-list', [FrontController::class, 'products']);
Route::get('category-list', [FrontController::class, 'categories']);
Route::get('category/{category}', [FrontController::class, 'category']);
Route::get('product/{product}', [FrontController::class, 'product']);



Route::group([ 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::post('products/{product}', [ProductController::class,'update']);
    
});
