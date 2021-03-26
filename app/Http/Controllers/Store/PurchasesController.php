<?php

namespace App\Http\Controllers\Store;

use App\Cart;
use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Product;
use App\RatingStore;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arr_conex_client_t = $this->arr_ip();

        $user = Auth::user();
        $today = date('Y-m-d H:i:s');

        // Verificar si existe usuario logueado
        if (isset(Auth::user()->name)) {
            $distinct_sale = Sale::select('state', 'updated_at', 'created_at')->distinct('updated_at')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

            // Verificar si viene del carrito
            if ($request->gpont_ === 'gheyudjiqnnsdk15_?daj_DfsR') {
                $carts = Cart::where('user_id', Auth::user()->id)->get();
                if ($carts == '[]') {
                    return redirect('store/purchases');
                }
                
                foreach ($carts as $index => $cart) {
                    $products[] = Product::where('id', $cart['product_id'])->firstOrFail();
                    $sales_h = Sale::get();

                    if ($sales_h != '[]') {
                        $cont = 0;
                        foreach ($sales_h as $sale_h) {
                            $created_at = strtotime ( '+2 hour' , strtotime ($sale_h->created_at) );
                            $created_at = date ( 'Y-m-d H:i:s' , $created_at );

                            
                            if ($created_at > $today && $sale_h->product_id == $cart->product_id && $sale_h->user_id == Auth::user()->id) {
                                $cont = 1;
                            }
                        }
                        if ($cont === 0) {
                            $sale = new Sale();
                            $sale->product_id = $cart->product_id;
                            $sale->cantidad = $cart->cantidad;
                            $sale->user_id = Auth::user()->id;
                            $sale->price_sale = $products[$index]['precio_actual'];
                            $sale->save();
                        }
                    } else {
                        $sales = new Sale();
                        $sales->product_id = $cart->product_id;
                        $sales->cantidad = $cart->cantidad;
                        $sales->user_id = Auth::user()->id;
                        $sales->price_sale = $products[$index]['precio_actual'];
                        $sales->save();
                    }

                    $cart = Cart::where('product_id', $cart->product_id)->where('user_id', Auth::user()->id)->first();
                    $cart->delete();
                    session()->forget('hjwebajjasxwk8164qds4.as84');
                }

                $distinct_sale = Sale::select('state', 'updated_at', 'created_at')->distinct('updated_at')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

                $sales = Sale::where('user_id', Auth::user()->id)->with('products')->orderBy('updated_at', 'desc')->get();

                // Direct Messages
                $controller = new Controller();
                $cant_dm_new = 0;
                if ($user != null) {
                    $direct_m = $controller->direct_m($user->id);
                    foreach ($direct_m as $direct_m1) {
                        if ($direct_m1->status == 'NO-VIEW') {
                            $cant_dm_new = $cant_dm_new +1;
                        }
                    }
                }

                if ($sales == '[]') {
                    $products = '0';
                    return view('tienda.purchases.index', compact('distinct_sale','sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
                }
                foreach ($sales as $sale) {
                    $products[] = Product::with('users')->where('id', $sale['product_id'])->firstOrFail();
                }
                
                return view('tienda.purchases.index', compact('distinct_sale', 'sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));

            } else {
                $distinct_sale = Sale::select('state', 'updated_at', 'created_at')->distinct('updated_at')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

                $sales = Sale::where('user_id', Auth::user()->id)->with('products')->orderBy('updated_at', 'desc')->get();

                // Direct Messages
                $controller = new Controller();
                $cant_dm_new = 0;
                if ($user != null) {
                    $direct_m = $controller->direct_m($user->id);
                    foreach ($direct_m as $direct_m1) {
                        if ($direct_m1->status == 'NO-VIEW') {
                            $cant_dm_new = $cant_dm_new +1;
                        }
                    }
                }

                if ($sales == '[]') {
                    $products = '0';
                    return view('tienda.purchases.index', compact('distinct_sale','sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
                }
                foreach ($sales as $sale) {
                    $products[] = Product::with('users')->where('id', $sale['product_id'])->firstOrFail();
                }

                return view('tienda.purchases.index', compact('distinct_sale','sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
            }
        } else {
            return back();
        }
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
        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $arr_conex_client_t = $this->arr_ip();

        $user = Auth::user();

        $sales = Sale::select('sales.id','sales.product_id','sales.cantidad','sales.user_id','sales.price_sale','sales.state','sales.created_at','sales.updated_at','sales.status','product_user.user_id as store_id','users.name')->where('sales.user_id', $user->id)->with('products')->where('sales.updated_at', $id)->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->join('users', 'users.id', '=', 'product_user.user_id')->orderBy('sales.updated_at', 'desc')->get();

        $distinct_seller = Sale::select('users.id','users.name')->where('sales.user_id', $user->id)->where('sales.updated_at', $id)->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->join('users', 'users.id', '=', 'product_user.user_id')->distinct('users.id')->get();

        $order_id = strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id );
        $d_messages = DirectMessages::where('order_id', $order_id)->where('type', 'STORE')->orderBy('created_at', 'asc')->get();

        $cant_dm_new = 0;
        foreach ($d_messages as $d_messages) {
            if ($d_messages->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }
        $d_messages = DirectMessages::where('order_id', $order_id)->where('store_user_id',$distinct_seller[0]->id)->orderBy('created_at', 'asc')->get();

        return view('tienda.purchases.show', compact('sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new','distinct_seller','d_messages','order_id','direct_m','id'));

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
