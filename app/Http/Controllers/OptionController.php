<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Option::select('title', 'id')->orderBy('title')->get();
        $editRoute = 'options.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $options = Option::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.options.index', compact('items', 'editRoute', 'options', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::find($id);

        return view('dashboard.options.edit', compact( 'option'));
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
        $option = Option::find($request->id);
        $fields = ['value'];
        Helper::fillFields($request, $option, $fields);

        $option->save();

        return redirect()->back();
    }
}
