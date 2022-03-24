<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $novelty = Product::latest()->take(10)->get();

        return view('home.index', compact('novelty'));
    }

    public function aboutUs()
    {
        return view('about.about-us');
    }

    public function discounts($categoryUrl)
    {
        $category = Category::where('url', $categoryUrl)->first();
        $products = $category->products()->where('discount', '!=', 0)->paginate(16);

        return view('products.discounts', compact('category', 'products', 'categoryUrl'));
    }
}
