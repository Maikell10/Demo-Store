<?php

namespace App\Http\Controllers\Store;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr_conex_client_t = $this->arr_ip();
        $direct_m = 0;

        if (isset(Auth::user()->name)) {
            $sessions = session()->get('hjwebajjasxwk8164qds4.as84');
            session()->forget('hjwebajjasxwk8164qds4.as84');

            $carts = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($carts as $cart) {
                $products[] = Product::where('id', $cart['product_id'])->firstOrFail();
                $arreglo[] = [
                    "id_product" => $cart['product_id'],
                    "cantidad" => $cart['cantidad'],
                ];
                // Retrieve a piece of data from the session...
                session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
            }

            if (count($carts) == 0) {
                if (isset($sessions)) {

                    // Cargar los items del carrito al usuario si no existe ningun item para el usuario
                    foreach ($sessions as $session) {
                        $cart = new Cart();

                        $cart->product_id = $session['id_product'];
                        $cart->cantidad = $session['cantidad'];
                        $cart->user_id = Auth::user()->id;
                        $cart->save();

                        $arreglo[] = [
                            "id_product" => $session['id_product'],
                            "cantidad" => $session['cantidad'],
                        ];
                        $products[] = Product::where('id', $session['id_product'])->firstOrFail();
                        // Retrieve a piece of data from the session...
                        session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
                    }
                }else{
                    $products[0] = 0;
                }
            }


            $sessions = session()->get('hjwebajjasxwk8164qds4.as84');

            $user = Auth::user();

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

            return view('tienda.cart.index', compact('sessions', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
        }

        $sessions = session()->get('hjwebajjasxwk8164qds4.as84');

        if ($sessions != null) {
            foreach ($sessions as $session) {
                $products[] = Product::where('id', $session['id_product'])->firstOrFail();
            }
        } else {
            $products[0] = 0;
        }

        $user = Auth::user();

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

        return view('tienda.cart.index', compact('sessions', 'products', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
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
    public function destroy(Request $request, $id)
    {
        if (isset(Auth::user()->name)) {
            $id = $request->product_id;
            $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->count();

            if ($cart != 0) {
                $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
                $cart->delete();
            }
            session()->forget('hjwebajjasxwk8164qds4.as84');
            return back();
        }

        // No hay sesión iniciada
        session()->forget('hjwebajjasxwk8164qds4.as84.' . $id . '');

        $sessions = session()->get('hjwebajjasxwk8164qds4.as84');
        session()->pull('hjwebajjasxwk8164qds4.as84');
        session()->put('hjwebajjasxwk8164qds4.as84', array_values($sessions));

        $arr_conex_client_t = $this->arr_ip();


        if ($sessions != null) {
            foreach ($sessions as $session) {
                $products[] = Product::where('id', $session['id_product'])->firstOrFail();
            }
        }

        $user = Auth::user();



        //return view('tienda.cart.index', compact('sessions', 'products', 'user', 'arr_conex_client_t'));
        //return redirect('store/cart');
        return back();
    }

    public function addToCart(Request $request, $id)
    {
        if (isset(Auth::user()->name)) {
            session()->forget('hjwebajjasxwk8164qds4.as84');

            $arreglo = $request->session()->get('hjwebajjasxwk8164qds4.as84');
            $request->session()->regenerate();

            $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->count();
            if ($cart == 0) {
                // No existe el producto en el carrito
                $cart = new Cart();

                $product = Product::findOrFail($id);
                if ($product->cantidad > 0) {
                    $cart->product_id = $id;
                    $cart->cantidad = 1;
                    $cart->user_id = Auth::user()->id;
                    $cart->save();
                } else {
                    $res = "negativo";
                    return response()->json($res);
                }
                
            } else {
                // El producto ya existe en el carrito
                $cartE = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->get();
                $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();

                $product = Product::findOrFail($id);

                if ($cart->cantidad <  $product->cantidad) {
                    $cart->product_id = $id;
                    $cart->cantidad = $cartE[0]['cantidad'] + 1;
                    $cart->user_id = Auth::user()->id;
                    $cart->save();
                } else {
                    $res = "negativo";
                    return response()->json($res);
                }
            }

            $carts = Cart::get();
            foreach ($carts as $cart) {
                $products[] = Product::where('id', $cart['product_id'])->firstOrFail();
                $arreglo[] = [
                    "id_product" => $cart['product_id'],
                    "cantidad" => $cart['cantidad'],
                ];
                // Retrieve a piece of data from the session...
                session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
            }

            return back();
        } else {
            $arreglo = $request->session()->get('hjwebajjasxwk8164qds4.as84');
            $request->session()->regenerate();

            $i = ($request->session()->get('hjwebajjasxwk8164qds4.as84') != null) ? sizeof($request->session()->get('hjwebajjasxwk8164qds4.as84')) : 0;

            if ($i == 0) {
                $product = Product::findOrFail($id);
                if ($product->cantidad > 0) {
                    $arreglo[] = [
                        "id_product" => "$id",
                        "cantidad" => "1",
                    ];
                } else {
                    $res = "negativo";
                    return response()->json($res);
                }
                
            } else {
                for ($a = 0; $a < $i; $a++) {
                    if ($arreglo[$a]['id_product'] === $id) {
                        $product = Product::where('id', $id)->firstOrFail();
                        if ($arreglo[$a]['cantidad'] < $product->cantidad) {
                            $arreglo[$a] = [
                                "id_product" => "$id",
                                "cantidad" => $arreglo[$a]['cantidad'] + 1,
                            ];
                        } else {
                            $res = "negativo";
                            return response()->json($res);
                        }
                    }
                }
            }

            // Retrieve a piece of data from the session...
            session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);

            //$key = array_search($id, array_column($arreglo, 'id_product'));
            $key = in_array($id, array_column($arreglo, 'id_product'));

            if ($key == null) {
                $arreglo[] = [
                    "id_product" => "$id",
                    "cantidad" => "1",
                ];
                // Retrieve a piece of data from the session...
                session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
            }
            $data = $request->session()->get('hjwebajjasxwk8164qds4.as84');

            return back();
        }
    }

    public function addToCartE(Request $request, $id)
    {
        if (isset(Auth::user()->name)) {
            session()->forget('hjwebajjasxwk8164qds4.as84');

            $arreglo = $request->session()->get('hjwebajjasxwk8164qds4.as84');
            $request->session()->regenerate();

            $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->count();
            if ($cart == 0) {
                // No existe el producto en el carrito
                $cart = new Cart();

                $cart->product_id = $id;
                $cart->cantidad = $request->cantidad;
                $cart->user_id = Auth::user()->id;
                $cart->save();
            } else {
                // El producto ya existe en el carrito
                $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();

                $product = Product::findOrFail($id);

                if ($cart->cantidad <  $product->cantidad) {
                    $cart->product_id = $id;
                    $cart->cantidad = $request->cantidad;
                    $cart->user_id = Auth::user()->id;
                    $cart->save();
                } else {
                    $res = "negativo";
                    return response()->json($res);
                }
            }

            $carts = Cart::get();
            foreach ($carts as $cart) {
                $products[] = Product::where('id', $cart['product_id'])->firstOrFail();
                $arreglo[] = [
                    "id_product" => $cart['product_id'],
                    "cantidad" => $cart['cantidad'],
                ];
                // Retrieve a piece of data from the session...
                session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
            }

            return back();
        }

        // Si no hay sessión iniciada...
        if ($request->ajax()) {
            $arreglo = $request->session()->get('hjwebajjasxwk8164qds4.as84');

            $request->session()->regenerate();

            $i = ($request->session()->get('hjwebajjasxwk8164qds4.as84') != null) ? sizeof($request->session()->get('hjwebajjasxwk8164qds4.as84')) : 0;

            if ($i == 0) {
                $arreglo[] = [
                    "id_product" => "$id",
                    "cantidad" => $request->cantidad,
                ];
            } else {
                for ($a = 0; $a < $i; $a++) {
                    if ($arreglo[$a]['id_product'] === $id) {
                        $arreglo[$a] = [
                            "id_product" => "$id",
                            "cantidad" => $request->cantidad,
                        ];
                    }
                }
            }

            // Retrieve a piece of data from the session...
            session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);

            //$key = array_search($id, array_column($arreglo, 'id_product'));
            $key = in_array($id, array_column($arreglo, 'id_product'));

            if ($key == null) {
                $arreglo[] = [
                    "id_product" => "$id",
                    "cantidad" => "$request->cantidad",
                ];
                // Retrieve a piece of data from the session...
                session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);
            }

            $data = $request->session()->get('hjwebajjasxwk8164qds4.as84');
            //return $data;

            $res = "positivo";

            return response()->json($res);
        } else {
            return back();
        }
    }
}
