<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/o-nas', [MainController::class, 'aboutUs'])->name('about-us');
Route::post('/search', [MainController::class, 'search'])->name('search');

Route::get('/zakazat-zvonok', [FeedbackController::class, 'success'])->name('feedback.success');
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/categorii/{url}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/skidki/{categoryUrl}', [MainController::class, 'discounts'])->name('discounts.show');
Route::get('/tovar/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/buy-on-click', [OrderController::class, 'buyOnClick'])->name('orders.buy-on-click');
Route::get('/korzina/{id}', [OrderController::class, 'success'])->name('orders.success');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');

Route::get('/korzina', [BasketController::class, 'index'])->name('basket.index');
Route::post('/add-into-basket', [BasketController::class, 'store'])->name('basket.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [OrderController::class, 'dashIndex'])->name('dashboard.index');
    Route::get('/dashboard/orders/{id}', [OrderController::class, 'dashShow'])->name('dashboard.orders.show');

    Route::post('/orders/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
});

require __DIR__.'/auth.php';