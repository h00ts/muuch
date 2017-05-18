<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Content;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $content_count = 0;
        foreach($modules as $module){
            $content_count += count($module->contents);
        }
        return view('home')
            ->withUser($user)
            ->withModules($modules)
            ->withContentCount($content_count);
    }
}
