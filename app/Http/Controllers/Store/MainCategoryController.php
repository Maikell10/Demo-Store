<?php

namespace App\Http\Controllers\Store;

use App\Category;
use App\Http\Controllers\Controller;
use App\MainCategory;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainCategoryController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $arr_conex_client_t = $this->arr_ip();

        $main_category = MainCategory::where('slug', $slug)->firstOrFail();
        $sub_category = SubCategory::where('id', $main_category->sub_category_id)->firstOrFail();
        $category = Category::where('id', $sub_category->category_id)->firstOrFail();
        //return $category;
        $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->join('main_categories','main_categories.id','=','products.main_category_id')->where('main_category_id', $main_category->id)->inRandomOrder()->paginate(10, 
        ['products.id','products.nombre','products.slug','products.main_category_id','products.cantidad','products.precio_actual','products.precio_anterior','products.porcentaje_descuento','products.visitas','products.ventas','products.estado','products.activo']);

        $user = Auth::user();

        // Direct Messages
        $controller = new Controller();
        $cant_dm_new = 0;
        $direct_m = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m($user->id);
            foreach ($direct_m as $direct_m1) {
                if ($direct_m1->status == 'NO-VIEW') {
                    $cant_dm_new = $cant_dm_new +1;
                }
            }
        }

        return view('tienda.show-main-category', compact('productos', 'main_category','sub_category', 'category', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
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
