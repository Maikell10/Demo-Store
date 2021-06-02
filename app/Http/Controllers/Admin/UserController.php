<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StorePermission\Models\Role;
use App\StoreProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('valid_store');
    }
    
    public function index()
    {
        $this->authorize('haveaccess','user.index');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $users = User::with('roles','image')->orderBy('id', 'Desc')->paginate(10);

        return view('admin.user.index', compact('users', 'notifications','direct_m'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$this->authorize('create', User::class);
        return 'Create';*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', [$user, ['user.show','userown.show']]);

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $roles = Role::orderBy('name')->get();

        return view('admin.user.show', compact('roles', 'user', 'notifications','direct_m'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', [$user, ['user.edit','userown.edit']]);

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $roles = Role::orderBy('name')->get();

        $store_profile = StoreProfile::where('user_id', $user->id)->first();
        if ($store_profile == null) {
            $store_profile = 0;
        }

        return view('admin.user.edit', compact('roles', 'user', 'notifications','direct_m','store_profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:50|unique:users,name,' . $user->id,
            'email' => 'required|max:50|unique:users,email,' . $user->id,
        ]);

        $date_expiration = date("Y-m-d",strtotime($request->date_expiration)); 

        $sale = 0;
        if ($request->roles == 3) {
            $sale = 1;
        }

        $user->update($request->all());
        $user->sale = $sale;
        $user->save();

        $store_profile = StoreProfile::where('user_id', $user->id)->first();
        if ($store_profile == '') {
            $store_profile = new StoreProfile();

            $store_profile->user_id = $user->id;
            $store_profile->plan = 1;
            $store_profile->date_expiration = $date_expiration;

            $store_profile->save();
        }else{
            $store_profile->plan = 1;
            $store_profile->date_expiration = $date_expiration;

            $store_profile->save();
        }

        $user->roles()->sync($request->get('roles'));
        
        return redirect()->route('admin.user.index')->with('status_success', 'User updated Successfully');
    }

    public function destroy(User $user)
    {
        $this->authorize('haveaccess','user.destroy');
        $user->delete();

        return redirect()->route('admin.user.index')->with('status_success', 'User Removed Successfully');
    }

    public function plan_subscription(Request $request)
    {
        $date = date("Y-m-d");
        $date_expiration = date("Y-m-d",strtotime($date."+ 1 month")); 

        if ($request->gpont_ == 'gheyudjiqnnsdk15_?daj_DfsR') {
            $user = User::findOrFail($request->auth_user);

            $user->sale = 1;
            $user->save();

            $store_profile = StoreProfile::where('user_id', $user->id)->first();
            if ($store_profile == '') {
                $store_profile = new StoreProfile();

                $store_profile->user_id = $user->id;
                $store_profile->plan = $request->plan;
                $store_profile->date_expiration = $date_expiration;

                $store_profile->save();
            }else{
                $store_profile->plan = $request->plan;
                $store_profile->date_expiration = $date_expiration;

                $store_profile->save();
            }

            return redirect()->back()->with('mensajeSuccess', 'Te has subscrito a nuestro Plan con Éxito!');
        } else {
            return redirect()->back();
        }
    }
}
