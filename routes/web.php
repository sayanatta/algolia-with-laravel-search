<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);

Route::get('backend-search', [ProductController::class, 'backend_search'])->name('backend_search');
Route::post('search', [ProductController::class, 'search'])->name('search');
