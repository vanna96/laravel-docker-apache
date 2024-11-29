<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\frontend\WishListController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('about', [AboutController::class, 'index'])->name('about');
Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::get('product/detail/{id}', [CheckoutController::class, 'index'])->name('product.detail');
// Route::get('store/{id}', [CheckoutController::class, 'index'])->name('store'); 
