<?php

use Illuminate\Http\Request;

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
Route::post('recuperar/enviar', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
Route::get('recuperar/correo', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('recuperar/contra/{token}', 'Auth\ForgotPasswordController@showResetForm');
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
        return view('search')->withPages($pages)->withContents($content);
    });
    Route::get('/capacitacion', 'LevelsController@index');
    Route::get('/capacitacion/inscribir', 'LevelsController@signUp');
    Route::get('/capacitacion/ver/{id}', 'Admin\\ContentController@show');
    Route::post('/capacitacion/completar/{id}', 'LevelsController@completeContent');
    //Route::get('/muuch/paginas', 'PagesController@index');
    Route::get('/examen', 'ExamsController@index');
    Route::post('/examen/entrega', 'ScoresController@store');
    Route::resource('/muuch', 'PagesController');
    Route::get('/muuch/cat/{id}', 'PagesController@getCat');
    Route::resource('/foro', 'ThreadsController', ['except' => 'show']);
    Route::get('/foro/{thread}', 'ThreadsController@show');
    Route::get('/foro/responder/{id}', 'RepliesController@create');
    Route::post('/foro/responder/{id}', 'RepliesController@store')->name('foro.responder');
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
    Route::resource('examen', 'ExamController');
    Route::resource('pregunta', 'QuestionController');
    Route::resource('respuesta', 'AnswerController');
    Route::resource('contenido', 'ContentController', ['except' => ['show', 'index']]);
    Route::get('contenido/create/{module_id}', 'ContentController@create');
    Route::resource('muuch', 'PageController');
    Route::resource('categoria', 'CategoryController');
    Route::resource('canales', 'ChannelController');
    Route::resource('ilucentros', 'IlucentroController');
});