<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\CuponController;

// Generate Laravel Auth Routes
Auth::routes();
  
// Fontend Controller Routes
Route::get('/', [FontendController::class, 'index'])->name('tohoney_home');
Route::get('about', [FontendController::class, 'about'])->name('about');
Route::get('contact', [FontendController::class, 'frontend_contact'])->name('contact');
Route::get('product/details/{product_id}', [FontendController::class, 'product_details'])->name('product_details');
Route::get('shop', [FontendController::class, 'shop'])->name('shop');
Route::get('category/wise/shop/{category_id}', [FontendController::class, 'category_wise_shop'])->name('category_wise_shop');
Route::Post('contact_submit', [FontendController::class, 'contact_insert'])->name('contact_insert');
Route::get('cart/page', [FontendController::class, 'cart'])->name('cart');
Route::get('cart/page/{cupon}', [FontendController::class, 'cart'])->name('cart_cupon');
Route::post('update/cart', [FontendController::class, 'update_cart'])->name('update_cart');
Route::get('checkout', [FontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post', [FontendController::class, 'checkout_post'])->name('checkout_post');
Route::get('customer/register', [FontendController::class, 'customer_register'])->name('customer_register')->middleware('guest');
Route::post('customer/register/post', [FontendController::class, 'customer_register_post'])->name('customer_register_post');
Route::get('customer/login', [FontendController::class, 'customer_login'])->name('customer_login')->middleware('guest');
Route::post('customer/login/post', [FontendController::class, 'customer_login_post'])->name('customer_login_post');
Route::post('get/city/list', [FontendController::class, 'getcitylist']);

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

// Sub Category Controller
Route::get('subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('subcategory/post', [SubcategoryController::class, 'subcategory_post'])->name('subcategory_post');
Route::get('subcategory/edit/{sub_category_id}', [SubcategoryController::class, 'subcategoryedit'])->name('subcategoryedit');
Route::post('subcategory/post/edit/{sub_category_id}', [SubcategoryController::class, 'subcategory_post_edit'])->name('subcategory_post_edit');
Route::get('subcategory/soft/delete/{sub_category_id}', [SubcategoryController::class, 'subcategorydelete'])->name('subcategorydelete');
Route::get('subcategory/restore/{sub_category_id}', [SubcategoryController::class, 'subcategoryrestore'])->name('subcategoryrestore');
Route::get('subcategory/force/delete/{sub_category_id}', [SubcategoryController::class, 'subcategoryfocedelete'])->name('subcategoryfocedelete');
Route::get('subcategory/all/restore', [SubcategoryController::class, 'subcategoryallrestore'])->name('subcategoryallrestore');
Route::get('subcategory/delete/soft/all', [SubcategoryController::class, 'allsoftdelete'])->name('allsoftdelete');
Route::get('subcategory/delete/all/force', [SubcategoryController::class, 'subcategoryallforcedelete'])->name('subcategoryallforcedelete');

// Product Controller
Route::get('product', [ProductController::class, 'product'])->name('product');
Route::post('product/post', [ProductController::class, 'productpost'])->name('productpost');
Route::get('product/edit/{product_id}', [ProductController::class, 'product_edit'])->name('product_edit');
Route::post('product/update/edit/{product_id}', [ProductController::class, 'producteditpost'])->name('producteditpost');
Route::get('product/soft/delete/{product_id}', [ProductController::class, 'productsoftdelete'])->name('productsoftdelete');
Route::get('product/restore/{product_id}', [ProductController::class, 'product_restore'])->name('product_restore');
Route::get('product/force/{product_id}', [ProductController::class, 'productforce'])->name('productforce');
Route::get('product/all/restore', [ProductController::class, 'product_restore_all'])->name('product_restore_all');
Route::get('product/all/', [ProductController::class, 'product_force_delete_all'])->name('product_force_delete_all');
Route::get('product/delete/soft/all', [ProductController::class, 'product_all_soft_delete'])->name('product_all_soft_delete');
Route::post('update/feature/photo/{feature_id}', [ProductController::class, 'update_feature_photo'])->name('update_feature_photo');
Route::get('update/delete/feature/{feature_id}', [ProductController::class, 'update_feature_delete'])->name('update_feature_delete');
Route::post('add/feature/photo/{product_id}', [ProductController::class, 'add_feature_photo'])->name('add_feature_photo');

// Contact Controller
Route::get('page/contact', [ContactController::class, 'contact_backend'])->name('contact_backend');
Route::get('contact/delete/{contact_id}', [ContactController::class, 'contact_delete'])->name('contact_delete');

// Faq Controller
Route::get('faq/view', [FaqController::class, 'faq'])->name('faq');
Route::post('faq/insert', [FaqController::class, 'faq_insert'])->name('faq_insert');
Route::get('faq/soft/delete/{faq_id}', [FaqController::class, 'faq_soft_delete'])->name('faq_soft_delete');
Route::get('faq/force/delete/{faq_id}', [FaqController::class, 'faq_force_delete'])->name('faq_force_delete');
Route::get('restore/faq/{faq_id}', [FaqController::class, 'faq_restore'])->name('faq_restore');

// Header Controller
Route::get('header/dashbroad', [HeaderController::class, 'header'])->name('header');
Route::post('header/post', [HeaderController::class, 'header_post'])->name('header_post');
Route::get('header/soft/{header_id}', [HeaderController::class, 'header_soft'])->name('header_soft');
Route::get('header/all/soft/delete', [HeaderController::class, 'header_soft_all'])->name('header_soft_all');
Route::get('header/single/force/delete/{header_id}', [HeaderController::class, 'header_force'])->name('header_force');
Route::get('header/restore/single/{header_id}', [HeaderController::class, 'header_restore'])->name('header_restore');
Route::get('header/all/restore', [HeaderController::class, 'restore_all'])->name('restore_all');

// Setting Controller
Route::get('setting', [SettingController::class, 'setting'])->name('setting');
Route::post('setting/post', [SettingController::class, 'settingpost'])->name('settingpost');

// Cart Controller
Route::post('add/to/cart/{product_id}', [Cartcontroller::class, 'cartpost'])->name('cartpost');
Route::get('cart/delete/{cart_id}', [Cartcontroller::class, 'cartdelete'])->name('cartdelete');

// Cupon Controller
Route::resource('cupon', CuponController::class);
Route::get('cupon/delete/all', [CuponController::class, 'delete_all'])->name('cart.delete.all');