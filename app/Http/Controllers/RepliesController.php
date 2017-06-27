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

}
