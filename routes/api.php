<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/products', [ApiController::class, 'productsIndex']);
    Route::get('/categories', [ApiController::class, 'categoriesIndex']);
    Route::get('/product-tags', [ApiController::class, 'productTagsIndex']);
});