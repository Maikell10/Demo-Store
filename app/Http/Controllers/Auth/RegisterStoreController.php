<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\StoreProfile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr_conex_client_t = $this->arr_ip();

        $user = Auth::user();
        $store_profile = null;
        $dif_date_plan = null;
        if ($user != null) {
            $store_profile = StoreProfile::where('user_id', $user->id)->first();

            $today = date("Y-m-d");
            $date1 = new DateTime($today);
            $date2 = new DateTime($store_profile->date_expiration);
            $diff = $date1->diff($date2);

            // Comprobando los días restantes
            $dif_date_plan = ($diff->invert == 1) ? ' - ' . $diff->days  : $diff->days;
        }

        // Direct Messages
        $cant_dm_new = 0;
        $direct_m = 0;
        if ($user != null) {
            $direct_m = $this->direct_m_user($user->id);
            $cant_dm_new = $this->cant_dm_new($user->id);
        }

        return view('auth.register-store', compact('arr_conex_client_t','direct_m','cant_dm_new','user','store_profile','dif_date_plan'));
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
