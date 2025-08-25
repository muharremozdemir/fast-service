<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Site
use App\Http\Controllers\Site\SiteHomeController;
use App\Http\Controllers\Site\SiteCategoryController;
use App\Http\Controllers\Site\ProductController;

/*
|--------------------------------------------------------------------------
| SITE
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteHomeController::class, 'index'])->name('site.home');

Route::get('/kategori/{parent:slug}/{child:slug?}', [SiteCategoryController::class, 'show'])
    ->name('site.category');

Route::view('/product', 'site.product')->name('site.product');
Route::view('/cart', 'site.cart')->name('site.cart');
Route::view('/order-complete', 'site.order-complete')->name('site.orderComplete');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/index', [AdminHomeController::class, 'index'])->name('admin.index');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

});

Route::get('/urun/{product:slug}', [ProductController::class, 'show'])->name('site.product.show');
Route::view('/sepet', 'site.cart')->name('site.cart');
