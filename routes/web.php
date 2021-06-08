<?php

use App\Product;
use App\Category;
use App\Comment;
use App\DirectMessages;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Sale;
use App\StoreProfile;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/set_language/{lang}', 'Controller@set_language')->name('set_language');

// E-mail verification
Route::get('/register/verify/{code}', 'GuestController@verify');

Route::get('/terminos', function () {
    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    $user = Auth::user();

    // Direct Messages
    $controller = new Controller();
    $cant_dm_new = 0;
    $direct_m = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m_user($user->id);
        $cant_dm_new = $controller->cant_dm_new($user->id);
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
    $direct_m = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m_user($user->id);
        $cant_dm_new = $controller->cant_dm_new($user->id);
    }

    return view('politicas', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
});

Route::get('/contact', function () {
    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    $user = Auth::user();

    // Direct Messages
    $controller = new Controller();
    $cant_dm_new = 0;
    $direct_m = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m_user($user->id);
        $cant_dm_new = $controller->cant_dm_new($user->id);
    }

    return view('contact', compact('user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m'));
});

Route::get('/delete_user', function () {
    return 'Próximamente';
});

Route::get('/', function () {

    //$productos = Product::with('images', 'category', 'users')->orderBy('nombre')->paginate(10);
    $productos = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('activo', 'Si')->inRandomOrder()->get();
    $categories = Category::with('subCategories')->inRandomOrder()->get();
    //return $productos;

    $controller = new Controller();
    $arr_conex_client_t = $controller->arr_ip();
    
    $user = Auth::user();

    // Direct Messages
    $cant_dm_new = 0;
    $direct_m = 0;
    if ($user != null) {
        $direct_m = $controller->direct_m_user($user->id);
        $cant_dm_new = $controller->cant_dm_new($user->id);
    }

    $populars = Product::with('images', 'main_category', 'main_category.sub_category','main_category.sub_category.category', 'users')->where('activo', 'Si')->orderBy('visitas','DESC')->inRandomOrder()->take(6)->get();
    
    return view('tienda.index', compact('productos', 'categories', 'user', 'arr_conex_client_t', 'cant_dm_new', 'direct_m', 'populars'));
});

// Ruta de Registro Store
Route::resource('/register/store', 'Auth\RegisterStoreController')->names('auth.register-store');

// Ruta de Productos
Route::resource('/store/show-product', 'Store\ProductController')->names('tienda.show-product');
Route::get('/store/show-product-offer', 'Store\ProductController@indexOffer')->name('tienda.show-product.offer');

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

//Public Profile
Route::get('/p/{name}', 'Store\ProfileController@publicProfile')->name('profile.user');


Auth::routes(['verify' => true]);

// Routes Socialite
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

