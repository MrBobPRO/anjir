<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $novelty = Product::latest()->take(10)->get();

        return view('home.index', compact('novelty'));
    }
}
