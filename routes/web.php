<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
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

Route::get('/categorii/{url}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/skidki/{categoryUrl}', [MainController::class, 'discounts'])->name('discounts.show');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

require __DIR__.'/auth.php';