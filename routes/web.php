<?php

use App\Product;
use App\Category;
use App\Comment;
use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Image;
use App\Purchase;
use App\Sale;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/set_language/{lang}', 'Controller@set_language')->name('set_language');

Route::get('/terminos', function () {
    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    $user = Auth::user();

    // Direct Messages
    $controller = new Controller();
    $cant_dm_new = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m($user->id);
        foreach ($direct_m as $direct_m1) {
            if ($direct_m1->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }
    }

    return view('terminos', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
});

Route::get('/politicas', function () {
    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    $user = Auth::user();

    // Direct Messages
    $controller = new Controller();
    $cant_dm_new = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m($user->id);
        foreach ($direct_m as $direct_m1) {
            if ($direct_m1->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }
    }

    return view('politicas', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
});

Route::get('/', function () {

    //$productos = Product::with('images', 'category', 'users')->orderBy('nombre')->paginate(10);
    $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->inRandomOrder()->get();
    $categories = Category::with('subCategories')->inRandomOrder()->get();
    //return $productos;

    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    
    $user = Auth::user();

    $cant_dm_new = 0;
    if ($user != null) {
        $direct_m = DirectMessages::where('user_id', $user->id)->where('type', 'STORE')->orderBy('created_at', 'asc')->get();
        foreach ($direct_m as $direct_m1) {
            if ($direct_m1->status == 'NO-VIEW') {
                $cant_dm_new = $cant_dm_new +1;
            }
        }
    }

    //return $direct_m;
    
    return view('tienda.index', compact('productos', 'categories', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
});

// Ruta de Registro Store
Route::resource('/register/store', 'Auth\RegisterStoreController')->names('auth.register-store');

// Ruta de Productos
Route::resource('/store/show-product', 'Store\ProductController')->names('tienda.show-product');

// Ruta de Categorias
Route::resource('/store/show-category', 'Store\CategoryController')->names('tienda.show-category');
Route::resource('/store/show-sub-category', 'Store\SubCategoryController')->names('tienda.show-sub-category');
Route::resource('/store/show-main-category', 'Store\MainCategoryController')->names('tienda.show-main-category');

// Ruta del Vendedor
Route::resource('/commerce', 'Store\CommerceController')->names('tienda.commerce');

// Ruta del Carrito
Route::resource('/store/cart', 'Store\ShoppingCartController')->names('tienda.cart');
Route::get('/store/cart/add/{id}', 'Store\ShoppingCartController@addToCart');
// Add Product in Carrito 
Route::get('/store/cart/adde/{id}', 'Store\ShoppingCartController@addToCartE');


// Comments
Route::get('comment/new','Store\CommentController@store');



Auth::routes(['verify' => true]);

// Routes Socialite
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

// Profile
Route::get('/profile', 'Store\ProfileController@index')->name('profile')->middleware('auth','verified');
Route::resource('profile/upload', 'Store\ProfileController')->names('profile.upload')->middleware('auth','verified');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Notifications
Route::get('/notifications', function () {
    // Notifications
    $controller = new Controller();
    $notifications = $controller->notifications(Auth::user()->id);

    // Messages
    $direct_m = $controller->direct_m(Auth::user()->id);
    
    return view('user.notifications', compact('notifications','direct_m'));
})->name('user.notifications')->middleware('auth','isseller');

Route::get('/admin', function () {
    if (Auth::user()->roles[0]->slug == 'admin') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        $products = Product::get();
        $prod_cant = 0;
        foreach ($products as $product) {
            $prod_cant = $prod_cant + $product->cantidad;
        }

        $comments_count = Comment::with('products','products.users')->where('parent_id', null)->count();
        $answers_count = Comment::with('products','products.users')->where('parent_id', '!=', null)->count();

        $purchases_count = Purchase::count();

        $sales_count = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('state', 'Finalizada')->orderBy('sales.created_at', 'desc')->count();

        $sales_canceled_count = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('state', 'Cancelada')->orderBy('sales.created_at', 'desc')->count();

        // Visits
        $visits = Visit::orderBy('created_at', 'desc')->get();
        // Visits This Week and Last Week
        $visits_tw = Visit::where('created_at', '<=', Carbon::now())->where('created_at', '>=', Carbon::now()->subDays(6))->get()->count();
        $visits_lw = Visit::where('created_at', '<=', Carbon::now()->subDays(7))->where('created_at', '>=', Carbon::now()->subDays(14))->get()->count();
        // Get the Profit since last week
        if ($visits_lw != 0) {
            if($visits_tw != 0) {
                $profit_visits = (($visits_tw * 100) / $visits_lw) - 100;
            } else {
                $profit_visits = 0;
            }
        } else {
            $profit_visits = 100;
        }

        // Total Sales
        $total_sales_count = Sale::count();
        $total_sale = 0;
        $sales = Sale::where('state', 'Finalizada')->get();
        foreach ($sales as $sale) {
            $total_sale = $total_sale + ($sale->price_sale * $sale->cantidad);
        }
        

        $user_count = User::count();
        return view('admin', compact('products','user_count','prod_cant','comments_count','answers_count','purchases_count','notifications','direct_m','sales_count','sales_canceled_count','visits','profit_visits','total_sale','total_sales_count'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('admin')->middleware('auth','isseller');


Route::get('/user', function () {
    if (Auth::user()->roles[0]->slug == 'registeredseller') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        //return $comments = Comment::with('products','products.users')->join('product_user', 'comments.product_id', '=', 'product_user.product_id')->where('product_user.user_id', 6)->get();
        return view('user.user', compact('notifications','direct_m'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('user')->middleware('auth','verified','isseller');



// Admin
Route::resource('admin/category', 'Admin\AdminCategoryController')->names('admin.category');
Route::resource('admin/product', 'Admin\AdminProductController')->names('admin.product');

Route::get('cancelar/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancelar', 'Acción Cancelada');
})->name('cancelar');



// Comments
Route::resource('admin/comment', 'Admin\CommentController')->names('admin.comment');

// Compras
Route::resource('admin/shopping', 'Admin\AdminShoppingController')->names('admin.shopping');
Route::get('admin/providers', 'Admin\AdminShoppingController@providers')->name('admin.providers');
Route::get('admin/providers/show/{id}', 'Admin\AdminShoppingController@providers_show')->name('admin.providers.show');
Route::get('admin/providers/create', 'Admin\AdminShoppingController@providers_create')->name('admin.providers.create');
Route::post('admin/providers/store', 'Admin\AdminShoppingController@providers_store')->name('admin.providers.store');
Route::get('admin/providers/edit/{id}', 'Admin\AdminShoppingController@providers_edit')->name('admin.providers.edit');
Route::put('admin/providers/update/{id}', 'Admin\AdminShoppingController@providers_update')->name('admin.providers.update');
Route::delete('admin/providers/destroy/{id}', 'Admin\AdminShoppingController@providers_destroy')->name('admin.providers.destroy');

Route::delete('admin/purchaseDetail/destroy/{id}', 'Admin\AdminShoppingController@purchase_detail_destroy')->name('admin.purchaseDetail.destroy');


// Orders
Route::resource('admin/order', 'Admin\OrderController')->names('admin.order');

// Sales
Route::resource('admin/sale', 'Admin\SaleController')->names('admin.sale');


// Roles y Permisos
Route::resource('admin/role', 'Admin\RoleController')->names('admin.role');

Route::resource('admin/user', 'Admin\UserController', ['except' => ['create', 'store']])->names('admin.user');



// Client Orders
Route::resource('/store/purchases', 'Store\PurchasesController')->names('tienda.purchases')->middleware('auth');

// Client Rating Product
Route::resource('/store/rating_purchases', 'Store\PurchasesRatingController')->names('tienda.rating_purchases')->middleware('auth');
Route::get('store/rating_seller','Store\PurchasesRatingController@store');


// Direct Messages
Route::get('direct_message/new','Store\DirectMessageController@store');
