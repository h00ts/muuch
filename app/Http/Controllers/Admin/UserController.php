<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserActivateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Activation;
use App\Ilucentro;
use App\Permission;
use App\Mail\UserActivated;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::doesntHave('activation')->get();
        $inactive = User::whereHas('activation', function ($query) {
            $query->where('updated_at', '<', Carbon::today()->subWeek());
        })->get();
        $inactive = User::whereHas('activation', function ($query) {
            $query->where('updated_at', '<', Carbon::today()->subWeek());
        })->get();
        $roles = Role::all();
        $permissions = Permission::all();
        $trashed = User::onlyTrashed()->get();

        return view('admin.users.index')->withUsers($users)->withInactive($inactive)->withRoles($roles)->withPermissions($permissions)->withTrashed($trashed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $ilucentros = Ilucentro::all();
        return view('admin.users.create')->withRoles($roles)->withIlucentros($ilucentros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt('prometeo');
        $user = User::create($data);
        if($request->file('image'))
        {
            $user->addMediaFromRequest('image')->toMediaCollection('user', 's3');
        }
        $user->active = 1;
        $user->attachRole($request->input('user_role'));
        $activation = $user->activation()->create([
            'token' => hash_hmac('sha256', str_random(40), config('app.key')),
            'completed' => 0
        ]);
        $user->save();

        Mail::to($user->email)->send(new UserActivated($activation, $user));

        return redirect()->back()->withSuccess('Has activado a '.$user->email);
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
    public function edit(User $user)
    {
        $roles = Role::all();
        $ilucentros = Ilucentro::all();
        $media = $user->getMedia();

        return view('admin.users.edit', $user->toArray())->withUser($user)->withRoles($roles)->withIlucentros($ilucentros)->withMedia($media);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $activate = $request->input('activate');
        if($activate){
            $user->active = 1;
            $user->attachRole($request->input('user_role'));
            $activation = $user->activation()->create([
                'token' => hash_hmac('sha256', str_random(40), config('app.key')),
                'completed' => 0
            ]);
            $user->save();

            Mail::to($user->email)->send(new UserActivated($activation, $user));

            return redirect()->back()->withSuccess('Has activado a '.$user->email);
        }

        $data = $request->all();
        $user->update($data);
        $user->roles()->detach();
        $user->attachRole($request->input('role_user'));
        if($request->file('image'))
        {
            $user->addMediaFromRequest('image')->toMediaCollection('profile');
        }

        return redirect()->back()->withSuccess('Has actualizado al usuario '.$user->email);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->active = 0;
        $user->save();
        $user->delete();

        return redirect()->back()->withSuccess('El usuario '.$user->email.' ha sido desactivado y no podra ingresar a MUUCH.');
    }

    public function restore(Request $request)
    {
        if($restore){
            $user = User::withTrashed()->where('id', $request->input('id'))->first();
            $user->restore();
            return redirect()->back()->withSuccess('Reactivaste a '.$user->email);
        }
    }

    public function sendActivation(User $user)
    {
        //dd($user->email);
        //$activation = Activation::findOrFail($request->input('activation'));
        Mail::to($user->email)->send(new UserActivated($user->activation, $user));
        $user->activation->touch();

        return redirect()->back()->withSuccess('Se ha enviado la activación a '.$user->email);
    }
}
