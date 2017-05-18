<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use App\Content;
use Laravelista\Sherlock\Sherlock;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module_id = null)
    {
        $modules = Module::all()->sortBy('level');

        return view('admin.contenido.create')->withModules($modules)->withModuleId($module_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = Module::findOrFail($request->input('module_id'));
        $content = $module->contents()->create([
            'name' => $request->input('name'),
            'html' => $request->input('html'),
            'cover' => $request->input('cover'),
            'file' => $request->input('file'),
        ]);

        return back()->withSuccess('Contenido '.$content->name.' creado para el modulo '.$module->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::find($id);
        $sherlock = new Sherlock;
        $toc = $sherlock->deduct($content->markdown)->getToc();
        $helper = $sherlock->deduct($content->markdown)->getLibrary();
        //$helper = array_multisort($price, SORT_DESC, $helper);
        /*usort($helper, function ($a, $b) {
            return $a['level'] <=> $b['level'];
        });*/   

        return view('content')->withContent($content)->withToc($toc)->withHelper($helper);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::find($id);

        return view('admin.contenido.edit')->withContent($content);
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
        $content = Content::findOrFail($id);
        $data = $request->all();

        $content->name = $data['name'];
        $content->markdown = $data['markdown'];
        $content->save();

        return redirect()->route('contenido.edit', $content->id)->withSuccess('Guardado.');
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
