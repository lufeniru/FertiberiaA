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
    return view('login');
});
Route::get('volver',function () {
    return view('login');
});
Route::get('index', function () {
    return view('inicio');
});

Route::get('admin', function () {
    return view('admin/admin');
});

Route::post('inicio', 'controladorJaime@redirec');

Route::post('compuestos', 'controladorJaime@compuestos');
Route::post('elementos', 'controladorJaime@elementos');
Route::post('introducir', 'controladorJoaquin@introducirDatos');
Route::post('vercompuestos', 'controladorSergio@vercompuestos');
Route::post('elementosAnalisis', 'controladorSergio@verelementos');
Route::post('admin','controladorJoaquin@admin');
Route::post('addElemento','controladorJoaquin@addElemento');
Route::post('addComp','controladorJoaquin@addComp');
Route::get('lab', function(){
    \Session::forget('planta');
return view('laboratorio/Laboratorio');
});
Route::post('login', 'controladorJaime@login');

Route::post('addPlanta', 'controladorJoaquin@addPlanta');

Route::post('sacarcomp', 'controladorJoaquin@sacarcomp');

Route::post('recelal', 'controladorSergio@recelal');

Route::post('analisis', 'controladorJoaquin@sacaranalisis');

Route::any('validar','controladorJoaquin@validar');
Route::post('filtro','controladorJoaquin@filtraranalisis');

Route::get('verAnalisis', function () {
    return view('vista/VerAnalisis');
});



