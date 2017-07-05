<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Thread;

class RepliesController extends Controller
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $thread = Thread::findOrFail($id);

        return view('threads.reply', compact('thread'))->withUser($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $reply =  $user->replies()->create($request->all());

        return redirect()->back();
    }

}
