<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
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
        $categories = Category::orderBy('name')->get();
        $sizes = Size::orderBy('title')->get();

        return view('dashboard.products.create', compact('categories', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $fields = ['title', 'price', 'discount', 'description'];
        Helper::fillFields($request, $product, $fields);
        $product->final_price = Helper::calculateFinalPrice($request->price, $request->discount);
        
        Helper::uploadFiles($request, $product, 'image', $product->title, Helper::PRODUCTS_PATH, 400);
        $product->save();

        $product->categories()->attach($request->categories);

        // order sizes by priority and attach themю --IMPORTANT
        $sizes = Size::whereIn('id', $request->sizes)->orderBy('priority')->pluck('id');
        $product->sizes()->attach($sizes);

        return redirect()->route('dashboard.products.index');
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Product::select('title', 'id')->orderBy('title')->get();
        $editRoute = 'products.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        $products = Product::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.products.index', compact('items', 'editRoute', 'products', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('name')->get();
        $sizes = Size::orderBy('title')->get();

        return view('dashboard.products.edit', compact( 'product','categories', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $fields = ['title', 'price', 'discount', 'description'];
        Helper::fillFields($request, $product, $fields);
        $product->final_price = Helper::calculateFinalPrice($request->price, $request->discount);
        
        Helper::uploadFiles($request, $product, 'image', $product->title, Helper::PRODUCTS_PATH, 400);
        $product->save();

        $product->categories()->detach();
        $product->categories()->attach($request->categories);

        // order sizes by priority and attach themю --IMPORTANT
        $product->sizes()->detach();
        $sizes = Size::whereIn('id', $request->sizes)->orderBy('priority')->pluck('id');
        $product->sizes()->attach($sizes);

        return redirect()->back();
    }

    /**
     * Request for deleting items by id may come in integer type (single destroy form) 
     * or in array type (multiple destroy form)
     * That`s why we need to get them in array type and delete them by loop
     *
     * @param  int/array  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = (array) $request->id;
        
        foreach($ids as $id) {
            $product = Product::find($id);

            // also delete product images
            foreach($product->images as $img) {
                Helper::deleteFile(public_path('img/products/additional/'. $img->name));
                $img->delete();
            }

            // remove products primary image from storage
            Helper::deleteFile(public_path('img/products/'. $product->image));

            // detach all relations
            $product->categories()->detach();
            $product->sizes()->detach();
            $product->orders()->detach();

            $product->delete();
        }
        
        return redirect()->route('dashboard.products.index');
    }
}
