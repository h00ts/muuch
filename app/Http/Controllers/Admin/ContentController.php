<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use App\Content;
use App\Page;
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
        $contents = Content::orderBy('name')->paginate(25);

        return view('admin.contenido.index', $contents->toArray())->withContents($contents);
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
        if($request->input('module_id')){
            $module = Module::find($request->input('module_id'));
            $content = $module->contents()->create($request->all());
        } else if($request->input('page_id')) {
            $page = Page::find($request->input('page_id'));
            $page->contents()->create($request->all());
        } else {
            $content = Content::create($request->all());
        }

        return redirect()->back()->withSuccess('Contenido creado con exito.');
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
    public function edit(Content $content)
    {
        //$content = Content::findOrFail($id);
        $pages = Page::all();
        $modules = Module::all();


        return view('admin.contenido.edit', $content)->withContent($content)->withPages($pages)->withModules($modules);
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
        $content->update($data);
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
        Content::destroy($id);
        return redirect()->route('muuch.index')->withSuccess('Eliminado.');
    }
}
