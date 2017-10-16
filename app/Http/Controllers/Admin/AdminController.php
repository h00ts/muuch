<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Content;
use App\Page;
use App\Score;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_users = User::where('active',false)->get();
        $roles = Role::all();
        $activities = Activity::orderBy("created_at", 'desc')->paginate(20);
        $contents = Content::orderBy('id', 'desc')->take(5)->get();
        $top_contents = Content::with('users')->get()->sortByDesc(function($content)
        {
            return $content->users->count();
        })->take(5);
        $recent_scores = Score::orderBy('created_at', 'desc')->take(5)->get();
        $pages = Page::orderBy('id', 'desc')->take(5)->get();

        return view('admin.index')->withUsers($new_users)->withRoles($roles)->withActivities($activities)->withContents($contents)->withPages($pages)->withTopContents($top_contents)->withRecentScores($recent_scores);
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
        //
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
        //
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
        //
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
