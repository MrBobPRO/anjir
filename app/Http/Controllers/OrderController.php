<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Buy on click
     *
     * @return \Illuminate\Http\Response
     */
    public function buyOnClick(Request $request)
    {
        //redirect back case 0 amount of product selected
        if(!$request->amount) {
            return redirect()->back();
        }

        $order = new Order();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->save();

        $order->products()->attach($request->product_id, ['size' => $request->size, 'amount' => $request->amount]);

        session(['order' => 'requested']);

        return redirect()->route('orders.success', $request->product_id);
    }

    /**
     * On success
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        if(session('order') == 'requested') {
            session()->forget('order');
            return view('layouts.success-page');
        } else {
            return redirect()->home();
        }
    }

    /**
     * On success
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        //redirect home case none products ordered
        if(!$request->products) {
            session()->forget('basket');

            return route('home');
        }

        $orderedProductsCount = count($request->products['ids']);
        if(!$orderedProductsCount) {
            session()->forget('basket');

            return route('home');
        }

        //else create new order
        $order = new Order();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->promocode = $request->promocode;
        $order->save();

        for($i=0; $i<$orderedProductsCount; $i++) {
            $order->products()->attach($request->products['ids'][$i], [
                'size' => $request->products['sizes'][$i], 'amount' => $request->products['amounts'][$i]
            ]);
        }

        session()->forget('basket');
        session(['order' => 'requested']);

        return route('orders.success', $request->products['ids'][0]);
    }

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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
