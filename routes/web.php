<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ComingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class,'homePage']);

Route::get('/product/{product}', [PagesController::class,'productDetailsPage']);

Route::get('/products/{category}', [PagesController::class,'productsPage']);
Route::get('/products/category/{subCategory}', [PagesController::class,'productsBySubPage']);
Route::get('/products/{subCategory}/{gameType}', [PagesController::class,'productsByGameType']);
Route::get('/search/products', [ProductController::class,'productsSearch']);
Route::get('/filterProducts', [ProductController::class,'filter']);

Route::get('/cart', [PagesController::class,'cartPage']);
Route::post('/addCart/{check?}', [OrderController::class,'addCart']);
Route::post('/checkout', [OrderController::class,'checkout']);
Route::get('/checkout', [PagesController::class,'checkoutPage']);
Route::post('/order', [OrderController::class,'order']);
Route::get('/thankyou', [PagesController::class,'ThankyouPage']);

Route::get('/admin/login', [PagesController::class,'loginPage'])->middleware('guest')->name('login');
Route::post('/admin/login', [AuthController::class,'login'])->middleware('guest');
Route::get('/logout', [AuthController::class,'Logout'])->middleware('auth');

Route::get('/admin', [PagesController::class,'adminPage'])->middleware('auth');

Route::get('/admin/products', [PagesController::class,'manageProductsPage'])->middleware('auth');
Route::get('/admin/search/products', [ProductController::class,'adminProductsSearch'])->middleware('auth');
Route::get('/admin/filterProducts', [ProductController::class,'adminFilter'])->middleware('auth');
Route::get('/admin/products/add', [PagesController::class,'addProductPage'])->middleware('auth');
Route::post('/admin/addProduct', [ProductController::class,'addProduct'])->middleware('auth');
Route::get('/admin/editProduct/{product}', [PagesController::class,'editProductPage'])->middleware('auth');
Route::post('/admin/editProduct/{product}', [ProductController::class,'editProduct'])->middleware('auth');
Route::get('/admin/deleteProduct/{product}', [ProductController::class,'deleteProduct'])->middleware('auth');

Route::get('/admin/orders', [PagesController::class,'OrdersPage'])->middleware('auth');
Route::get('/order/delete/{order}', [OrderController::class,'DeleteOrder'])->middleware('auth');
Route::get('/order/{order}', [PagesController::class,'OrderPage'])->middleware('auth');
Route::get('/finishOrder/{order}', [OrderController::class,'FinishOrder'])->middleware('auth');
Route::get('/order/edit/{order}', [PagesController::class,'EditOrderPage'])->middleware('auth');
Route::post('/order/edit/{order}', [OrderController::class,'EditOrder'])->middleware('auth');

Route::get('/get-subcategories/{category}', [ProductController::class,'getSubCategories'])->middleware('auth');

Route::get('/admin/banners', [PagesController::class,'bannersPage'])->middleware('auth');
Route::get('/admin/addBanner', [PagesController::class,'addBannerPage'])->middleware('auth');
Route::post('/admin/addBanner', [BannerController::class,'addBanner'])->middleware('auth');
Route::get('/admin/editBanner/{banner}', [PagesController::class,'editBannerPage'])->middleware('auth');
Route::post('/admin/editBanner/{banner}', [BannerController::class,'editBanner'])->middleware('auth');
Route::get('/admin/deleteBanner/{banner}', [BannerController::class,'deleteBanner'])->middleware('auth');

Route::get('/admin/comingSoon', [PagesController::class,'manageComingPage'])->middleware('auth');
Route::post('/admin/comingSoon/edit', [ComingController::class,'editComing'])->middleware('auth');

Route::get('/admin/changePassword', [PagesController::class,'changePasswordPage'])->middleware('auth');
Route::post('/admin/changePassword', [AuthController::class,'changePassword'])->middleware('auth');