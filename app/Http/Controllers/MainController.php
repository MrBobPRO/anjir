<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $slides = Slide::where('category_id', 0)->inRandomOrder()->get();
        $novelty = Product::latest()->take(10)->get();

        return view('home.index', compact('novelty', 'slides'));
    }

    public function aboutUs()
    {
        return view('about.about-us');
    }

    public function discounts($categoryUrl)
    {
        $category = Category::where('url', $categoryUrl)->first();
        $products = $category->products()->where('discount', '!=', 0)->paginate(16);
        $slides = Slide::where('category_id', -1)->inRandomOrder()->get();

        return view('products.discounts', compact('category', 'products', 'categoryUrl', 'slides'));
    }

    public function search(Request $request)
    {
        if(mb_strlen($request->keyword) < 2) {
            $products = null;
        } else {
            $products = Product::where('title', 'LIKE', '%' . $request->keyword . '%')->get();
        }

        return view('components.search-results', compact('products'));
    }

}
