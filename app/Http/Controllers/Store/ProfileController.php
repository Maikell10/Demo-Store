<?php

namespace App\Http\Controllers\Store;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Rating;
use App\RatingStore;
use App\Sale;
use App\StoreProfile;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Image AS Imagen;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use Throwable;

DEFINE('DS', DIRECTORY_SEPARATOR);

class ProfileController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('verified');

        // Public Path Servidor
        $this->public_path = '/home/u904324574/domains/tuminimercado.com/public_html';
    }
    
    public function index()
    {
        $this->middleware('auth');
        $this->middleware('verified');

        $controller = new Controller();
        $arr_conex_client_t = $controller->arr_ip();

        $user = Auth::user();

        $store_profile = null;
        $dif_date_plan = null;
        if ($user != null) {
            $store_profile = StoreProfile::where('user_id', $user->id)->first();

            if ($store_profile != null) {
                $today = date("Y-m-d");
                $date1 = new DateTime($today);
                $date2 = new DateTime($store_profile->date_expiration);
                $diff = $date1->diff($date2);

                // Comprobando los días restantes
                $dif_date_plan = ($diff->invert == 1) ? ' - ' . $diff->days  : $diff->days;
            }
        }

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


        return view('user.profile', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m', 'sales_count', 'positive_rating', 'negative_rating', 'neutral_rating', 'activities', 'comments', 'ratings','store_profile','dif_date_plan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagenes' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:15048',
        ]);

        $urlimagen = '';

        if ($request->hasFile('imagenes')) {
            // Deleting Previous Image
            $image_prev = Imagen::where('imageable_id', Auth::user()->id)->where('imageable_type', 'App\User')->first();

            if ($image_prev) {
                $archivo = substr($image_prev->url, 1);
                File::delete($archivo);
            }

            $imagen = $request->file('imagenes');

            if(pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION) == 'jfif') {
                $solo_nombre = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                $nombre = time() . '_' . $solo_nombre . '.jpg';

                //$ruta = $this->public_path . DS . 'imagenes';
                $ruta = public_path() . DS . 'imagenes';

                $path = $ruta . DS . $nombre;
                $img = Image::make($imagen);
                $img->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save($path,50);

                $urlimagen = DS . 'imagenes' . DS  . $nombre;
            } else {
                $nombre = time() . '_' . $imagen->getClientOriginalName();

                //$ruta = $this->public_path . DS . 'imagenes';
                $ruta = public_path() . DS . 'imagenes';
                
                $path = $ruta . DS . $nombre;
                try {
                    $img = Image::make($imagen);
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save($path,50);
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

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

        $store_profile = StoreProfile::where('user_id', $user->id)->first();

        return view('user.public_profile', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m', 'sales_count', 'positive_rating', 'negative_rating', 'neutral_rating', 'activities', 'comments', 'ratings', 'store_profile'));
    }
}
