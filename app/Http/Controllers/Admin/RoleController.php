<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StorePermission\Models\Role;
use App\StorePermission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('valid_store');
    }
    
    public function index(Request $request)
    {
        Gate::authorize('haveaccess','role.index');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $nombre = $request->get('nombre');
        $roles = Role::where('name', 'like', "%$nombre%")->orderBy('id', 'Asc')->paginate(10);

        return view('admin.role.index', compact('roles','notifications','direct_m'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','role.create');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $permissions = Permission::get();

        return view('admin.role.create', compact('permissions','notifications','direct_m'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess','role.create');
        $request->validate([
            'name' => 'required|max:50|unique:roles,name',
            'slug' => 'required|max:50|unique:roles,slug',
            'full-access' => 'required|in:yes,no',
        ]);

        $role = Role::create($request->all());

        //if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        //}

        return redirect()->route('admin.role.index')->with('status_success', 'Role Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        Gate::authorize('haveaccess','role.show');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }


        $permissions = Permission::get();

        return view('admin.role.show', compact('permissions', 'role', 'permission_role', 'notifications','direct_m'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('haveaccess','role.edit');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }


        $permissions = Permission::get();

        return view('admin.role.edit', compact('permissions', 'role', 'permission_role', 'notifications','direct_m'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('haveaccess','role.edit');
        $request->validate([
            'name' => 'required|max:50|unique:roles,name,'.$role->id,
            'slug' => 'required|max:50|unique:roles,slug,'.$role->id,
            'full-access' => 'required|in:yes,no',
        ]);

        $role->update($request->all());

        //if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        //}

        return redirect()->route('admin.role.index')->with('status_success', 'Role updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('haveaccess','role.destroy');
        $role->delete();

        return redirect()->route('admin.role.index')->with('status_success', 'Role Removed Successfully');
    }
}
