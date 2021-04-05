<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request)
    {
        $palabraabuscar = $request->get('palabraabuscar');
        $user_id = $request->get('user_id_autocomplete');

        if ($user_id == 1) {
            $productos = Product::with('main_category')->where('nombre', 'like', '%' . $palabraabuscar . '%')->orderBy('nombre')->get();
        } else {
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
}
