<?php

namespace App\Http\Controllers\Store;

use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Mail\DMNotification;
use App\Mail\DMStoreNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DirectMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $direct_m = new DirectMessages();

            if ($request->type_dm == 'STORE') {
                $direct_m->order_id = $request->order_id;
                $direct_m->user_id = $request->user_id;
                $direct_m->store_user_id = $request->store_user_id;
                $direct_m->body = $request->direct_m;
                $direct_m->date_order = $request->date_order;
                $direct_m->type = 'STORE';
                $direct_m->status = 'NO-VIEW';
                $res = $direct_m->save();

                if ($res == 1) {
                    // Preparing the Mail
                    $user_client = User::where('id',$request->user_id)->firstOrFail();
                    $user_store = User::where('id',$request->store_user_id)->firstOrFail();

                    // Sending the email to client
                    Mail::to($user_client->email)->queue(new DMNotification($user_store,$user_client,$request->date_order));
                }

                $d_messages = DirectMessages::where('order_id', $request->order_id)->where('type', 'CLIENT')->get();
                foreach ($d_messages as $d_message) {
                    $d_message->status = 'VIEW';
                    $d_message->save();
                }

            } else {
                $direct_m->order_id = $request->order_id;
                $direct_m->user_id = $request->user_id;
                $direct_m->store_user_id = $request->store_user_id;
                $direct_m->body = $request->direct_m;
                $direct_m->date_order = $request->date_order;
                $res = $direct_m->save();

                if ($res == 1) {
                    // Preparing the Mail
                    $user_client = User::where('id',$request->user_id)->firstOrFail();
                    $user_store = User::where('id',$request->store_user_id)->firstOrFail();

                    // Sending the email to client
                    Mail::to($user_store->email)->queue(new DMStoreNotification($user_store,$user_client,$request->date_order));
                }
            }
            
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
