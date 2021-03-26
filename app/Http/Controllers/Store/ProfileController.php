<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

DEFINE('DS', DIRECTORY_SEPARATOR);

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controller = new Controller();
        $arr_conex_client_t = $controller->arr_ip();
        $user = Auth::user();

        $cant_dm_new = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m($user->id);
            foreach ($direct_m as $direct_m1) {
                if ($direct_m1->status == 'NO-VIEW') {
                    $cant_dm_new = $cant_dm_new +1;
                }
            }
        }

        return view('user.profile', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
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
            'imagenes.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $urlimagen = '';

        if ($request->hasFile('imagenes')) {
            $imagen = $request->file('imagenes');

            $nombre = time() . '_' . $imagen->getClientOriginalName();

            $ruta = public_path() . DS . 'imagenes';

            $imagen->move($ruta, $nombre);

            $urlimagen = DS . 'imagenes' . DS  . $nombre;
            
        }

        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->image()->create([
            'url' => $urlimagen,
        ]);

        return redirect()->route('profile')->with('datos', __('Register Created Successfully'));
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
