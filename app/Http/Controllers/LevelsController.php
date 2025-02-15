<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Content;
use Illuminate\Support\Facades\Auth;
use App\Events\ContentCompleted;
use Carbon\Carbon;

Carbon::setLocale('es');

class LevelsController extends Controller
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
        ($content_count == 0) ? $content_count = 1 : $content_count;
        $user_content = isset($user->content) ? count($user->content->where('module.level', $user->level)) : 0;

        /*
        $modules = Module::whereDoesntHave('users', function ($q) use ($user) {
                $q->where('module_user.user_id', $user->id);
            })->where('level', $user->level)->get();
        $completed = Module::whereHas('users', function ($q) use ($user) {
                $q->where('module_user.user_id', $user->id);
            })->get();
            */

        return view('levels')
            ->withUser($user)
            ->withModules($modules)
            ->withContentCount($content_count)
            ->withUserContent($user_content);
    }

    public function signUp()
    {
        $user = Auth::user();
        if($user->level || $user->level != 0){
            return redirect()->back()->withErrors('Ya estas inscrito.');
        }

        $user->level = 1;
        $user->save();

        return redirect()->back()->withSuccess('Te has inscrito correctamente.');
    }

    public function completeContent($id)
    {
        $user = Auth::user();
        $user->content()->attach($id);
        $user->save();

        $content = Content::findOrFail($id);

        event(new ContentCompleted($content,$user));

        return redirect('/capacitacion')->withSuccess('¡Muy bien! Completaste el bloque.');
    }
}
