<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductImageController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// _______________ WEBSITE


// LANDING PAGE

Route::get('/', [HomeController::class, 'index'])->name('home');


// _______________ ADMIN

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // DASHBOARD

    Route::get('/admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin/dashboard');

    // PRODUCT

    Route::get('admin/products', [ProductController::class, 'index'])->name('admin/products');

    Route::post('admin/store-product', [ProductController::class, 'store'])->name('store-product');
    Route::post('admin/update-product', [ProductController::class, 'update'])->name('update-product');
    Route::post('admin/delete-product', [ProductController::class, 'destroy'])->name('delete-product');

    // PRODUCT IMAGES

    Route::post('admin/store-image', [ProductImageController::class, 'store'])->name('store-image');
    Route::post('admin/load-images', [ProductImageController::class, 'load'])->name('load-images');

    // BRANDS

    Route::get('admin/brands', [BrandController::class, 'index'])->name('admin/brands');

    Route::post('admin/store-brand', [BrandController::class, 'store'])->name('store-brand');
    Route::post('admin/update-brand', [BrandController::class, 'update'])->name('update-brand');
    Route::post('admin/delete-brand', [BrandController::class, 'destroy'])->name('delete-brand');

});
