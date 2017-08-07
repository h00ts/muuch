<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserActivateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Activation;
use App\Permission;
use App\Mail\UserActivated;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.index')->withUsers($users)->withRoles($roles)->withPermissions($permissions);
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
        

        return redirect()->back();
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
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit')->withUser($user)->withRoles($roles);
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
        $activate = $request->input('activate');
        if($activate){
            $user = User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->back()->withSuccess('Has actualizado al usuario '.$user->email);

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
