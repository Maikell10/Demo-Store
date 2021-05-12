<?php

namespace App\Http\Controllers\Store;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Mail\QuestionNotification;
use App\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::with('answers')->latest()->get();
        return $comment;
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
        if ($request->ajax()) {
            // Preparing the Mail
            $product = Product::with('users')->where('id', $request->product_id)->firstOrFail();
            $user_client = User::where('id',$request->user_id)->firstOrFail();

            // Sending the email to client
            Mail::to($product->users[0]->email)->queue(new QuestionNotification($product->users[0],$user_client,$product));

            // Save Comment
            $comment = new Comment();

            $comment->product_id = $request->product_id;
            $comment->user_id = $request->user_id;
            $comment->body = $request->pregunta_prod;
            $comment->save();
            
            $res = 'positivo';
            
            return response()->json($res);
        }
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
