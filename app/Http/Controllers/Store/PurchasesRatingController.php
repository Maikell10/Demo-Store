<?php

namespace App\Http\Controllers\Store;

use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\RatingStore;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $arr_conex_client_t = $this->arr_ip();

        $user = Auth::user();

        $user_store = User::where('id', $request->store_id)->get();

        $order_id = strftime("%j%d%G-%H%M%S", strtotime($request->created) . $user->id );

        $d_messages = DirectMessages::where('order_id', $order_id)->where('type', 'STORE')->orderBy('created_at', 'asc')->get();

        $cant_dm_new = 0;
        foreach ($d_messages as $d_messages) {
            if ($d_messages->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }

        $sale = Sale::where('created_at', $request->created)->where('user_id', $user->id)->get('updated_at');
        
        return view('tienda.rating_purchases.index', compact('user', 'arr_conex_client_t', 'cant_dm_new','d_messages','order_id','direct_m', 'request', 'user_store', 'sale'));
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
        
            $rating_store = new RatingStore();

            $rating_store->user_id = $request->user_id;
            $rating_store->store_user_id = $request->store_user_id;
            if ($request->calification == 'si') {
                $rating_store->rating = '+';
            }
            if ($request->calification == 'no') {
                $rating_store->rating = '-';
            }
            if ($request->calification == 'neutro') {
                $rating_store->rating = 'N';
            }
            $rating_store->opinion = $request->opinion;
            $rating_store->selectOption = $request->selectOption;
            $rating_store->status = $request->type_rating;
            $rating_store->created_sale = $request->created_sale;
            $rating_store->save();

            if ($request->type_rating == 'STORE') {

                $sales = Sale::select('sales.id','sales.state', 'sales.price_sale', 'sales.cantidad', 'sales.updated_at', 'sales.created_at', 'sales.user_id', 'sales.product_id', 'sales.status')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->with('products')->where('sales.created_at', $request->created_sale)->get();

                foreach ($sales as $sale) {
                    $sale_e = Sale::findOrFail($sale->id);

                    $sale_e->state = $request->statusC;

                    $sale_e->save();
                }
                
            }
            
            $res = 'positivo';
    
            return response()->json($res);
        
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
    public function destroy($id)
    {
        //
    }
}
