<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = session('basket');
        if(!$items || count($items) == 0) {
            $items = null;
        }

        return view('basket.index', compact('items'));
    }


    /**
     * Ajax store product in basket (session)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = session('basket');

        //remove from basket if product already exists
        if($products) {
            foreach($products as $product) {
                if($product['product_id'] == $request->product_id) {
                    if (($key = array_search($product, $products)) !== false) {
                        unset($products[$key]);
                    }

                    session()->put('basket', $products);
    
                    return [
                        'action' => 'removed',
                        'productsInBasket' => session('basket') ? count(session('basket')) : 0
                    ];
                }
            }
        }

        //else add into basket
        session()->push('basket', [
            'product_id' => $request->product_id,
            'size' => $request->size,
            ]
        );

        return [
            'action' => 'stored',
            'productsInBasket' => session('basket') ? count(session('basket')) : 0
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
