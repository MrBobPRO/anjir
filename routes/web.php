<?php

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
Route::post('/search', [MainController::class, 'search'])->name('search');

//products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{url}', [ProductController::class, 'single'])->name('products.single');
Route::post('/products/get', [ProductController::class, 'get'])->name('products.get');

//researches 
Route::get('/researches', [ResearchController::class, 'index'])->name('researches.index');
Route::get('/researches/{url}', [ResearchController::class, 'single'])->name('researches.single');
Route::post('/researches/get', [ResearchController::class, 'get'])->name('researches.get');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [ProductController::class, 'dashboardIndex'])->name('dashboard.index');
});

require __DIR__.'/auth.php';