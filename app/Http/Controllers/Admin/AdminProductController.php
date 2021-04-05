<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;

use App\MainCategory;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use Intervention\Image\Facades\Image;

DEFINE('DS', DIRECTORY_SEPARATOR);

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess','product.index');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $nombre = $request->get('nombre');

        if(Auth::user()->id == 1) {
            $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$nombre%")->orderBy('nombre')->paginate(10);
        } else {
            $productos = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('user_id', Auth::user()->id)->with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$nombre%")->orderBy('nombre')->paginate(10);
        }
        

        return view('admin.product.index', compact('productos','notifications','direct_m'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','product.create');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $categorias = Category::orderBy('nombre')->get();
        $estados_productos = $this->estados_productos();
        return view('admin.product.create', compact('categorias', 'estados_productos','notifications','direct_m'));
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
            'nombre' => 'required|unique:products,nombre',
            'slug' => 'required|unique:products,slug',
            'imagenes.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:15048',
        ]);

        $urlimagenes = [];

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');

            foreach ($imagenes as $imagen) {
                if(pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION) == 'jfif') {
                    $solo_nombre = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                    $nombre = time() . '_' . $solo_nombre . '.jpg';
    
                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    Image::make($imagen)->save($path,30);
    
                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                } else {
                    $nombre = time() . '_' . $imagen->getClientOriginalName();

                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    Image::make($imagen)->save($path,30);

                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                }
            }
        }

        $prod = new Product();

        $prod->nombre = $request->nombre;
        $prod->slug = $request->slug;
        $prod->main_category_id = $request->main_category_id;
        $prod->cantidad = $request->cantidad;
        $prod->precio_anterior = $request->precioanterior;
        $prod->precio_actual = $request->precioactual;
        $prod->porcentaje_descuento = $request->porcentaje_descuento;
        $prod->descripcion_corta = $request->descripcion_corta;
        $prod->descripcion_larga = $request->descripcion_larga;
        $prod->especificaciones = $request->especificaciones;
        $prod->datos_de_interes = $request->datos_de_interes;
        $prod->estado = $request->estado;

        if ($request->activo) {
            $prod->activo = 'Si';
        } else {
            $prod->activo = 'No';
        }

        if ($request->sliderprincipal) {
            $prod->sliderprincipal = 'Si';
        } else {
            $prod->sliderprincipal = 'No';
        }

        $prod->save();

        $prod->images()->createMany($urlimagenes);

        $prod->users()->sync([Auth::user()->id]);

        //return $prod->images;

        return redirect()->route('admin.product.index')->with('datos', __('Register Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Gate::authorize('haveaccess','product.show');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $producto = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('slug', $slug)->firstOrFail();

        if ($producto->users[0]->id === Auth::user()->id | Auth::user()->id === 1) {
            $categorias = Category::orderBy('nombre')->get();

            $sub_categorias = SubCategory::orderBy('nombre')->get();

            $main_categorias = MainCategory::orderBy('nombre')->get();

            $estados_productos = $this->estados_productos();

            return view('admin.product.show', compact('producto', 'categorias', 'sub_categorias', 'main_categorias', 'estados_productos','notifications','direct_m'));
        } else {
            return redirect()->route('admin.product.index')->with('cancelar', 'No tiene permiso para ver el Producto');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        Gate::authorize('haveaccess','product.edit');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $producto = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('slug', $slug)->firstOrFail();

        //$subCategory = SubCategory::get()->where('category_id', $producto->category->id);

        if ($producto->users[0]->id === Auth::user()->id | Auth::user()->id === 1) {
            $categorias = Category::orderBy('nombre')->get();

            $sub_categorias = SubCategory::orderBy('nombre')->get();

            $main_categorias = MainCategory::orderBy('nombre')->get();

            $estados_productos = $this->estados_productos();

            return view('admin.product.edit', compact('producto', 'categorias', 'sub_categorias', 'main_categorias', 'estados_productos','notifications','direct_m'));
        } else {
            return redirect()->route('admin.product.index')->with('cancelar', 'No tiene permiso para ver el Producto');
        }
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
        $request->validate([
            'nombre' => 'required|unique:products,nombre,' . $id,
            'slug' => 'required|unique:products,slug,' . $id,
            'imagenes.*' => 'image|mimes:jpeg,jpg,png,gif,svg|max:15048',
        ]);

        $urlimagenes = [];

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');

            foreach ($imagenes as $imagen) {
                if(pathinfo($imagen->getClientOriginalName(), PATHINFO_EXTENSION) == 'jfif') {
                    $solo_nombre = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                    $nombre = time() . '_' . $solo_nombre . '.jpg';
    
                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    Image::make($imagen)->save($path,30);
    
                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                } else {
                    $nombre = time() . '_' . $imagen->getClientOriginalName();

                    $ruta = public_path() . DS . 'imagenes';
                    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    Image::make($imagen)->save($path,30);
    
                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                }
            }
        }

        $prod = Product::findOrFail($id);

        $prod->nombre = $request->nombre;
        $prod->slug = $request->slug;
        $prod->main_category_id = $request->main_category_id;
        $prod->cantidad = $request->cantidad;
        $prod->precio_anterior = $request->precioanterior;
        $prod->precio_actual = $request->precioactual;
        $prod->porcentaje_descuento = $request->porcentaje_descuento;
        $prod->descripcion_corta = $request->descripcion_corta;
        $prod->descripcion_larga = $request->descripcion_larga;
        $prod->especificaciones = $request->especificaciones;
        $prod->datos_de_interes = $request->datos_de_interes;
        $prod->estado = $request->estado;

        if ($request->activo) {
            $prod->activo = 'Si';
        } else {
            $prod->activo = 'No';
        }

        if ($request->sliderprincipal) {
            $prod->sliderprincipal = 'Si';
        } else {
            $prod->sliderprincipal = 'No';
        }

        $prod->save();

        $prod->images()->createMany($urlimagenes);

        //return $prod->images;

        return redirect()->route('admin.product.edit', $prod->slug)->with('datos', __('Register Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess','product.destroy');

        $prod = Product::with('images')->findOrFail($id);

        foreach ($prod->images as $image) {
            $archivo = substr($image->url, 1);

            File::delete($archivo);

            $image->delete();
        }

        $prod->delete();

        return redirect()->route('admin.product.index')->with('datos', __('Register Deleted Successfully'));
    }

    public function estados_productos()
    {
        return [
            '',
            'Nuevo',
            'En Oferta',
            'Popular',
            'Usado'
        ];
    }
}
