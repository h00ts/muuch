<?php

use Illuminate\Http\Request;
use App\Category;
use App\Page;
use App\Ilucentro;
use App\User;
use GrahamCampbell\Markdown\Facades\Markdown;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('ingresar', 'Auth\LoginController@showLoginForm');
Route::post('ingresar', 'Auth\LoginController@login');
Route::post('salir', 'Auth\LoginController@logout');
Route::post('recuperar/enviar', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('recuperar/correo', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('recuperar/contra/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('recuperar/cambiar', 'Auth\ResetPasswordController@reset');
Route::get('registro', 'Auth\RegisterController@showRegistrationForm');
Route::post('registro', 'Auth\RegisterController@register');
Route::get('registro/nuevo', function(){
	return view('new_registration');
});
Route::get('activar/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/inicio');
    });
    Route::get('/inicio', 'HomeController@index');
    Route::get('/buscar', function (Request $request) {
        $pages = App\Page::search($request->q)->get();
        $content = App\Content::search($request->q)->get();
        $count = count($pages);
        $count += count($content);
        return view('search')->withPages($pages)->withContents($content)->withQuery($request->q)->withCount($count);
    });
    Route::get('/capacitacion', 'LevelsController@index');
    Route::get('/capacitacion/inscribir', 'LevelsController@signUp');
    Route::get('/capacitacion/ver/{id}', 'Admin\\ContentController@show');
    Route::post('/capacitacion/completar/{id}', 'LevelsController@completeContent');
    //Route::get('/muuch/paginas', 'PagesController@index');
    Route::get('/examen', 'ExamsController@index');
    Route::get('/examen/{exam}', 'ExamsController@show');
    Route::post('/examen/entrega', 'ScoresController@store');
    Route::resource('/consulta', 'PagesController');
    Route::get('/categoria/{id}', 'PagesController@getCat');
    Route::resource('/foro', 'ThreadsController', ['except' => 'show']);
    Route::resource('/canal', 'ChannelController', ['only' => 'show']);
    Route::get('/foro/{thread}', 'ThreadsController@show');
    Route::get('/foro/responder/{id}', 'RepliesController@create');
    Route::post('/foro/responder/{id}', 'RepliesController@store')->name('foro.responder');
    Route::get('/datatables/sucursales', 'DatatablesController@getSucursales');
    Route::get('/datatables/equipo', 'DatatablesController@getEquipo');
    Route::get('/datatables/activity', 'DatatablesController@getActivity');
    Route::post('/enviar/bsq', 'EmailsController@postBuzon');
    Route::resource('/perfil', 'UserController', ['only' => ['update']]);
    Route::get('/contenido/ver/{id}', 'ContentController@track');
    Route::resource('/contenido', 'ContentController');
    Route::resource('impacto', 'ImpactoController');


    /****************************************************
     *  STATIC PAGES
     ****************************************************/

    Route::get('/herramientas', function(){
        $page = Page::where('slug', 'herramientas')->first();
        $categories = Category::all();
        $markdown = Markdown::convertToHtml($page->markdown);

        return view('pages.show', $page->toArray())->withPage($page)->withCategories($categories)->withMarkdown($markdown);
    });
    Route::get('/sucursales', function(){
        $page = Page::where('slug', 'sucursales')->first();
        $sucursales = Ilucentro::all();

        return view('pages.sucursales', $page->toArray())->withPage($page)->withSucursales($sucursales);
    });

    Route::get('/personas', function(){
        $page = Page::where('slug', 'personas')->first();
        $users = User::orderBy('name', 'asc')->get();
        $markdown = Markdown::convertToHtml($page->markdown);

        return view('pages.equipo', $page->toArray())->withPage($page)->withUsers($users)->withMarkdown($markdown);
    });
    Route::get('/directorio', function(){
        $page = Page::where('slug', 'directorio')->first();
        $markdown = Markdown::convertToHtml($page->markdown);

        return view('pages.directorio', $page->toArray())->withPage($page)->withMarkdown($markdown);
    });
    Route::get('/formatos', function(){
        $category = Category::where('slug', 'formatos')->first();
        $categories = Category::all();

        return view('pages.cat', $category->toArray())->withCat($category)->withCategories($categories);
    });

    /***
     * END STATIC PAGES
     */


});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'config',
    'middleware' => 'auth'
], function () {
    Route::resource('/', 'AdminController');
    Route::resource('niveles', 'LevelController');
    Route::resource('modulos', 'ModuleController');
    Route::resource('usuarios', 'UserController');
    Route::post('usuarios/restore', 'UserController@restore');
    Route::put('usuarios/{user}/reenviar', 'UserController@sendActivation');
    Route::resource('examen', 'ExamController');
    Route::resource('pregunta', 'QuestionController');
    Route::resource('respuesta', 'AnswerController');
    Route::resource('contenido', 'ContentController', ['except' => ['show']]);
    Route::get('contenido/create/{module_id}', 'ContentController@create');
    Route::resource('muuch', 'PageController');
    Route::resource('categoria', 'CategoryController');
    Route::resource('canales', 'ChannelController');
    Route::resource('ilucentros', 'IlucentroController');
    Route::get('contenido/buscar', function (Request $request) {
        $content = App\Content::search($request->q)->get();
        $count = count($content);
        return view('admin.contenido.search')->withContents($content)->withQuery($request->q)->withCount($count);
    });
    Route::get('muuch/buscar', function (Request $request) {
        $pagina = App\Pagina::search($request->q)->get();
        $count = count($pagina);
        return view('admin.pages.search')->withPaginas($pagina)->withQuery($arequest->q)->withCount($count);
    });
});