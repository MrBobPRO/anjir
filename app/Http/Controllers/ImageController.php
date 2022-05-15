<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = new Image();
        $img->product_id = $request->product_id;
        
        // get id for newly creating image
        $statement = DB::select("show table status like 'images'");
        $id = $statement[0]->Auto_increment;

        Helper::uploadFiles($request, $img, 'name', $id, Helper::PRODUCTS_ADDITIONAL_PATH);
        $img->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $img = Image::find($request->id);
        // remove file from storage
        Helper::deleteFile(public_path('img/products/additional/'. $img->name));
        $img->delete();

        return redirect()->back();
    }
}
