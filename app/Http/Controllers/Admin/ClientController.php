<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('haveaccess','store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id == 1) {
            $clients = User::with('image')->orderBy('users.id', 'Desc')->get();

            foreach ($clients as $client) {
                $comment = Comment::where('comments.user_id', $client->id)->where('parent_id', NULL)->count();
                if ($comment != '[]') {
                    $comments[$client->id] = $comment;
                }else{
                    $comments[$client->id] = 0;
                }
    
                $sale = Sale::where('state','Finalizada')->where('sales.user_id', $client->id)->count();
                if ($sale != '[]') {
                    $sales[$client->id] = $sale;
                }else{
                    $sales[$client->id] = 0;
                }
            }
        } else {
            $clients = User::select('users.id','users.name','users.email')->with('image')->orderBy('users.id', 'Desc')->join('sales', 'users.id', '=', 'sales.user_id')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->distinct('users.id')->get();

            foreach ($clients as $client) {
                $comment = Comment::where('comments.user_id', $client->id)->where('parent_id', NULL)->join('product_user', 'comments.product_id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->count();
                if ($comment != '[]') {
                    $comments[$client->id] = $comment;
                }else{
                    $comments[$client->id] = 0;
                }
    
                $sale = Sale::where('state','Finalizada')->where('sales.user_id', $client->id)->where('product_user.user_id',Auth::user()->id)->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->count();
                if ($sale != '[]') {
                    $sales[$client->id] = $sale;
                }else{
                    $sales[$client->id] = 0;
                }
            }
        }

        return view('admin.client.index', compact('clients', 'notifications','direct_m','comments','sales'));
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
