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
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Order::select('name as title', 'id')->orderBy('title')->get();
        $editRoute = 'dashboard.orders.show';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        $orders = Order::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.orders.index', compact('items', 'editRoute', 'orders', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function dashShow($id)
    {
        $order = Order::find($id);
        $order->new = 0;
        $order->save();
        
        return view('dashboard.orders.show', compact('order'));
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
            $order = Order::find($id);
            $order->delete();
        }
        
        return redirect()->route('dashboard.index');
    }
}
