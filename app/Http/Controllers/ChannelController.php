<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Auth;
use Carbon\Carbon;

class ChannelController extends Controller
{
    public function show(Channel $channel)
    {
        Carbon::setLocale('es');
        $user = Auth::user();
        $threads = Thread::orderBy('updated_at', 'desc')->where('channel_id', $channel->id)->paginate(10);

        return view('threads.channel', $channel->toArray())->withUser($user)->withThreads($threads);
    }
}
