<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin/dashboard');

// PRODUCT

Route::middleware(['auth:sanctum', 'verified'])->get('admin/products', [ProductController::class, 'index'])->name('admin/products');

Route::post('admin/store-product', [ProductController::class, 'store'])->name('store-product');
Route::post('admin/update-product', [ProductController::class, 'update'])->name('update-product');
Route::post('admin/delete-product', [ProductController::class, 'destroy'])->name('delete-product');

// BRANDS

Route::middleware(['auth:sanctum', 'verified'])->get('admin/brands', [BrandController::class, 'index'])->name('admin/brands');

Route::post('admin/store-brand', [BrandController::class, 'store'])->name('store-brand');
Route::post('admin/update-brand', [BrandController::class, 'update'])->name('update-brand');
Route::post('admin/delete-brand', [BrandController::class, 'destroy'])->name('delete-brand');
