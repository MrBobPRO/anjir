<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size = new Size();
        $fields = ['title', 'priority'];
        Helper::fillFields($request, $size, $fields);

        $size->save();

        return redirect()->route('dashboard.sizes.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Size::select('title', 'id')->orderBy('title')->get();
        $editRoute = 'sizes.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $sizes = Size::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.sizes.index', compact('items', 'editRoute', 'sizes', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);

        return view('dashboard.sizes.edit', compact( 'size'));
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
        $size = Size::find($request->id);
        $fields = ['title', 'priority'];
        Helper::fillFields($request, $size, $fields);

        $size->save();

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
            $size = Size::find($id);

            // detach all relations
            $size->products()->detach();

            $size->delete();
        }
        
        return redirect()->route('dashboard.sizes.index');
    }
}