// Profile
Route::get('/profile/auth', 'Store\ProfileController@index')->name('profile.auth')->middleware('auth','verified');
Route::resource('profile', 'Store\ProfileController')->names('profile')->middleware('auth');
Route::post('/profile/updateUser', 'Store\ProfileController@updateUser')->name('profile.updateUser')->middleware('auth','verified');

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

        // Sales Grafic Chart
        $priceSaleSumT = [];
        $priceSaleSumT_ant = [];
        $saleCanT = [];
        $saleCanT_ant = [];
        $year_act = Carbon::now()->format('Y');
        if (Carbon::now()->format('m') <= '07') {
            for ($i=1; $i < 8; $i++) { 
                $priceSalesSum = Sale::where('state', 'Finalizada')->whereYear('updated_at', '=', $year_act)->whereMonth('updated_at', '=', $i)->get();
                $priceSalesSumD = 0;
                foreach ($priceSalesSum as $priceSaleSum) {
                    $priceSalesSumD = $priceSalesSumD + ($priceSaleSum['price_sale'] * $priceSaleSum['cantidad']);
                }
                $priceSaleSumT[] = $priceSalesSumD;
                $saleCanT[] = $priceSalesSum->count();

                $priceSalesSum_ant = Sale::where('state', 'Finalizada')->whereYear('updated_at', '=', $year_act-1)->whereMonth('updated_at', '=', $i)->get();
                $priceSalesSumD_ant = 0;
                foreach ($priceSalesSum_ant as $priceSaleSum_ant) {
                    $priceSalesSumD_ant = $priceSalesSumD_ant + ($priceSaleSum_ant['price_sale'] * $priceSaleSum_ant['cantidad']);
                }
                $priceSaleSumT_ant[] = $priceSalesSumD_ant;
                $saleCanT_ant[] = $priceSalesSum_ant->count();
            }
        } else {
            for ($i=6; $i <= 12; $i++) { 
                $priceSalesSum = Sale::where('state', 'Finalizada')->whereYear('updated_at', '=', $year_act)->whereMonth('updated_at', '=', $i)->get();
                $priceSalesSumD = 0;
                foreach ($priceSalesSum as $priceSaleSum) {
                    $priceSalesSumD = $priceSalesSumD + ($priceSaleSum['price_sale'] * $priceSaleSum['cantidad']);
                }
                $priceSaleSumT[] = $priceSalesSumD;
                $saleCanT[] = $priceSalesSum->count();

                $priceSalesSum_ant = Sale::where('state', 'Finalizada')->whereYear('updated_at', '=', $year_act-1)->whereMonth('updated_at', '=', $i)->get();
                $priceSalesSumD_ant = 0;
                foreach ($priceSalesSum_ant as $priceSaleSum_ant) {
                    $priceSalesSumD_ant = $priceSalesSumD_ant + ($priceSaleSum_ant['price_sale'] * $priceSaleSum_ant['cantidad']);
                }
                $priceSaleSumT_ant[] = $priceSalesSumD_ant;
                $saleCanT_ant[] = $priceSalesSum_ant->count();
            }
        }

        // Sales This Month and Last Month
        $sales_tm = $priceSaleSumT[Carbon::now()->format('n') - 1];
        if (Carbon::now()->format('n') == 1) {
            $sales_lm = 0;
        } else {
            $sales_lm = $priceSaleSumT[Carbon::now()->format('n') - 2];
        }
        // Get the Profit since last month
        if ($sales_lm != 0) {
            if($sales_tm != 0) {
                $profit_sales = (($sales_tm * 100) / $sales_lm) - 100;
            } else {
                $profit_sales = 0;
            }
        } else {
            $profit_sales = 100;
        }

        // Categories Sales for Pie Chart
        $category_sales_cant = [];
        $category_sales = Sale::join('products', 'sales.product_id', '=', 'products.id')->join('main_categories', 'products.main_category_id', '=', 'main_categories.id')->join('sub_categories', 'main_categories.sub_category_id', '=', 'sub_categories.id')->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', Carbon::now()->format('m'))->orderBy('category_id','ASC')->distinct()->get('category_id');

        foreach ($category_sales as $category_sale) {
            $category_sales_cant[] = Sale::join('products', 'sales.product_id', '=', 'products.id')->join('main_categories', 'products.main_category_id', '=', 'main_categories.id')->join('sub_categories', 'main_categories.sub_category_id', '=', 'sub_categories.id')->where('category_id',$category_sale->category_id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', Carbon::now()->format('m'))->count();
        }

        $user_count = User::count();
        return view('admin', compact('products','user_count','prod_cant','comments_count','answers_count','purchases_count','notifications','direct_m','sales_count','sales_canceled_count','visits','profit_visits','total_sale','total_sales_count','priceSaleSumT','priceSaleSumT_ant','saleCanT','saleCanT_ant','category_sales','category_sales_cant','profit_sales'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('admin')->middleware('auth','isseller');


Route::get('/user', function () {
    if (Auth::user()->roles[0]->slug == 'registeredseller' || Auth::user()->id == 1) {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        $products = Product::join('product_user', 'products.id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->get();
        $prod_cant = 0;
        foreach ($products as $product) {
            $prod_cant = $prod_cant + $product->cantidad;
        }

        $comments_count = Comment::join('product_user', 'comments.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('parent_id', null)->count();
        $answers_count = Comment::join('product_user', 'comments.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('parent_id', '!=', null)->count();

        $purchases_count = Purchase::where('user_id',Auth::user()->id)->count();

        $sales_count = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('state', 'Finalizada')->orderBy('sales.created_at', 'desc')->count();

        $sales_canceled_count = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('state', 'Cancelada')->where('product_user.user_id',Auth::user()->id)->count();

        // Visits
        $visits = Visit::select('ip_client','visits.created_at')->join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->orderBy('visits.created_at', 'desc')->get();
        // Visits This Week and Last Week
        $visits_tw = Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('visits.created_at', '<=', Carbon::now())->where('visits.created_at', '>=', Carbon::now()->subDays(6))->get()->count();
        $visits_lw = Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('visits.created_at', '<=', Carbon::now()->subDays(7))->where('visits.created_at', '>=', Carbon::now()->subDays(14))->get()->count();
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
        $total_sales_count = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->count();
        $total_sale = 0;
        $sales = Sale::where('state', 'Finalizada')->get();
        foreach ($sales as $sale) {
            $total_sale = $total_sale + ($sale->price_sale * $sale->cantidad);
        }

        // Sales Grafic Chart
        $priceSaleSumT = [];
        $priceSaleSumT_ant = [];
        $saleCanT = [];
        $saleCanT_ant = [];
        $year_act = Carbon::now()->format('Y');
        if (Carbon::now()->format('m') <= '07') {
            for ($i=1; $i < 8; $i++) { 
                $priceSalesSum = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', $i)->get();
                $priceSalesSumD = 0;
                foreach ($priceSalesSum as $priceSaleSum) {
                    $priceSalesSumD = $priceSalesSumD + ($priceSaleSum['price_sale'] * $priceSaleSum['cantidad']);
                }
                $priceSaleSumT[] = $priceSalesSumD;
                $saleCanT[] = $priceSalesSum->count();

                $priceSalesSum_ant = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act-1)->whereMonth('sales.updated_at', '=', $i)->get();
                $priceSalesSumD_ant = 0;
                foreach ($priceSalesSum_ant as $priceSaleSum_ant) {
                    $priceSalesSumD_ant = $priceSalesSumD_ant + ($priceSaleSum_ant['price_sale'] * $priceSaleSum_ant['cantidad']);
                }
                $priceSaleSumT_ant[] = $priceSalesSumD_ant;
                $saleCanT_ant[] = $priceSalesSum_ant->count();
            }
        } else {
            for ($i=6; $i <= 12; $i++) { 
                $priceSalesSum = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', $i)->get();
                $priceSalesSumD = 0;
                foreach ($priceSalesSum as $priceSaleSum) {
                    $priceSalesSumD = $priceSalesSumD + ($priceSaleSum['price_sale'] * $priceSaleSum['cantidad']);
                }
                $priceSaleSumT[] = $priceSalesSumD;
                $saleCanT[] = $priceSalesSum->count();

                $priceSalesSum_ant = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act-1)->whereMonth('sales.updated_at', '=', $i)->get();
                $priceSalesSumD_ant = 0;
                foreach ($priceSalesSum_ant as $priceSaleSum_ant) {
                    $priceSalesSumD_ant = $priceSalesSumD_ant + ($priceSaleSum_ant['price_sale'] * $priceSaleSum_ant['cantidad']);
                }
                $priceSaleSumT_ant[] = $priceSalesSumD_ant;
                $saleCanT_ant[] = $priceSalesSum_ant->count();
            }
        }

        // Sales This Month and Last Month
        $sales_tm = $priceSaleSumT[Carbon::now()->format('n') - 1];
        if (Carbon::now()->format('n') == 1) {
            $sales_lm = 0;
        } else {
            $sales_lm = $priceSaleSumT[Carbon::now()->format('n') - 2];
        }
        // Get the Profit since last month
        if ($sales_lm != 0) {
            if($sales_tm != 0) {
                $profit_sales = (($sales_tm * 100) / $sales_lm) - 100;
            } else {
                $profit_sales = 0;
            }
        } else {
            $profit_sales = 100;
        }

        // Categories Sales for Pie Chart
        $category_sales_cant = [];
        $category_sales = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->join('products', 'sales.product_id', '=', 'products.id')->join('main_categories', 'products.main_category_id', '=', 'main_categories.id')->join('sub_categories', 'main_categories.sub_category_id', '=', 'sub_categories.id')->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', Carbon::now()->format('m'))->orderBy('category_id','ASC')->distinct()->get('category_id');

        foreach ($category_sales as $category_sale) {
            $category_sales_cant[] = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->join('products', 'sales.product_id', '=', 'products.id')->join('main_categories', 'products.main_category_id', '=', 'main_categories.id')->join('sub_categories', 'main_categories.sub_category_id', '=', 'sub_categories.id')->where('category_id',$category_sale->category_id)->where('state', 'Finalizada')->whereYear('sales.updated_at', '=', $year_act)->whereMonth('sales.updated_at', '=', Carbon::now()->format('m'))->count();
        }

        // Count Clients
        $clients = User::select('users.id','users.name','users.email')->join('sales', 'users.id', '=', 'sales.user_id')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->distinct('users.id')->count();

        //return $comments = Comment::with('products','products.users')->join('product_user', 'comments.product_id', '=', 'product_user.product_id')->where('product_user.user_id', 6)->get();

        // Store Profile
        $dif_date_plan = null;
        $store_profile = StoreProfile::where('user_id', Auth::user()->id)->first();

        $today = date("Y-m-d");
        $date1 = new DateTime($today);
        $date2 = new DateTime($store_profile->date_expiration);
        $diff = $date1->diff($date2);

        // Comprobando los días restantes
        $dif_date_plan = ($diff->invert == 1) ? ' - ' . $diff->days  : $diff->days;

        return view('user.user', compact('notifications','direct_m','sales_canceled_count','visits','profit_visits','total_sale','total_sales_count','priceSaleSumT','priceSaleSumT_ant','saleCanT','saleCanT_ant','category_sales','category_sales_cant','profit_sales','products','prod_cant','comments_count','answers_count','purchases_count','sales_count','clients','store_profile','dif_date_plan'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('user')->middleware('auth','verified','isseller','valid_store');


// Bounce Rate
Route::get('admin/bounce', function () {
    if (Auth::user()->roles[0]->slug == 'admin') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        $sales_canceled_count = Sale::select('state', 'sales.updated_at', 'sales.created_at')->join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('state', 'Cancelada')->orderBy('sales.created_at', 'desc')->count();

        // Total Sales
        $total_sales_count = Sale::count();

        return view('admin.bounce', compact('notifications','direct_m','sales_canceled_count','total_sales_count'));
    }
    if (Auth::user()->roles[0]->slug == 'registeredseller') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        $sales_canceled_count = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('state', 'Cancelada')->where('product_user.user_id',Auth::user()->id)->count();

        // Total Sales
        $total_sales_count = Sale::join('product_user', 'sales.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->count();
        $total_sale = 0;
        $sales = Sale::where('state', 'Finalizada')->get();
        foreach ($sales as $sale) {
            $total_sale = $total_sale + ($sale->price_sale * $sale->cantidad);
        }

        return view('admin.bounce', compact('notifications','direct_m','sales_canceled_count','total_sales_count'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('admin.bounce')->middleware('auth','verified','isseller');

// Product Visits
Route::get('admin/products-visits', function () {
    if (Auth::user()->roles[0]->slug == 'admin') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

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

        return view('admin.visits', compact('notifications','direct_m','total_sales_count','visits','profit_visits'));
    }
    if (Auth::user()->roles[0]->slug == 'registeredseller') {
        // Notifications
        $controller = new Controller();
        $notifications = $controller->notifications(Auth::user()->id);

        // Messages
        $direct_m = $controller->direct_m(Auth::user()->id);

        // Visits
        $visits = Visit::select('ip_client','visits.created_at')->join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->orderBy('visits.created_at', 'desc')->get();
        // Visits This Week and Last Week
        $visits_tw = Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('visits.created_at', '<=', Carbon::now())->where('visits.created_at', '>=', Carbon::now()->subDays(6))->get()->count();
        $visits_lw = Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->where('visits.created_at', '<=', Carbon::now()->subDays(7))->where('visits.created_at', '>=', Carbon::now()->subDays(14))->get()->count();
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

        return view('admin.visits', compact('notifications','direct_m','total_sales_count','visits','profit_visits'));
    }
    return redirect('/')->with('mensajeInfo', 'No tiene permiso para entrar aquí');
})->name('admin.visits')->middleware('auth','verified','isseller');


// Admin
Route::resource('admin/category', 'Admin\AdminCategoryController')->names('admin.category');
Route::post('admin/category/addCategory', 'Admin\AdminCategoryController@addCategory')->name('admin.category.addCategory');
// Admin Product
Route::resource('admin/product', 'Admin\AdminProductController')->names('admin.product');
Route::get('admin/getProduct','Admin\AdminProductController@getProduct')->name('admin.getProduct');
Route::get('admin/getProductI','Admin\AdminProductController@getProductI')->name('admin.getProductI');
Route::put('admin/ProductActive','Admin\AdminProductController@ProductActive')->name('admin.ProductActive');

Route::get('cancelar/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancelar', 'Acción Cancelada');
})->name('cancelar');



// Comments
Route::resource('admin/comment', 'Admin\CommentController')->names('admin.comment')->middleware('auth','verified');

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
Route::resource('admin/order', 'Admin\OrderController')->names('admin.order')->middleware('auth','verified');

// Sales
Route::resource('admin/sale', 'Admin\SaleController')->names('admin.sale')->middleware('auth','verified');


// Roles y Permisos
Route::resource('admin/role', 'Admin\RoleController')->names('admin.role');

Route::resource('admin/user', 'Admin\UserController', ['except' => ['create', 'store']])->names('admin.user');

// Clients User Store
Route::resource('admin/client', 'Admin\ClientController')->names('admin.client');



// Client Orders
Route::resource('/store/purchases', 'Store\PurchasesController')->names('tienda.purchases')->middleware('auth');

// Client Rating Product
Route::resource('/store/rating_purchases', 'Store\PurchasesRatingController')->names('tienda.rating_purchases')->middleware('auth','verified');
Route::get('store/rating_seller','Store\PurchasesRatingController@store');


// Direct Messages
Route::get('direct_message/new','Store\DirectMessageController@store');


// Business Profile
Route::resource('/admin/business-profile/configuration', 'Admin\BusinessProfileController')->names('admin.business-profile')->middleware('auth');

// Plan Subscribe
Route::get('plan_subscription/subscribe','Admin\UserController@plan_subscription');