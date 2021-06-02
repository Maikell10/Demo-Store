<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Mail\RequestCategoryNotification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('valid_store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess','category.index');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $nombre = $request->get('nombre');
        $categorias = Category::where('nombre', 'like', "%$nombre%")->orderBy('nombre')->with('subCategories', 'subCategories.mainCategories')->get();
        return view('admin.category.index', compact('categorias','notifications','direct_m'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','category.create');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        return view('admin.category.create', compact('notifications', 'direct_m'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess','category.create');

        /*$cat = new Category();
        $cat->nombre = $request->nombre;
        $cat->slug = $request->slug;
        $cat->descripcion = $request->descripcion;
        $cat->save();

        return $cat;*/

        $request->validate([
            'nombre' => 'required|max:50|unique:categories,nombre',
            'slug' => 'required|max:50|unique:categories,slug',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('datos', __('Register Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Gate::authorize('haveaccess','category.show');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $cat = Category::where('slug', $slug)->with('subCategories', 'subCategories.mainCategories')->firstOrFail();
        $editar = 'Si';

        return view('admin.category.show', compact('cat', 'editar', 'notifications', 'direct_m'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        Gate::authorize('haveaccess','category.edit');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $cat = Category::where('slug', $slug)->firstOrFail();
        $editar = 'Si';

        return view('admin.category.edit', compact('cat', 'editar', 'notifications', 'direct_m'));
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
        Gate::authorize('haveaccess','category.edit');

        $cat = Category::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:50|unique:categories,nombre,' . $cat->id,
            'slug' => 'required|max:50|unique:categories,slug,' . $cat->id,
        ]);

        $cat->fill($request->all())->save();

        //return $cat;

        return redirect()->route('admin.category.index')->with('datos', __('Register Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess','category.destroy');

        $cat = Category::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.category.index')->with('datos', __('Register Deleted Successfully'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'id' => 'required'
        ]);

        // Preparing the Mail
        $admin = User::where('id',1)->firstOrFail();

        // Sending the email to client
        Mail::to('maikell.ods10@gmail.com')->queue(new RequestCategoryNotification($admin,Auth::user(),$request->descripcion));

        return redirect()->route('admin.category.index')->with('datos', __('In a period of 24 hours we will inform you of the creation of the category'));
    }
}
