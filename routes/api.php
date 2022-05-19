<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'product', 'middleware' => 'api.key'], function() {
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', [\App\Http\Controllers\Product\ProductController::class, 'getCategories']);
        });
        Route::group(['prefix' => 'groups'], function() {
            Route::get('/', [\App\Http\Controllers\Product\ProductController::class, 'getGroups']);
        });
    });

});
