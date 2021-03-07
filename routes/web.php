<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Generate Laravel Auth Routes
Auth::routes();
  
// Fontend Controller Routes
Route::get('/', [FontendController::class, 'index']);
Route::get('about', [FontendController::class, 'about']);
Route::get('dashbroad',[FontendController::class, 'dashbroad']);

// Home Controller Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');

// categroy Controller Routes
Route::get('category', [CategoryController::class, 'category'])->name('category');
Route::post('category/post', [CategoryController::class, 'categorypost'])->name('categorypost');
Route::get('category/delete/{category_id}', [CategoryController::class, 'categorydelete'])->name('categorydelete');
Route::get('category/all/delete', [CategoryController::class, 'categoryalldelete'])->name('categoryalldelete');
Route::get('category/edit/{category_id}', [CategoryController::class, 'categoryedit'])->name('categoryedit');
Route::post('category/post/edit', [CategoryController::class, 'category_post_edit'])->name('category_post_edit');
Route::get('category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category_restore');
Route::get('category/forcedelete/{category_id}', [CategoryController::class, 'categoryforce'])->name('categoryforce');
Route::get('category/all/forcedelete', [CategoryController::class, 'category_force_delete_all'])->name('category_force_delete_all');
Route::get('category/all/restore', [CategoryController::class, 'category_restore_all'])->name('category_restore_all');
Route::post('category/check/delete', [CategoryController::class, 'category_check_delete'])->name('category_check_delete');
Route::post('category/soft/check', [CategoryController::class, 'category_soft_check'])->name('category_soft_check');

// Product Controller
Route::get('product', [ProductController::class, 'product'])->name('product');
Route::post('product/post', [ProductController::class, 'productpost'])->name('productpost');
Route::get('product/soft/delete/{product_id}', [ProductController::class, 'productsoftdelete'])->name('productsoftdelete');
Route::get('product/restore/{product_id}', [ProductController::class, 'product_restore'])->name('product_restore');
Route::get('product/force/{product_id}', [ProductController::class, 'productforce'])->name('productforce');