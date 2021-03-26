<?php

namespace App\Http\Controllers\Store;

use App\Category;
use App\Comment;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rating as RatingResources;
use App\Rating;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', '%'.$search.'%')->inRandomOrder()->paginate(8);
        $categories = Category::with('subCategories')->inRandomOrder()->get();

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

        return view('tienda.show-product', compact('productos', 'categories', 'user', 'arr_conex_client_t', 'direct_m', 'cant_dm_new'));
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
        $producto = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('slug', $slug)->firstOrFail();
        $category = Category::where('id', $producto->main_category->sub_category->category_id)->firstOrFail();

        $categorias = Category::orderBy('nombre')->get();

        $arr_conex_client_t = $this->arr_ip();

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

        $comments = Comment::with('answers','users')->where('product_id', $producto->id)->latest()->get();

        return view('tienda.show-product', compact('producto', 'category', 'categorias', 'user', 'comments', 'arr_conex_client_t', 'direct_m', 'cant_dm_new'));
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
