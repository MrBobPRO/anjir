<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->phone = $request->phone;
        $feedback->save();

        session(['feedback' => 'requested']);

        return redirect()->route('feedback.success');
    }

    /**
     * Return success message after storing feedback
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        if(session('feedback') == 'requested') {
            session()->forget('feedback');
            return view('layouts.success-page');
        } else {
            return redirect()->home();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashIndex(Request $request)
    {
        // for search (items also used as a counter in header)
        $items = Feedback::select('name as title', 'id')->orderBy('title')->get();
        $editRoute = 'dashboard.feedbacks.show';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        $feedbacks = Feedback::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.feedbacks.index', compact('items', 'editRoute', 'feedbacks', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function dashShow($id)
    {
        $feedback = Feedback::find($id);
        $feedback->new = 0;
        $feedback->save();
        
        return view('dashboard.feedbacks.show', compact('feedback'));
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
            $feedback = Feedback::find($id);
            $feedback->delete();
        }
        
        return redirect()->route('dashboard.feedbacks.index');
    }
}
