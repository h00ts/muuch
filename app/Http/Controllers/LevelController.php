<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $modules = Module::where('level', $user->level)->get();

        return view('levels')->withUser($user)->withModules($modules);
    }

    public function signUp()
    {
        $user = Auth::user();
        if($user->level || $user->level === 0){
            return redirect()->back()->withErrors('Ya estas inscrito');
        }

        $user->level = 0;
        $user->save();

        return redirect()->back()->withSuccess('Te haz inscrito correctamente.');
    }
}
