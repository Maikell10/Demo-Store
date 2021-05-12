<?php

namespace App\Http\Controllers\Store;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Image;
use App\Rating;
use App\RatingStore;
use App\Sale;
use App\StorePermission\Models\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image as Imagen;
use Throwable;

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
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        $sales_count = Sale::where('user_id',$user->id)->where('state', 'Finalizada')->count();

        $positive_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', '+')->count();
        $negative_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', '-')->count();
        $neutral_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', 'N')->count();
        
        $array = [];
        $comments = Comment::where('user_id',$user->id)->with('products')->where('parent_id', null)->get();
        
        $ratings = Rating::where('user_id',$user->id)->with('products')->get();

        $rating_stores = RatingStore::where('user_id',$user->id)->where('status', 'USER')->with('store')->get();

        foreach ($comments as $comment) {
            $array[] = [
                'created_at' => $comment->created_at,
                'type' => 'comment',
                'body' => $comment
            ];
        }
        foreach ($ratings as $rating) {
            $array[] = [
                'created_at' => $rating->created_at,
                'type' => 'rating',
                'body' => $rating
            ];
        }
        foreach ($rating_stores as $rating_store) {
            $array[] = [
                'created_at' => $rating_store->created_at,
                'type' => 'rating_store',
                'body' => $rating_store
            ];
        }

        $activities = collect($array)->sortByDesc('created_at')->values();


        return view('user.profile', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m', 'sales_count', 'positive_rating', 'negative_rating', 'neutral_rating', 'activities', 'comments', 'ratings'));
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
            'imagenes' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:15048',
        ]);

        $urlimagen = '';

        if ($request->hasFile('imagenes')) {
            // Deleting Previous Image
            $image_prev = Image::where('imageable_id', Auth::user()->id)->where('imageable_type', 'App\User')->first();
/*
            if ($image_prev) {
                $archivo = substr($image_prev->url, 1);
                File::delete($archivo);
            }*/

            $imagen = $request->file('imagenes');

            if(pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION) == 'jfif') {
                $solo_nombre = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                $nombre = time() . '_' . $solo_nombre . '.jpg';

                $ruta = public_path() . DS . 'imagenes';

                $path = $ruta . DS . $nombre;
                Imagen::make($imagen)->save($path,10);

                $urlimagen = DS . 'imagenes' . DS  . $nombre;
            } else {
                $nombre = time() . '_' . $imagen->getClientOriginalName();

                $ruta = public_path() . DS . 'imagenes';
                
                $path = $ruta . DS . $nombre;
                try {
                    Imagen::make($imagen)->save($path,10);
                } catch (Throwable $e) {
                    return $e;
                }

                $urlimagen = DS . 'imagenes' . DS  . $nombre;
            }

            // Creating or Updating Image in BD
            if ($image_prev) {
                $image_prev->url = $urlimagen;
                $image_prev->save();
            } else {
                $user = User::where('id', Auth::user()->id)->firstOrFail();
                $user->image()->create([
                    'url' => $urlimagen,
                ]);
            }
        }

        return redirect()->route('profile.auth')->with('datos', __('Profile Picture Updated Successfully'));
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

    public function updateUser(Request $request)
    {
        
        if($request->password != '') {
            $request->validate([
                'inputName' => 'required|max:255|string',
                'password' => 'string|min:8|confirmed',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->inputName;
            $user->password = Hash::make($request->password);
            $user->save();

        } else {
            $request->validate([
                'inputName' => 'required|max:255|string',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->inputName;
            $user->save();
        }
                    
        if (isset($user->id)) {
            if ($request->inputProfile == 'store') {
                return redirect()->route('admin.business-profile.index')->with('datos', __('Register Updated Successfully'));
            }
            return redirect()->route('profile.auth')->with('datos', __('Register Updated Successfully'));
        } else {
            if ($request->inputProfile == 'store') {
                return redirect()->route('admin.business-profile.index')->with('fail', __('Update failed'));
            }
            return redirect()->route('profile.auth')->with('fail', __('Update failed'));
        }
    }

    // Public Profile
    public function publicProfile($name)
    {
        $controller = new Controller();
        $arr_conex_client_t = $controller->arr_ip();

        $user = User::where('name', $name)->first();

        $cant_dm_new = 0;
        if ($user != null) {
            $direct_m = $controller->direct_m_user($user->id);
            $cant_dm_new = $controller->cant_dm_new($user->id);
        }

        $sales_count = Sale::where('user_id',$user->id)->where('state', 'Finalizada')->count();

        $positive_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', '+')->count();
        $negative_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', '-')->count();
        $neutral_rating = RatingStore::where('user_id',$user->id)->where('status', 'STORE')->where('rating', 'N')->count();
        
        $array = [];
        $comments = Comment::where('user_id',$user->id)->with('products')->where('parent_id', null)->get();
        
        $ratings = Rating::where('user_id',$user->id)->with('products')->get();

        $rating_stores = RatingStore::where('user_id',$user->id)->where('status', 'USER')->with('store')->get();

        foreach ($comments as $comment) {
            $array[] = [
                'created_at' => $comment->created_at,
                'type' => 'comment',
                'body' => $comment
            ];
        }
        foreach ($ratings as $rating) {
            $array[] = [
                'created_at' => $rating->created_at,
                'type' => 'rating',
                'body' => $rating
            ];
        }
        foreach ($rating_stores as $rating_store) {
            $array[] = [
                'created_at' => $rating_store->created_at,
                'type' => 'rating_store',
                'body' => $rating_store
            ];
        }

        $activities = collect($array)->sortByDesc('created_at')->values();


        return view('user.public_profile', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m', 'sales_count', 'positive_rating', 'negative_rating', 'neutral_rating', 'activities', 'comments', 'ratings'));
    }
}
