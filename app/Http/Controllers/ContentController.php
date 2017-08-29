<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Events\ContentView;
use Illuminate\Support\Facades\Redirect;
use Auth;

class ContentController extends Controller
{
    public function track($id)
    {
        $content = Content::find($id);
        $user = Auth::user();
        event(new ContentView($content,$user));

        return Redirect::to($content->file);
    }
}
