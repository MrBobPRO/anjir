<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $fields = ['name', 'priority'];
        Helper::fillFields($request, $category, $fields);

        $category->url = Helper::transliterateIntoLatin($request->name);
        $category->save();

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $category = Category::where('url', $url)->first();
        $products = $category->products()->orderBy('title')->paginate(12);
        $novelty = $category->products()->latest()->take(10)->get();

        return view('categories.show', compact('category', 'products', 'novelty'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Category::select('name as title', 'id')->orderBy('title')->get();
        $editRoute = 'categories.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'priority';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $categories = Category::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.categories.index', compact('items', 'editRoute', 'categories', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('dashboard.categories.edit', compact( 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $fields = ['name', 'priority'];
        Helper::fillFields($request, $category, $fields);

        $category->url = Helper::transliterateIntoLatin($request->name);
        $category->save();

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
            $category = Category::find($id);

            // detach all relations
            $category->products()->detach();

            // delete category slides
            foreach($category->slides as $slide) {
                Helper::deleteFile(public_path('img/slides/'. $slide->image));
                $slide->delete();
            }

            $category->delete();
        }
        
        return redirect()->route('dashboard.categories.index');
    }
}
