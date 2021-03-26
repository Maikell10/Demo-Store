<?php

namespace App\Http\Controllers\Admin;

use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Product;
use App\RatingStore;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess','store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id == 1) {
            $sales = Sale::with('products','users')->orderBy('updated_at', 'desc')->get();

            $distinct_sale = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->orderBy('sales.created_at', 'desc')->get();
        } else {
            $sales = Sale::select('sales.state', 'sales.price_sale', 'sales.cantidad', 'sales.updated_at', 'sales.created_at', 'sales.user_id', 'sales.product_id', 'sales.status')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->with('products','users')->orderBy('sales.updated_at', 'desc')->get();

            $distinct_sale = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->orderBy('sales.created_at', 'desc')->get();
        }

        if ($distinct_sale == '[]') {
            $products = '0';
            return view('admin.order.index', compact('distinct_sale','sales', 'notifications','direct_m'));
        }

        return view('admin.order.index', compact('distinct_sale','sales','notifications','direct_m'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess','store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id == 1) {
            $sales = Sale::select('sales.id','sales.state', 'sales.price_sale', 'sales.cantidad', 'sales.updated_at', 'sales.created_at', 'sales.user_id', 'sales.product_id', 'sales.status')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('sales.created_at', $id)->with('products','users')->orderBy('sales.updated_at', 'desc')->get();

            foreach ($sales as $sale) {
                $rating_user = RatingStore::where('created_sale', $sale->created_at)->where('user_id', $sale->user_id)->where('status', 'USER')->get();

                $rating_store = RatingStore::where('created_sale', $sale->created_at)->where('user_id', $sale->user_id)->where('status', 'STORE')->get();
            }
        } else {
            $sales = Sale::select('sales.id','sales.state', 'sales.price_sale', 'sales.cantidad', 'sales.updated_at', 'sales.created_at', 'sales.user_id', 'sales.product_id', 'sales.status')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->where('sales.created_at', $id)->with('products','users')->orderBy('sales.updated_at', 'desc')->get();

            foreach ($sales as $sale) {
                $salee = Sale::findOrFail($sale->id);
                $salee->status = 'VIEW';
                $salee->save();

                $rating_user = RatingStore::where('created_sale', $sale->created_at)->where('store_user_id', Auth::user()->id)->where('user_id', $sale->user_id)->where('status', 'USER')->get();

                $rating_store = RatingStore::where('created_sale', $sale->created_at)->where('store_user_id', Auth::user()->id)->where('user_id', $sale->user_id)->where('status', 'STORE')->get();
            }
        }

        $order_id = strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id );
        $d_messages = DirectMessages::where('order_id', $order_id)->orderBy('created_at', 'asc')->get();

        $cant_dm_new = 0;
        foreach ($d_messages as $d_messages) {
            if ($d_messages->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }

        if (Auth::user()->id == 1) {
            $d_messages = DirectMessages::where('order_id', $order_id)->orderBy('created_at', 'asc')->get();
        } else {
            $d_messages = DirectMessages::where('order_id', $order_id)->where('store_user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        }

        $user = User::where('id' , $sales[0]->user_id)->with('roles','image')->get();

        return view('admin.order.show', compact('user', 'sales','notifications','d_messages','cant_dm_new','direct_m','rating_user','rating_store'));
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
