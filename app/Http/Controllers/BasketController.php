<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

        //check if any deleted product exists in basket and remove it
        if($items) {
            foreach($items as $item) {
                $product = Product::find($item['product_id']);
                if(!$product) {
                    if (($key = array_search($item, $items)) !== false) {
                        unset($items[$key]);
                    }
                }
            }
    
            session()->put('basket', $items);
        }

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

        // else add into basket
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
     * Remove the specified resource from basket on baskets page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $products = session('basket');
        $removed = false;

        //remove from basket if product already exists
        if($products) {
            foreach($products as $product) {
                if($product['product_id'] == $request->product_id) {
                    if (($key = array_search($product, $products)) !== false) {
                        unset($products[$key]);
                        $removed = true;
                    }
                }
            }

            session()->put('basket', $products);
    
            return [
                'action' => $removed ? 'removed' : 'void',
                'productsInBasket' => session('basket') ? count(session('basket')) : 0
            ];
        }
    }
}
