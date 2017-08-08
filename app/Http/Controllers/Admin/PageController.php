<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\Content;

class PageController extends Controller
{
    public function index()
    {
    	$categories = Category::all();
    	$pages = Page::orderByDesc('updated_at')->paginate(25);

        return view('admin.pages.index')
        	->withCategories($categories)
        	->withPages($pages);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $slug = str_slug($data['name'], '-');
        $page = Page::create([
            'name' => $data['name'],
            'category_id' => 0,
            'icon' => '',
            'image' => '',
            'markdown' => '',
            'slug' => $slug
        ]);
        if($data['category_id'])
        {
            $category = Category::find($data['category_id']);
            $category->pages()->save($page);
        }

        $permission = Permission::create([
            'name' => 'page-'.$slug,
            'display_name' => 'Ver '.$data['name'],
            'description' => 'Permiso para ver la página '.$data['name']
        ]);

        $admin = Role::findOrFail(1);
        $admin->attachPermission($permission);

        return redirect()->back()->withSuccess('Página creada con exito.');
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
        $all_contents = Content::all();
        $perm = Permission::where('name', 'page-' . $page->slug)->first();

        return view('admin.pages.edit', $page->toArray())->withPage($contents)->withRoles($roles)->withCat($cat)->withPerm($perm)->withAllContents($all_contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page, Request $request)
    {
        $data = $request->only(['name', 'image', 'markdown', 'category_id', 'menu']);
        $data['slug'] = str_slug($data['name']);
        $permission = Permission::where('name', 'page-'.$page->slug)->first();
        $page->update($data);
        $permission->name = 'page-'.$page->slug;
        $permission->display_name = 'Ver '.$page->name;
        $permission->save();

        $oficina = Role::findOrFail(2);
        $cooreg = Role::findOrFail(3);
        $ingcom = Role::findOrFail(4);
        
        if($request->input('rol-oficina') && ! $oficina->hasPermission($permission->name)){
            $oficina->attachPermission($permission);
        } elseif(! $request->input('rol-oficina')) {
            $oficina->detachPermission($permission);
        }

        if($request->input('rol-cooreg') && ! $cooreg->hasPermission($permission->name)){
            $cooreg->attachPermission($permission);
        } elseif(! $request->input('rol-cooreg')) {
            $cooreg->detachPermission($permission);
        }

        if($request->input('rol-ingcom')&& ! $ingcom->hasPermission($permission->name)){
            $ingcom->attachPermission($permission);
        } elseif(! $request->input('rol-ingcom')) {
            $ingcom->detachPermission($permission);
        }

        return redirect()->back()->withSuccess('Pagina guardada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('muuch.index');
    }

}
