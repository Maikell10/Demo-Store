<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Image as AppImage;
use App\MainCategory;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use Yajra\DataTables\DataTables;

use Intervention\Image\Facades\Image;

DEFINE('DS', DIRECTORY_SEPARATOR);

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('valid_store');

        // Public Path Servidor
        $this->public_path = '/home/u904324574/domains/tuminimercado.com/public_html';
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
//->paginate(10);
/*
        if(Auth::user()->id == 1) {
            $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$nombre%")->orderBy('nombre')->get();
        } else {
            $productos = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('user_id', Auth::user()->id)->with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$nombre%")->orderBy('nombre')->get();
        }*/
        

        return view('admin.product.index', compact('notifications','direct_m'));
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
    
                    //$ruta = $this->public_path . DS . 'imagenes';
                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    $img = Image::make($imagen);
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save($path,50);
    
                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                } else {
                    $nombre = time() . '_' . $imagen->getClientOriginalName();

                    //$ruta = $this->public_path . DS . 'imagenes';
                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    $img = Image::make($imagen);
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save($path,50);

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
        $prod->marca = $request->marca;
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
            return redirect()->route('admin.product.index')->with('cancelar', __('You do not have permission to view the Product'));
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
            return redirect()->route('admin.product.index')->with('cancelar', __('You do not have permission to view the Product'));
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
    
                    //$ruta = $this->public_path . DS . 'imagenes';
                    $ruta = public_path() . DS . 'imagenes';
    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    $img = Image::make($imagen);
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save($path,50);
    
                    $urlimagenes[]['url'] = DS . 'imagenes' . DS  . $nombre;
                } else {
                    $nombre = time() . '_' . $imagen->getClientOriginalName();

                    //$ruta = $this->public_path . DS . 'imagenes';
                    $ruta = public_path() . DS . 'imagenes';
                    
                    //$imagen->move($ruta, $nombre);
                    $path = $ruta . DS . $nombre;
                    $img = Image::make($imagen);
                    $img->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save($path,50);
    
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
        $prod->marca = $request->marca;
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

    public function getProduct(Request $request)
    {
        //$products = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$request->nombre%")->get();

        if(Auth::user()->id == 1) {
            $products = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$request->nombre%")->where('activo', 'Si')->orderBy('nombre')->get();
        } else {
            $products = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('user_id', Auth::user()->id)->with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$request->nombre%")->where('activo', 'Si')->orderBy('nombre')->get();
        }

        return DataTables::of($products)
                ->addColumn('image', function($products) {
                    if ($products->images->count() <= 0) {
                        return '<img style="height:90px;width:90px"
                        src="/imagenes/boxed-bg.jpg" class="rounded-circle">';
                    } else {
                        return '<img style="height:90px;width:90px" src="'.$products->images->random()->url.'"
                        class="rounded-circle">';
                    }
                })
                
                ->addColumn('action', '<a class="hover_zoom mr-2" href="{{route(\'admin.product.show\', $slug)}}" class="btn btn-info btn-sm"><i class="far fa-eye fa-2x text-primary"></i></a>
                <a class="hover_zoom mr-2" href="{{route(\'admin.product.edit\',$slug)}}"><i class="fas fa-pencil-alt fa-2x text-warning"></i></a>')
                ->rawColumns(['image','action'])
                ->toJson();

                //<a class="hover_zoom mr-2" href="{{route(\'admin.product.index\')}}" v-on:click.prevent="deseas_eliminar({{$id}})"><i class="fas fa-times-circle fa-2x text-danger"></i></a>
    }

    public function getProductI(Request $request)
    {
        if(Auth::user()->id == 1) {
            $products = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$request->nombre%")->where('activo', 'No')->orderBy('nombre')->get();
        } else {
            $products = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('user_id', Auth::user()->id)->with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('nombre', 'like', "%$request->nombre%")->where('activo', 'No')->orderBy('nombre')->get();
        }

        return DataTables::of($products)
                ->addColumn('image', function($products) {
                    if ($products->images->count() <= 0) {
                        return '<img style="height:90px;width:90px"
                        src="/imagenes/boxed-bg.jpg" class="rounded-circle">';
                    } else {
                        return '<img style="height:90px;width:90px" src="'.$products->images->random()->url.'"
                        class="rounded-circle">';
                    }
                })
                
                ->addColumn('action', '<a class="hover_zoom mr-2" href="{{route(\'admin.product.show\', $slug)}}" class="btn btn-info btn-sm"><i class="far fa-eye fa-2x text-primary"></i></a>
                <a class="hover_zoom mr-2" href="{{route(\'admin.product.edit\',$slug)}}"><i class="fas fa-pencil-alt fa-2x text-warning"></i></a>')
                ->rawColumns(['image','action'])
                ->toJson();

                //<a class="hover_zoom mr-2" href="{{route(\'admin.product.index\')}}" v-on:click.prevent="deseas_eliminar({{$id}})"><i class="fas fa-times-circle fa-2x text-danger"></i></a>
    }

    public function ProductActive(Request $request, $id)
    {
        return $request;
    }

    public function ImageRotateLeft($id)
    {
        $imagen = AppImage::findOrFail($id)->url;

        //$ruta = $this->public_path;
        $ruta = public_path();
    
        $path = $ruta . '' . $imagen;
        // create Image from file
        $img = Image::make($path);

        // rotate image 90 degrees clockwise
        $img->rotate(90);

        $img->save($path);

        return redirect()->back()->with('datos', __('Image Rotated Left Successfully'));
    }

    public function ImageRotateRight($id)
    {
        $imagen = AppImage::findOrFail($id)->url;

        //$ruta = $this->public_path;
        $ruta = public_path();
    
        $path = $ruta . '' . $imagen;
        // create Image from file
        $img = Image::make($path);

        // rotate image 90 degrees clockwise
        $img->rotate(-90);

        $img->save($path);

        return redirect()->back()->with('datos', __('Image Rotated Right Successfully'));
    }
}
