<?php

namespace App\Http\Controllers;

use App\Comment;
use App\DirectMessages;
use App\Product;
use App\Sale;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function arr_ip()
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {

            // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER 
            if (array_key_exists($key, $_SERVER)) {

                // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER 
                foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {

                    // Filtramos* la variable y retorna el primero que pase el filtro
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        //$ip = $_SERVER["REMOTE_ADDR"];
                        $arr_conex_client = getCountryFromIP($ip, " NamE ");
                        //$arr_conex_client = (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip)));
                        $date = new DateTime();
                        $arr_conex_client_t[0]['country'] = $arr_conex_client;
                        $arr_conex_client_t[0]['ip'] = $ip;
                        $arr_conex_client_t[0]['date'] = $date->format('d-m-Y H:i:s');
                    } else {
                        $arr_conex_client_t = 0;
                    }
                }
            }
        }
        return $arr_conex_client_t;
    }

    public function set_language($lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            session()->put('applocate', $lang);
        }
        return back();
    }

    public function notifications($id_user)
    {
        $comments_product_user = Comment::select('product_id')->distinct('product_id')->where('parent_id', null)->get();

        $sales = Sale::select('state', 'sales.status', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id', $id_user)->orderBy('sales.created_at', 'desc')->get();
        if ($id_user === 1) {
            $sales = Sale::select('state', 'sales.status', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->orderBy('sales.created_at', 'desc')->get();
        }

        $products = [];
        $cant_coments = 0;
        $date_comment = '';

        $cant_sales = 0;
        $date_sales = [];

        $cant_answers = [];
        $notifications = [];

        foreach ($comments_product_user as $comment_product_user) {
            //$products[] = Product::where('products.id', $comment_product_user->product_id)->with('images','users','comments')->join('product_user','products.id','=','product_user.product_id')->where('user_id',2)->get();

            $product = Product::where('products.id', $comment_product_user->product_id)->with('images','users','comments')->get();

            if ($product[0]->users[0]->id == $id_user || $id_user == 1) {
                $products[] = $product;

                $cant_coments = $cant_coments + Comment::where('parent_id', null)->where('product_id', $comment_product_user->product_id)->where('status', '!=', 'VIEW')->count();
                $cant_answers[] = Comment::where('parent_id', '!=', null)->where('product_id', $comment_product_user->product_id)->count();

                $date = Comment::where('parent_id', null)->where('product_id', $comment_product_user->product_id)->where('status', '!=', 'VIEW')->orderBy('created_at','DESC')->first();
                if ($date['created_at'] != null) {
                    if ($date['created_at']->toDateTimeString() > $date_comment) {
                        $date_comment = $date['created_at'];
                    }
                }
            }
        }

        
        if ($sales != '[]') {
            for ($i=0; $i < count($sales); $i++) { 
                if ($sales[$i]->status == 'NOT VIEW') {
                    $cant_sales = $cant_sales +1;
                    $date_sales[] = $sales[$i]->created_at;
                }
            }
        }

        // $notifications[0] => Cant New Questions
        // $notifications[1] => Date of last New Question
        $notifications[] = [
            $cant_coments,
            $date_comment
        ];
        
        $notifications[] = [
            $cant_sales,
            $date_sales
        ];
        return $notifications;
    }

    public function direct_m($user_id)
    {
        if ($user_id == 1) {
            return $direct_m = DirectMessages::where('status', 'NO-VIEW')->with('users')->orderBy('created_at', 'desc')->get();
        } else {
            return $direct_m = DirectMessages::where('status', 'NO-VIEW')->where('store_user_id', $user_id)->with('users')->orderBy('created_at', 'desc')->get();
        }
    }

    public function direct_m_user($user_id)
    {
        return $direct_m = DirectMessages::where('type', 'STORE')->where('status', 'NO-VIEW')->where('user_id', $user_id)->with('users')->orderBy('created_at', 'desc')->get();
    }
}
