<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use App\Http\Controllers\Controller;

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
}
