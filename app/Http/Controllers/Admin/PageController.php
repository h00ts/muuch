<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use App\Http\Controllers\Controller;
use App\Role;

class PageController extends Controller
{
    public function index()
    {
    	$categories = Category::all();
    	$pages = Page::all();

        return view('admin.pages.index')
        	->withCategories($categories)
        	->withPages($pages);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $page = Page::create([
            'name' => $data['name'],
            'category_id' => 0,
            'icon' => '',
            'image' => '',
            'markdown' => ''
        ]);
        $category = Category::find($data['category_id']);
        $category->pages()->save($page);

        return redirect()->back()->withSuccess('Pagina creada con exito.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $contents = Page::find($page->id);
        $roles = Role::all();
        $cat = Category::all();

        return view('admin.pages.edit', $page->toArray())->withPage($contents)->withRoles($roles)->withCat($cat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page, Request $request)
    {
        $page->update($request->only(['name', 'image', 'markdown', 'category_id']));
        $contents = Page::find($page->id);
        $roles = Role::all();

        return redirect()->back()->withSuccess('Pagina guardada.');
    }
}
