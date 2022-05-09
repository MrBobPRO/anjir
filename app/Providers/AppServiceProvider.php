<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        View::composer(['layouts.app', 'dashboard.layouts.app'], function ($view) {
            $view->with('route', Route::currentRouteName());
        });

        View::composer(['layouts.header'], function ($view) {
            $view->with('categories', Category::orderBy('priority')->get())
                ->with('productsInBasket', session('basket') ? count(session('basket')) : 0);
        });

        View::composer(['dashboard.layouts.aside'], function ($view) {
            $view->with('newOrdersCount', Order::where('new', true)->count())
                ->with('newFeedbacksCount', Feedback::where('new', true)->count());
        });
    }
}