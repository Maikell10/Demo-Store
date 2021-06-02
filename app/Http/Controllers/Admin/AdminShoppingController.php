<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Provider;
use App\Purchase;
use App\PurchaseDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminShoppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('valid_store');
    }
    
    public function index()
    {
        Gate::authorize('haveaccess', 'store.full');

        if (Auth::user()->id === 1) {
            $purchases = Purchase::with('provider','user')->get();
        } else {
            $purchases = Purchase::with('provider','user')->where('user_id', Auth::user()->id)->get();
        }

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        return view('admin.shopping.index', compact('notifications','purchases','direct_m'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'store.full');

        if (Auth::user()->id === 1) {
            $providers = Provider::get();
            $products = Product::with('main_category','images','users')->get();
        } else {
            $providers = Provider::where('user_id', Auth::user()->id)->get();
            $products = Product::with('main_category','images','users')->join('product_user', 'products.id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->orderBy('products.nombre')->get();
        }

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        return view('admin.shopping.create', compact('notifications','providers','products','direct_m'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date("Y-m-d",strtotime($request->date)); 
        
        $user_id = Auth::user()->id;

        $request->validate([
            'provider_id' => 'required',
            'date' => 'required',
            'serie' => 'required',
            'number' => 'required',
            'tax' => 'required',
            'ganancia' => 'required'
        ]);

        // Create Purchase
        $purchase = new Purchase();

        $purchase->date = $date;
        $purchase->provider_id = $request->provider_id;
        $purchase->user_id = $user_id;
        $purchase->serie = $request->serie;
        $purchase->number = $request->number;
        $purchase->tax = $request->tax;
        $purchase->profit = $request->ganancia;
        $purchase->total = $request->total_compra;
        $purchase->state = 'Cargada';

        $purchase->save();

        $products = json_decode($request->products);
        // Create Purchase Details if $products exists
        $cantProd = ($products == null) ? 0 : sizeof($products) ;
        for ($i=0; $i < $cantProd; $i++) { 
            $purchaseDetail = new PurchaseDetail();

            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->user_id = $user_id;
            $purchaseDetail->product_id = json_encode($products[$i]->id);
            $purchaseDetail->cant = json_encode($products[$i]->cant);
            $purchaseDetail->price_purchase = json_encode($products[$i]->precio_compra);
            $purchaseDetail->price_sell = json_encode($products[$i]->precio_ventaSF);

            $purchaseDetail->save();
        }

        return redirect()->route('admin.shopping.index')->with('datos', __('Register Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id === 1) {
            $purchase = Purchase::where('id', $id)->with('provider')->firstOrFail();

            $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->with('product')->get();
        } else {
            $purchase = Purchase::where('id', $id)->where('user_id', Auth::user()->id)->with('provider')->firstOrFail();

            $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->where('user_id', Auth::user()->id)->with('product')->get();
        }

        $editar = 'Si';

        return view('admin.shopping.show', compact('notifications', 'purchase', 'purchase_details', 'editar','direct_m'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id === 1) {
            $purchase = Purchase::where('id', $id)->with('provider')->firstOrFail();

            $providers = Provider::get();

            $products = Product::with('main_category','images')->get();

            $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->with('product')->get();
        } else {
            $purchase = Purchase::where('id', $id)->where('user_id', Auth::user()->id)->with('provider')->firstOrFail();

            $providers = Provider::where('user_id', Auth::user()->id)->get();

            $products = Product::with('main_category','images','users')->join('product_user', 'products.id', '=', 'product_user.product_id')->where('product_user.user_id', Auth::user()->id)->orderBy('products.nombre')->get();

            $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->where('user_id', Auth::user()->id)->with('product')->get();
        }

        $editar = 'Si';

        return view('admin.shopping.edit', compact('notifications', 'purchase', 'providers', 'products', 'purchase_details', 'editar','direct_m'));
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
        $date = date("Y-m-d",strtotime($request->date)); 
        
        $user_id = Auth::user()->id;

        $request->validate([
            'provider_id' => 'required',
            'date' => 'required',
            'serie' => 'required',
            'number' => 'required',
            'tax' => 'required',
            'ganancia' => 'required'
        ]);

        // Create Purchase
        $purchase = Purchase::findOrFail($id);

        $purchase->date = $date;
        $purchase->provider_id = $request->provider_id;
        $purchase->user_id = $user_id;
        $purchase->serie = $request->serie;
        $purchase->number = $request->number;
        $purchase->tax = $request->tax;
        $purchase->profit = $request->ganancia;
        $purchase->total = $request->total_compra;
        $purchase->state = 'Cargada';

        $purchase->save();

        $products = json_decode($request->products);
        // Create Purchase Details if $products exists
        $cantProd = ($products == null) ? 0 : sizeof($products) ;
        for ($i=0; $i < $cantProd; $i++) { 
            $purchaseDetail = new PurchaseDetail();

            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->user_id = $user_id;
            $purchaseDetail->product_id = json_encode($products[$i]->id);
            $purchaseDetail->cant = json_encode($products[$i]->cant);
            $purchaseDetail->price_purchase = json_encode($products[$i]->precio_compra);
            $purchaseDetail->price_sell = json_encode($products[$i]->precio_ventaSF);

            $purchaseDetail->save();
        }

        return redirect()->route('admin.shopping.index')->with('datos', __('Register Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Gate::authorize('haveaccess','store.full');

        $purchase = Purchase::findOrFail($id);

        $purchase->delete();

        return redirect()->route('admin.shopping.index')->with('datos', __('Register Deleted Successfully'));
    }

    public function providers()
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id === 1) {
            $providers = Provider::with('user')->get();
        } else {
            $providers = Provider::where('user_id', Auth::user()->id)->with('user')->get();
        }

        return view('admin.shopping.providers', compact('notifications', 'providers','direct_m'));
    }

    public function providers_show($id)
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);
        
        if (Auth::user()->id === 1) {
            $provider = Provider::where('id', $id)->firstOrFail();
        } else {
            $provider = Provider::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        }

        $editar = 'Si';

        return view('admin.shopping.show_provider', compact('notifications', 'provider', 'editar','direct_m'));
    }

    public function providers_create()
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        return view('admin.shopping.create_provider', compact('notifications','direct_m'));
    }

    public function providers_store(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'name' => 'required|max:255',
            'number' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $email = Provider::where('user_id', $user_id)->where('email', $request->email)->get();

        if (!isset($email[0])) {
            $request['user_id'] = $user_id;
            Provider::create($request->all());

            return redirect()->route('admin.providers')->with('datos', __('Register Created Successfully'));
        }

        return back()->with('cancelar', __('You have already registered this Email for a Provider'));
    }

    public function providers_edit($id)
    {
        Gate::authorize('haveaccess', 'store.full');

        // Notifications
        $notifications = $this->notifications(Auth::user()->id);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        if (Auth::user()->id === 1) {
            $provider = Provider::where('id', $id)->firstOrFail();
        } else {
            $provider = Provider::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        }

        $editar = 'Si';

        return view('admin.shopping.edit_provider', compact('notifications', 'provider', 'editar','direct_m'));
    }

    public function providers_update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $provider = Provider::where('id', $id)->firstOrFail();
    
        $request->validate([
            'name' => 'required|max:255',
            'number' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $email = Provider::where('user_id', $user_id)->where('email', $request->email)->get();

        $provider->fill($request->all())->save();

        return redirect()->route('admin.providers')->with('datos', __('Register Updated Successfully'));
    }

    public function providers_destroy(Request $request)
    {
        Gate::authorize('haveaccess', 'store.full');

        $provider = Provider::findOrFail($request->providerID);
        $provider->delete();

        return back()->with('datos', __('Register Deleted Successfully'));
    }

    public function purchase_detail_destroy(Request $request)
    {
        Gate::authorize('haveaccess', 'store.full');

        $purchase_detail = PurchaseDetail::findOrFail($request->purchaseDetailID);

        $purchase = Purchase::findOrFail($purchase_detail->purchase_id);

        $price_purchase_tax = ($purchase_detail->price_purchase * $purchase->tax)/100;
        $purchase->total = $purchase->total-(($price_purchase_tax + $purchase_detail->price_purchase) * $purchase_detail->cant);
        $purchase->save();

        $purchase_detail->delete();

        return back()->with('datos', __('Register Deleted Successfully'));
    }
}
