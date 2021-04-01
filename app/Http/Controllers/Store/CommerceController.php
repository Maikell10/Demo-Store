<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //dd($id);
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
    public function show(Request $request, $name)
    {
        /*$request->session()->regenerate();
        $request->session()->flush();
        $i = ($request->session()->get('hjwebajjasxwk8164qds4.as84') != null) ? sizeof($request->session()->get('hjwebajjasxwk8164qds4.as84')) : 0 ;

        if ($i == 0) {
            $array[$i] = [
                "id_product" => "2",
                "cantidad" => "1",
            ];
        } else {
            for ($a=0; $a <= $i; $a++) { 
                $array[] = [
                    "id_product" => "3",
                    "cantidad" => "1",
                ];
            }
        }
        
        // Retrieve a piece of data from the session...
        //$value = session('hjwebajjasxwk8164qds4.as84');
        session(['hjwebajjasxwk8164qds4.as84' => $array ]);

        $data = $request->session()->get('hjwebajjasxwk8164qds4.as84');
return $data;*/

        $arr_conex_client_t = $this->arr_ip();

        $user = User::where('name', $name)->firstOrFail();

        // Direct Messages
        $controller = new Controller();
        $cant_dm_new = 0;
        $direct_m = 0;
        if (Auth::user() != null) {
            $direct_m = $controller->direct_m(Auth::user()->id);
            foreach ($direct_m as $direct_m1) {
                if ($direct_m1->status == 'NO-VIEW') {
                    $cant_dm_new = $cant_dm_new +1;
                }
            }
        }

        $productos = Product::with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->join('product_user', 'products.id', '=', 'product_user.product_id')->where('product_user.user_id', $user->id)->orderBy('products.nombre')->paginate(
            12,
            ['products.id', 'products.nombre', 'products.slug', 'products.main_category_id', 'products.cantidad', 'products.precio_actual', 'products.precio_anterior', 'products.porcentaje_descuento', 'products.visitas', 'products.ventas', 'products.estado', 'products.activo']
        );


        return view('tienda.commerce.index', compact('user', 'productos', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
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
