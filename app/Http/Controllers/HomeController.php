<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $user = Auth::user();

        $arreglo = session()->get('hjwebajjasxwk8164qds4.as84');
        session()->regenerate();

        // Retrieve a piece of data from the session...
        session(['hjwebajjasxwk8164qds4.as84' => $arreglo]);

        if ($user->id == 1) {
            return redirect()->route('admin');
            //return view('plantilla.admin');
        } 
        elseif ($user->sale == 0) {
            return redirect()->route('profile.auth');
        }
        else {
            return redirect()->route('user');
        }
        
    }
}
