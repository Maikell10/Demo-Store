<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request)
    {
        $palabraabuscar = $request->get('palabraabuscar');
        $user_id = $request->get('user_id_autocomplete');

        if ($user_id == 1) {
            $productos = Product::with('main_category')->where('nombre', 'like', '%' . $palabraabuscar . '%')->orderBy('nombre')->get();
        } 
        else {
            $productos = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('user_id', $user_id)->with('main_category')->where('nombre', 'like', '%' . $palabraabuscar . '%')->orderBy('nombre')->get();
        }

        $resultados = [];
        foreach ($productos as $prod) {
            $encontrartexto = stristr($prod->nombre, $palabraabuscar);

            $prod->encontrar = $encontrartexto;

            $recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));
            $prod->substr = $recortar_palabra;

            $prod->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_palabra</b>", $prod->nombre);

            $main_category = $prod->main_category->nombre;
            $prod->category_negrita = ("En: <b>$main_category</b>");

            $resultados[] = $prod;
        }

        return $resultados;
    }

    public function autocomplete_index(Request $request)
    {
        $palabraabuscar = $request->get('palabraabuscar');
        $applocate = $request->get('applocate');

        $productos = Product::with('main_category')->where('nombre', 'like', '%' . $palabraabuscar . '%')->orderBy('nombre')->get();

        $resultados = [];
        foreach ($productos as $prod) {
            $encontrartexto = stristr($prod->nombre, $palabraabuscar);

            $prod->encontrar = $encontrartexto;

            $recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));
            $prod->substr = $recortar_palabra;

            $prod->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_palabra</b>", $prod->nombre);

            $main_category = $prod->main_category->nombre;
            if ($applocate == 'en') {
                $prod->category_negrita = ("In: <b>$main_category</b>");
            } else {
                $prod->category_negrita = ("En: <b>$main_category</b>");
            }
            
            $prod->tipo = 'prod';

            $resultados[] = $prod;
        }

        $store_users = User::where('name', 'like', '%' . $palabraabuscar . '%')->where('sale',1)->get();
        foreach ($store_users as $store_user) {
            $encontrartexto = stristr($store_user->name, $palabraabuscar);

            $store_user->encontrar = $encontrartexto;

            $recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));
            $store_user->substr = $recortar_palabra;

            $store_user->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_palabra</b>", $store_user->name);

            if ($applocate == 'en') {
                $store_user->category_negrita = ("<b>Store</b>");
            } else {
                $store_user->category_negrita = ("<b>Tienda</b>");
            }

            $store_user->tipo = 'store_user';

            $resultados[] = $store_user;
        }

        return $resultados;
    }
}
