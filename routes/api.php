<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Api\ProductController;


Route::post('/auth/register', [RegisterController::class, 'register']);
Route::post('/auth/login', [RegisterController::class, 'login']);
Route::get('/products/show/{id}', [ProductsController::class, 'show']);


    Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/products', [ProductsController::class, 'index']);
    Route::post('/products/ekle', [ProductsController::class, 'store']);
    Route::put('/products/update/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});