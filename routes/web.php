<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

Route::match(['get', 'post'],'/index', [IndexController::class, 'showNotInCart'])->name('index');
Route::match(['get', 'post'],'/cart', [CartController::class, 'showInCartProducts'])->name('cart');
Route::match(['get', 'post'],'/products', [ProductsController::class, 'showAllProductsInfo'])->name('products');
Route::match(['get', 'post'],'/product',[ProductController::class, 'workWithProduct'])->name('product');
Route::match(['get', 'post'],'/order',[OrderController::class, 'showOrder'])->name('order');
Route::any('/login', [LoginController::class, 'checkLogin'])->name('login');

