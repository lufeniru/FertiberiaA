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
    return view('inicio');
});
Route::get('index', function () {
    return view('inicio');
});
Route::post('inicio', 'controladorJaime@redirec');

Route::post('compuestos', 'controladorJaime@compuestos');
Route::post('elementos', 'controladorJaime@elementos');
Route::post('introducir', 'controladorJoaquin@introducirDatos');
Route::post('vercompuestos', 'controladorSergio@vercompuestos');
Route::post('elementosAnalisis', 'controladorSergio@verelementos');
Route::post('admin','controladorJoaquin@admin');
Route::post('addElemento','controladorJoaquin@addElemento');
Route::get('lab', function(){
    \Session::forget('planta');
return view('Laboratorio');
});

