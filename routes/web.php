<?php

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
Route::get('password/reset/{token}', 'Auth\ForgotPasswordController@showResetForm');
Route::get('registrar', 'Auth\RegisterController@showRegistrationForm');
Route::post('registrar', 'Auth\RegisterController@register');
Route::get('registro/nuevo', function(){
	return view('new_registration');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/inicio');
    });
    Route::get('/inicio', 'HomeController@index');
    Route::get('/capacitacion', 'LevelsController@index');
    Route::get('/capacitacion/inscribir', 'LevelsController@signUp');
    Route::get('/capacitacion/ver/{id}', 'Admin\\ContentController@show');
    Route::post('/capacitacion/completar/{id}', 'LevelsController@completeContent');
    //Route::get('/muuch/paginas', 'PagesController@index');
    Route::get('/examen', 'ExamsController@index');
    Route::resource('/muuch', 'PagesController');
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
    Route::resource('category', 'CategoryController');
});