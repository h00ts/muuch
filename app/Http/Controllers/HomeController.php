<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Content;
use App\Thread;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        Carbon::setLocale('es');
        $user = Auth::user();
        $modules = Module::where('level', $user->level)->get();
        $content_count = 0;
        foreach($modules as $module){
            $content_count += count($module->contents);
        }
        ($content_count == 0) ? $content_count = 1 : $content_count;
        $user_content = isset($user->content) ? count($user->content->where('module.level', $user->level)) : 0;
        $thread = Thread::orderByDesc('updated_at')->first();
        $categories = Category::all();

        return view('home')
            ->withUser($user)
            ->withModules($modules)
            ->withThread($thread)
            ->withCategories($categories)
            ->withContentCount($content_count)
            ->withUserContent($user_content);
    }

}
