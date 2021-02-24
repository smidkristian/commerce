<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->group(function () {

    // DASHBOARD

    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin-dashboard');

    // PRODUCT

    Route::get('/products', [ProductController::class, 'index'])->name('admin-products');

    Route::get('/create-product/', [ProductController::class, 'create'])->name('create-product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
    Route::post('/update-product', [ProductController::class, 'update'])->name('update-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::post('/delete-product', [ProductController::class, 'destroy'])->name('delete-product');

    // PRODUCT IMAGES

    Route::post('/store-image', [ProductImageController::class, 'store'])->name('store-image');
    Route::post('/load-images', [ProductImageController::class, 'load'])->name('load-images');

    // BRANDS

    Route::get('/brands', [BrandController::class, 'index'])->name('admin-brands');

    Route::get('/create-brand', [BrandController::class, 'create'])->name('create-brand');
    Route::post('/store-brand', [BrandController::class, 'store'])->name('store-brand');
    Route::post('/update-brand', [BrandController::class, 'update'])->name('update-brand');
    Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('edit-brand');
    Route::post('/delete-brand', [BrandController::class, 'destroy'])->name('delete-brand');

    // CATEGORIES

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin-categories');

    Route::get('/create-category', [CategoryController::class, 'create'])->name('create-category');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::post('/update-category', [CategoryController::class, 'update'])->name('update-category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::post('/delete-category', [CategoryController::class, 'destroy'])->name('delete-category');
});
