<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StorePermission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('admin.user.edit', compact('roles', 'user', 'notifications','direct_m'));
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

        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('admin.user.index')->with('status_success', 'User updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('haveaccess','user.destroy');
        $user->delete();

        return redirect()->route('admin.user.index')->with('status_success', 'User Removed Successfully');
    }
}
