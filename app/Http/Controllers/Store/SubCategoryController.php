<?php

namespace App\Http\Controllers\Store;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
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

        $sub_category = SubCategory::with('mainCategories')->where('slug', $slug)->firstOrFail();
        $category = Category::where('id', $sub_category->category_id)->firstOrFail();
        //return $sub_category->id;
        $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->join('main_categories','products.main_category_id','=','main_categories.id')->join('sub_categories','main_categories.sub_category_id','=','sub_categories.id')->where('sub_category_id', $sub_category->id)->inRandomOrder()->paginate(10, 
        ['products.id','products.nombre','products.slug','products.main_category_id','products.cantidad','products.precio_actual','products.precio_anterior','products.porcentaje_descuento','products.visitas','products.ventas','products.estado','products.activo']);

        $user = Auth::user();

        // Direct Messages
        $controller = new Controller();
        $direct_m = 0;
        $cant_dm_new = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        return view('tienda.show-sub-category', compact('productos', 'sub_category', 'category', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
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
