<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Image;
use App\Http\Resources\Rating as RatingResources;
use App\Rating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        /*$cat = new Category();
        $cat->nombre = 'Mujer';
        $cat->slug = 'mujer';
        $cat->descripcion = 'Ropa de Mujer';
        $cat->save();
        return $cat;*/

        return Product::all();
    }

    public function show($slug)
    {
        if (Product::where('slug',$slug)->first()) {
            return 'Slug existe';
        }else {
            return 'Slug disponible';
        }
    }

    public function eliminarImagen($id)
    {
        $image = Image::find($id);

        $archivo = substr($image->url,1);

        $eliminar = File::delete($archivo);

        $image->delete();

        return "eliminado id ".$id." ".$eliminar;
    }

    public function setRating(Request $request)
    {
        if ($request->ajax()) {
            $rating = Rating::where('product_id', $request->product_id)->where('user_id', $request->user_id)->count();
            if ($rating == 0) {
                // No existe el rating para el producto y el usuario
                $rating = new Rating();

                $rating->product_id = $request->product_id;
                $rating->user_id = $request->user_id;
                $rating->rating = $request->rating;
                $rating->review = $request->review_rating;
                $rating->save();
            } else {
                // El rating ya existe con el usuario
                $rating = Rating::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
                
                $rating->product_id = $request->product_id;
                $rating->user_id = $request->user_id;
                $rating->rating = $request->rating;
                $rating->review = $request->review_rating;
                $rating->save();
            }
            
            
            if (isset($rating->rating)) {
                $status = 'positivo';
            } else {
                $status = 'negativo';
            }
            
            return response()->json($status);
        }
        return response()->json('negativo');
    }

    public function getRating($id) 
    {
        return RatingResources::collection(Rating::all()->where('product_id', $id));
    }

    public function fillTable(Request $request)
    {
        if ($request->ajax()) {
            $id_product = $request->get('id_product');
            
            $product = Product::where('id', $id_product)->firstOrFail();
    
            $product->cant = 1;
            $product->precio_venta = 0;
            $product->subtotal = 0;

            $product->precio_compra = 0;
            $product->precio_ventaSF = 0;
            $product->subtotalSF = 0;

            return $product;
        }
    }
}
