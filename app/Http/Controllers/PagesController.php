<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\Markdown\Facades\Markdown;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('pages.index')->withCategories($categories);
    }

    public function show(Page $page)
    {
        $categories = Category::all();
        $markdown = Markdown::convertToHtml($page->markdown);

        return view('pages.show', $page)->withPage($page)->withCategories($categories)->withMarkdown($markdown);
    }

    public function getCat($id)
    {
        $categories = Category::all();
        $cat = Category::find($id);
        return view('pages.cat', $cat->toArray())->withCat($cat)->withCategories($categories);
    }

    public function search(Request $request)
    {
        $pages = App\Page::search($request->input('query'))->get();

        return view('pages.search')->withPages($pages);
    }

}
