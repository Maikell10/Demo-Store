<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StoreProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BusinessProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'store.full');

        //$this->authorize('haveaccess','product.index');

        // Notifications
        $notifications = $this->notifications(Auth::user()['id']);

        // Messages
        $direct_m = $this->direct_m(Auth::user()->id);

        $user = User::with('roles','image')->where('id', Auth::user()->id)->firstOrFail();

        $store_profile_config =  StoreProfile::where('user_id', $user->id)->get();

        return view('admin.business_profile', compact('user', 'notifications','direct_m','store_profile_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'inputPhone' => 'nullable|max:18',
            'inputFacebook' => 'nullable|url',
            'inputTwitter' => 'nullable|url',
            'inputInstagram' => 'nullable|url',
            'inputGoogleMaps' => 'nullable|url',
        ]);

        if (!Auth::user()) {
            return redirect()->back();
        }

        $store_profile_config = new StoreProfile();

        $store_profile_config->user_id = Auth::user()->id;
        $store_profile_config->contact_phone = $request->inputPhone;
        $store_profile_config->facebook = $request->inputFacebook;
        $store_profile_config->twitter = $request->inputTwitter;
        $store_profile_config->instagram = $request->inputInstagram;
        $store_profile_config->gmaps = $request->inputGoogleMaps;

        $store_profile_config->save();

        return redirect()->back()->with('datos', __('Register Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'inputPhone' => 'nullable|max:18',
            'inputFacebook' => 'nullable|url',
            'inputTwitter' => 'nullable|url',
            'inputInstagram' => 'nullable|url',
            'inputGoogleMaps' => 'nullable|url',
        ]);

        if ($id != Auth::user()->id) {
            return redirect()->back();
        }

        // Update Store Profile
        $store_profile_config = StoreProfile::where('user_id', $id)->first();

        $store_profile_config->contact_phone = $request->inputPhone;
        $store_profile_config->facebook = $request->inputFacebook;
        $store_profile_config->twitter = $request->inputTwitter;
        $store_profile_config->instagram = $request->inputInstagram;
        $store_profile_config->gmaps = $request->inputGoogleMaps;

        $store_profile_config->save();

        return redirect()->back()->with('datos', __('Register Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
