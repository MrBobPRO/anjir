<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        //storing item into basket
        // session([
        //     'basket' => [[
        //         'product_id' => 1,
        //         'order_id' => 2,
        //         'size' => 1,
        //         'amount' => 2
        //     ]]
        // ]);

        //pushing item into basket
        // session()->push('basket',
        //     [
        //         'product_id' => 2,
        //         'order_id' => 9,
        //         'size' => 'XL',
        //         'amount' => 66
        //     ]);

        //removing item from basket
        // $prods = session('basket');
        // for($i=0; $i<count($prods); $i++) {
        //     if($prods[$i]['order_id'] == 9) {
        //         unset($prods[$i]);
        //     }
        // }

        // session()->forget('basket');
        // session()->put('basket', $prods);

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
