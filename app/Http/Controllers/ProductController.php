<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        //generate title
        $male = false;
        $female = false;
        foreach($product->categories as $category) {
            if($category->url == 'muzhskoe') {
                $male = true;
            }
            if($category->url == 'zhenskoe') {
                $female = true;
            }
        }

        if(!$male && !$female) {
            $title = null;
        } elseif($male && $female) {
            $title = 'Мужское / Женское';
        } else {
            $title = $male ? 'Мужское' : 'Женское';
        }

        //similar products
        $productCategories = $product->categories()->pluck('id')->toArray();
        $similarProducts = Product::whereHas('categories', function ($q) use ($productCategories) {
            $q->whereIn('id', $productCategories);
        })
            ->where('id', '!=', $product->id)
            ->paginate(16);

        $productsInBasket = session('basket') ? session('basket') : [];

        return view('products.show', compact('product', 'title', 'similarProducts', 'productsInBasket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
