<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
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
Route::middleware(['user_already_logged_in'])->group(function () {
    Route::get('/orders',[OrdersController::class, 'showAllOrders'])->name('orders');

    Route::get('/products', [ProductsController::class, 'renderViewProducts'])->name('products');
    Route::post('/products', [ProductsController::class, 'showAllProductsInfo'])->name('products');

    Route::get('/product',[ProductController::class, 'renderProductView'])->name('product');
    Route:: post('/product',[ProductController::class, 'workWithProduct'])->name('productWork');
});

Route::get('/', [IndexController::class, 'showNotInCart'])->name('index');
Route::post('/', [IndexController::class, 'addToCart'])->name('indexAdd');

Route::get('/cart', [CartController::class, 'showInCartProducts'])->name('cart');
Route:: post('/cart', [CartController::class, 'checkoutOrDelete'])->name('cartCheckoutOrDelete');

Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('loginCheckLogin');

Route::get('/order',[OrderController::class, 'showOrder'])->name('order');

