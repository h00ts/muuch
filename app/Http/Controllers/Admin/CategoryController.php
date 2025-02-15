<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Role;
use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', $categories)
            ->withCategories($categories);
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
        $slug = str_slug($request->input('name'), '-');
        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $slug
        ]);

        $permission = Permission::create([
            'name' => 'category-'.$slug,
            'display_name' => 'Ver '.$category->name,
            'description' => 'Permiso para ver la página '.$category->name
        ]);

        $admin = Role::findOrFail(1);
        $admin->attachPermission($permission);

        return redirect()->route('categoria.edit', $category)->withSuccess('Creaste la categoria '.$category->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parents = Category::where('parent_id', null)->get();
        $roles = Role::all();
        $perm = Permission::where('name', 'category-' . $category->slug)->first();

        return view('admin.category.edit', $category->toArray())->withParents($parents)->withRoles($roles)->withPerm($perm)->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['name']);
        $permission = Permission::where('name', 'category-' . $category->slug)->first();
        $category->update($data);
        $permission->name = 'category-'.$category->slug;
        $permission->display_name = 'Ver '.$category->name;
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

        return back()->withSuccess('Categoria actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categoria.index');
    }
}
