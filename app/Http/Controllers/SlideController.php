<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        //for count
        $items = Slide::select('id')->get();

        $slides = Slide::orderBy('id')->get();

        return view('dashboard.slides.index', compact('slides', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.slides.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = new Slide();
        $fields = ['category_id'];
        Helper::fillFields($request, $slide, $fields);
    
        Helper::uploadFiles($request, $slide, 'image', uniqid(), Helper::SLIDES_PATH, 1060);
        $slide->save();

        return redirect()->route('dashboard.slides.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slide::find($id);
        $categories = Category::orderBy('name')->get();

        return view('dashboard.slides.edit', compact('slide', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slide = Slide::find($request->id);
        $fields = ['category_id'];
        Helper::fillFields($request, $slide, $fields);
    
        Helper::uploadFiles($request, $slide, 'image', uniqid(), Helper::SLIDES_PATH, 1060);
        $slide->save();

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
            $slide = Slide::find($id);
            // remove file from storage
            Helper::deleteFile(public_path('img/slides/'. $slide->image));
            $slide->delete();
        }
        
        return redirect()->route('dashboard.slides.index');
    }
}
