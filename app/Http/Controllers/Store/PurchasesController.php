<?php

namespace App\Http\Controllers\Store;

use App\Cart;
use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Mail\PurchaseNotification;
use App\Mail\PurchaseStoreNotification;
use App\Product;
use App\RatingStore;
use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Messages
        $controller = new Controller();
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        $arr_conex_client_t = $this->arr_ip();

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
                    $sales_h = Sale::where('user_id', Auth::user()->id)->get();

                    if ($sales_h != '[]') {
                        $cont = 0;
                        foreach ($sales_h as $sale_h) {
                            $created_at = strtotime ( '+5 minute' , strtotime ($sale_h->created_at) );
                            $created_at = date ( 'Y-m-d H:i:s' , $created_at );
                            
                            if ($created_at > $today && $sale_h->product_id == $cart->product_id && $sale_h->user_id == Auth::user()->id) {
                                $cont = 1;
                            }
                        }
                        if ($cont == 0) {
                            $sale = new Sale();
                            $sale->product_id = $cart->product_id;
                            $sale->cantidad = $cart->cantidad;
                            $sale->user_id = Auth::user()->id;
                            $sale->price_sale = $products[$index]['precio_actual'];
                            $sale->created_at = $today;
                            $sale->updated_at = $today;
                            $sale->save();

                            $products[$index]['cantidad'] = $products[$index]['cantidad'] - $cart->cantidad;
                            $products[$index]->save();
                        } else {
                            $sale = '0';
                        }
                    } else {
                        $sale = new Sale();
                        $sale->product_id = $cart->product_id;
                        $sale->cantidad = $cart->cantidad;
                        $sale->user_id = Auth::user()->id;
                        $sale->price_sale = $products[$index]['precio_actual'];
                        $sale->created_at = $today;
                        $sale->updated_at = $today;
                        $sale->save();

                        $products[$index]['cantidad'] = $products[$index]['cantidad'] - $cart->cantidad;
                        $products[$index]->save();
                    }

                    if ($sale == '0') {
                        return back()->with('mensajeInfo', __('You just made a similar purchase a few moments ago, please try again later'));
                    }
                    
                    $sales_all[] = $sale;

                    $cart = Cart::where('product_id', $cart->product_id)->where('user_id', Auth::user()->id)->first();
                    $cart->delete();
                    session()->forget('hjwebajjasxwk8164qds4.as84');
                }

                // Enviar correo al cliente
                Mail::to(Auth::user()->email)->queue(new PurchaseNotification(Auth::user(),$sale));

                // Buscar la data para enviar correo de notificacion a la tienda
                foreach ($sales_all as $sale_all) {
                    $product = Product::with('users')->where('id', $sale_all['product_id'])->firstOrFail();
                    $store_users[] = User::where('id', $product->users[0]->id)->firstOrFail();;
                }
                $store_users = array_unique($store_users);
                foreach ($store_users as $store_user) {
                    Mail::to($product->users[0]->email)->queue(new PurchaseStoreNotification(Auth::user(),$sale,$product->users[0]));
                }
                // -----------------------------------------------------------

                $distinct_sale = Sale::select('state', 'updated_at', 'created_at')->distinct('updated_at')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

                $sales = Sale::where('user_id', Auth::user()->id)->with('products')->orderBy('updated_at', 'desc')->get();

                if ($sales == '[]') {
                    $products = '0';
                    return view('tienda.purchases.index', compact('distinct_sale','sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
                }
                // Reset the Products var
                unset($products);
                foreach ($sales as $sale) {
                    $products[] = Product::with('users')->where('id', $sale['product_id'])->firstOrFail();
                }

                return view('tienda.purchases.index', compact('distinct_sale', 'sales', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));

            } else {
                $distinct_sale = Sale::select('state', 'updated_at', 'created_at')->distinct('updated_at')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

                $sales = Sale::where('user_id', Auth::user()->id)->with('products')->orderBy('updated_at', 'desc')->get();

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
        $user = Auth::user();
        
        $arr_conex_client_t = $this->arr_ip();

        $sales = Sale::select('sales.id','sales.product_id','sales.cantidad','sales.user_id','sales.price_sale','sales.state','sales.created_at','sales.updated_at','sales.status','product_user.user_id as store_id','users.name')->where('sales.user_id', $user->id)->with('products')->where('sales.created_at', $id)->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->join('users', 'users.id', '=', 'product_user.user_id')->orderBy('sales.updated_at', 'desc')->get();

        if ($sales == '[]') {
            abort(403, 'Si esta viendo esto, es posible que su sesión activa no sea la misma del correo con el que abrio este enlace');
        }

        $distinct_seller = Sale::select('users.id','users.name','users.verified')->where('sales.user_id', $user->id)->where('sales.created_at', $id)->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->join('users', 'users.id', '=', 'product_user.user_id')->distinct('users.id')->get();

        $order_id = strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id );
        $d_messages = DirectMessages::where('order_id', $order_id)->where('type', 'STORE')->orderBy('created_at', 'asc')->get();

        $d_messages = DirectMessages::where('order_id', $order_id)->where('store_user_id',$distinct_seller[0]->id)->orderBy('created_at', 'asc')->get();

        // Set cant New DM and change status from NO-VIEW to VIEW
        $d_messages_new = DirectMessages::where('type', 'STORE')->where('status', 'NO-VIEW')->where('order_id', $order_id)->where('store_user_id',$distinct_seller[0]->id)->orderBy('created_at', 'asc')->get();
        
        $cant_d_messages_new = $d_messages_new->count();

        foreach ($d_messages_new as $d_message_new) {
            $d_message_new->status = 'VIEW';
            $d_message_new->save();
        }

        // Messages
        $controller = new Controller();
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        return view('tienda.purchases.show', compact('sales', 'user', 'arr_conex_client_t', 'cant_dm_new','distinct_seller','d_messages','order_id','direct_m','id','cant_d_messages_new'));

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
