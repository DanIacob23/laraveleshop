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

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::post('/products', [ProductsController::class, 'showAllProductsInfo'])->name('productss');
    Route::delete('/products/{id}', [ProductsController::class, 'deleteProductFromProducts'])->name('products.delete');

    Route::get('/product/{id}',[ProductController::class, 'view'])->name('product');
    Route::post('/product/{id}',[ProductController::class, 'workWithProduct'])->name('product.work');
});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'addToCart'])->name('index.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'checkout'])->name('cartCheckout');
Route::delete('/cart/{id}', [CartController::class, 'deleteProduct'])->name('cart.delete');
//Route::put('/cart', [CartController::class, 'add'])->name('addToCart');

Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('login.checkLogin');

Route::get('/order/{orderId}',[OrderController::class, 'showOrder'])->name('order');
