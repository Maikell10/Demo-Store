<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Mail\AnswerNotification;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess','store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $comments_product_user = Comment::select('product_id')->distinct('product_id')->where('parent_id', null)->get();
        $products = [];
        $cant_coments = [];
        $cant_answers = [];
        foreach ($comments_product_user as $comment_product_user) {
            $products[] = Product::where('id', $comment_product_user->product_id)->with('images','users','comments')->get();
            $cant_coments[] = Comment::where('parent_id', null)->where('product_id', $comment_product_user->product_id)->count();
            $cant_answers[] = Comment::where('parent_id', '!=', null)->where('product_id', $comment_product_user->product_id)->count();
        }
        //return $products;
        //return $comments_user = Comment::with('products','products.users','products.images')->where('parent_id', null)->get();

        return view('admin.comment.index', compact('products','cant_coments','cant_answers','notifications','direct_m'));
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
        $request->validate([
            'product_id' => 'required',
            'parent_id' => 'required',
            'body' => 'required',
            'slug' => 'required',
        ]);

        $comment = new Comment();

        $comment->product_id = $request->product_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->body = $request->body;

        $res = $comment->save();

        if ($res == 1) {
            // Preparing the Mail
            $product = Product::with('users')->where('id', $request->product_id)->firstOrFail();
            $comment_parent = Comment::where('id', $request->parent_id)->firstOrFail();
            $user_client = User::where('id',$comment_parent->user_id)->firstOrFail();

            // Sending the email to client
            Mail::to($user_client->email)->queue(new AnswerNotification($product->users[0],$user_client,$product));
        }
        

        return redirect()->back()->with('datos', __('Register Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Gate::authorize('haveaccess','store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $producto = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users', 'comments')->where('slug', $slug)->firstOrFail();

        if ($producto->users[0]->id === Auth::user()->id | Auth::user()->id === 1) {
            if (Auth::user()->id != 1) {
                foreach ($producto->comments as $comment) {
                    $comm = Comment::findOrFail($comment->id);
                    $comm->status = 'VIEW';
                    $comm->save();
                }
            }
            
            $cant_coments = Comment::where('parent_id', null)->where('product_id', $producto->id)->count();
            $cant_answers = Comment::where('parent_id', '!=', null)->where('product_id', $producto->id)->count();
    
            $cant_left = $cant_coments - $cant_answers;
    
            return view('admin.comment.show', compact('producto', 'cant_left','notifications','direct_m'));
        } else {
            return redirect()->route('admin.comment.index')->with('cancelar', __('You do not have permission to view the Question'));
        }
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
