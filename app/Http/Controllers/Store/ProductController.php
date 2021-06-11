<?php

namespace App\Http\Controllers\Store;

use App\Category;
use App\Comment;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rating as RatingResources;
use App\Mail\QuestionNotification;
use App\Rating;
use App\Sale;
use App\StoreProfile;
use App\User;
use App\Visit;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arr_conex_client_t = $this->arr_ip();

        /*
        if (isset($_COOKIE['contador'])) {
            setcookie('contador', $_COOKIE['contador'] + 1, time() + 10);
            dd($_COOKIE['contador']);
        } else {
            setcookie('contador', 1, time() + 10);
            dd($_SERVER['REMOTE_ADDR']);
        }*/

        $search = '';
        if (request()->nombre_producto != '') {
            $search = request()->nombre_producto;
        }
        if (request()->main_search != '') {
            $search = request()->main_search;
        }

        if ($request->all() == null) {
            $productos = Product::select('products.id','products.nombre','products.slug','products.main_category_id','products.cantidad','products.precio_actual','products.precio_anterior','products.porcentaje_descuento','products.estado','main_categories.nombre as nombre_main_cat','sub_categories.nombre as nombre_sub_cat','categories.nombre as nombre_cat')->with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('activo', 'Si')->join('main_categories', 'main_categories.id', '=', 'products.main_category_id')->join('sub_categories', 'sub_categories.id', '=', 'main_categories.sub_category_id')->join('categories', 'categories.id', '=', 'sub_categories.category_id')->join('product_user', 'product_user.product_id', 'products.id')->join('store_profiles', 'store_profiles.user_id', 'product_user.user_id')->where('store_profiles.date_expiration', '>=', date('Y-m-d'))->paginate(8);

            //return $productos = Product::with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('activo', 'Si')->where('nombre', 'like', '%' . $search . '%')->inRandomOrder()->paginate(8);
        }else{
            if ($request->select_rank != null) {
                if ($request->select_rank == 'price_asc') {
                    $rank = 'products.precio_actual';
                    $cond = 'ASC';
                }
                if ($request->select_rank == 'price_desc') {
                    $rank = 'products.precio_actual';
                    $cond = 'DESC';
                }
                if ($request->select_rank == 'newest') {
                    $rank = 'products.created_at';
                    $cond = 'DESC';
                }
            }

            $productos_query = Product::select('products.id','products.nombre','products.slug','products.main_category_id','products.cantidad','products.precio_actual','products.precio_anterior','products.porcentaje_descuento','products.estado','main_categories.nombre as nombre_main_cat','sub_categories.nombre as nombre_sub_cat','categories.nombre as nombre_cat')->with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('products.nombre', 'like', '%' . $search . '%')->where('activo', 'Si')->join('main_categories', 'main_categories.id', '=', 'products.main_category_id')->join('sub_categories', 'sub_categories.id', '=', 'main_categories.sub_category_id')->join('categories', 'categories.id', '=', 'sub_categories.category_id')->join('product_user', 'product_user.product_id', 'products.id')->join('store_profiles', 'store_profiles.user_id', 'product_user.user_id')->where('store_profiles.date_expiration', '>=', date('Y-m-d'));

            ($request->category != null) ? $productos=$productos_query->where('category_id',$request->category) : '';
            ($request->select_rank != null) ? $productos=$productos_query->orderBy($rank,$cond) : '';

            $productos = $productos_query->paginate(8);
        }

        //$categories = Category::with('subCategories')->inRandomOrder()->get();
        $categories = Category::with('subCategories')->orderBy('nombre', 'ASC')->get();

        $user = Auth::user();

        // Direct Messages
        $controller = new Controller();
        $cant_dm_new = 0;
        $direct_m = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        return view('tienda.show-product', compact('productos', 'categories', 'user', 'arr_conex_client_t', 'direct_m', 'cant_dm_new', 'request'));
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
        $can_rate = '[]';
        $rate_old = '[]';

        $producto = Product::with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('slug', $slug)->firstOrFail();
        $category = Category::where('id', $producto->main_category->sub_category->category_id)->firstOrFail();

        $categorias = Category::orderBy('nombre')->get();

        $arr_conex_client_t = $this->arr_ip();
        
        $user = Auth::user();
        if ($user) {
            if ($producto->users[0]->id == $user->id) {
                // The user is the same that the user's onw of the product
            } else {
                // Getting ip Client for visits
                $visit_old = Visit::where('ip_client', FacadesRequest::ip())->where('product_id', $producto->id)->orderBy('created_at', 'DESC')->get();
                if ($visit_old == '[]') {
                    $visit = new Visit();
                    $visit->ip_client = FacadesRequest::ip();
                    $visit->product_id = $producto->id;
                    $visit->save();

                    $prod_v = Product::findOrFail($producto->id);
                    $prod_v->visitas = ($prod_v->visitas) + 1;
                    $prod_v->save();
                } else {
                    if (($visit_old[0]->created_at)->modify('+30 minutes') < Carbon::now()) {
                        $visit = new Visit();
                        $visit->ip_client = FacadesRequest::ip();
                        $visit->product_id = $producto->id;
                        $visit->save();

                        $prod_v = Product::findOrFail($producto->id);
                        $prod_v->visitas = ($prod_v->visitas) + 1;
                        $prod_v->save();
                    }
                }
                $can_rate = Sale::where('user_id', Auth::user()->id)->where('product_id', $producto->id)->get();
                $rate_old = Rating::where('user_id', Auth::user()->id)->where('product_id', $producto->id)->get();
            }
        } else {
            // Getting ip Client for visits
            $visit_old = Visit::where('ip_client', FacadesRequest::ip())->where('product_id', $producto->id)->orderBy('created_at', 'DESC')->get();
            if ($visit_old == '[]') {
                $visit = new Visit();
                $visit->ip_client = FacadesRequest::ip();
                $visit->product_id = $producto->id;
                $visit->save();

                $prod_v = Product::findOrFail($producto->id);
                $prod_v->visitas = ($prod_v->visitas) + 1;
                $prod_v->save();
            } else {
                if (($visit_old[0]->created_at)->modify('+30 minutes') < Carbon::now()) {
                    $visit = new Visit();
                    $visit->ip_client = FacadesRequest::ip();
                    $visit->product_id = $producto->id;
                    $visit->save();

                    $prod_v = Product::findOrFail($producto->id);
                    $prod_v->visitas = ($prod_v->visitas) + 1;
                    $prod_v->save();
                }
            }
        }

        // Set Comments in VIEW if is the same than the auth user
        $coments_auth_user = 0;
        if (auth()->user()) {
            $comments_to_act = Comment::with('answers')->where('user_id', auth()->user()->id)->where('product_id', $producto->id)->where('parent_id', null)->get();

            foreach ($comments_to_act as $comment_to_act) {
                if ($comment_to_act->answers != '[]') {
                    $comment_answer = Comment::where('id',$comment_to_act->answers[0]->id)->first();
                    $comment_answer->status = 'VIEW';
                    $comment_answer->save();
                }
            }

            if ($comments_to_act != '[]') {
                $coments_auth_user = 1;
            }
        }

        // Direct Messages
        $controller = new Controller();
        $cant_dm_new = 0;
        $direct_m = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        $comments = Comment::with('answers', 'users')->where('product_id', $producto->id)->latest()->get();

        $productos_store = Product::select('products.id','porcentaje_descuento','estado','main_category_id','nombre','slug', 'precio_actual')
        ->join('product_user', 'products.id', '=', 'product_user.product_id')
        ->where('user_id', $producto->users[0]->id)
        ->where('products.id', '!=', $producto->id)
        ->with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')
        ->inRandomOrder()->get();

        $store_profile_config =  StoreProfile::where('user_id', $producto->users[0]->id)->first();

        return view('tienda.show-product', compact('producto', 'category', 'categorias', 'user', 'comments', 'arr_conex_client_t', 'direct_m', 'cant_dm_new', 'can_rate', 'rate_old', 'productos_store', 'coments_auth_user', 'store_profile_config'));
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

    public function indexOffer(Request $request)
    {
        $arr_conex_client_t = $this->arr_ip();

        if ($request->all() == null) {
            $productos = Product::with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('activo', 'Si')->where('estado', 'En Oferta')->inRandomOrder()->paginate(8);
        }else{
            if ($request->select_rank != null) {
                if ($request->select_rank == 'price_asc') {
                    $rank = 'products.precio_actual';
                    $cond = 'ASC';
                }
                if ($request->select_rank == 'price_desc') {
                    $rank = 'products.precio_actual';
                    $cond = 'DESC';
                }
                if ($request->select_rank == 'newest') {
                    $rank = 'products.created_at';
                    $cond = 'DESC';
                }
            }

            $productos_query = Product::select('products.id','products.nombre','products.slug','products.main_category_id','products.cantidad','products.precio_actual','products.precio_anterior','products.porcentaje_descuento','products.estado','main_categories.nombre as nombre_main_cat','sub_categories.nombre as nombre_sub_cat','categories.nombre as nombre_cat')->with('images', 'main_category', 'main_category.sub_category', 'main_category.sub_category.category', 'users')->where('estado', 'En Oferta')->where('activo', 'Si')->join('main_categories', 'main_categories.id', '=', 'products.main_category_id')->join('sub_categories', 'sub_categories.id', '=', 'main_categories.sub_category_id')->join('categories', 'categories.id', '=', 'sub_categories.category_id');

            ($request->category != null) ? $productos=$productos_query->where('category_id',$request->category) : '';
            ($request->select_rank != null) ? $productos=$productos_query->orderBy($rank,$cond) : '';

            $productos = $productos_query->paginate(8);
        }

        //$categories = Category::with('subCategories')->inRandomOrder()->get();
        $categories = Category::with('subCategories')->orderBy('nombre', 'ASC')->get();

        $user = Auth::user();

        // Direct Messages
        $controller = new Controller();
        $cant_dm_new = 0;
        $direct_m = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        return view('tienda.show-product', compact('productos', 'categories', 'user', 'arr_conex_client_t', 'direct_m', 'cant_dm_new', 'request'));
    }
}
