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

Route::post('inicio', 'Controlador@redirec');

Route::post('compuestos', 'Controlador@compuestos');
Route::post('elementos', 'Controlador@elementos');
Route::post('introducir', 'Controlador@introducirDatos');
Route::post('vercompuestos', 'Controlador@vercompuestos');
Route::post('elementosAnalisis', 'Controlador@verelementos');
Route::post('admin','Controlador@admin');
Route::post('addElemento','Controlador@addElemento');
Route::post('addComp','Controlador@addComp');
Route::get('lab', function(){
    \Session::forget('planta');
return view('laboratorio/Laboratorio');
});
Route::post('login', 'Controlador@login');

Route::post('addPlanta', 'Controlador@addPlanta');

Route::post('sacarcomp', 'Controlador@sacarcomp');

Route::post('recelal', 'Controlador@recelal');

Route::post('analisis', 'Controlador@sacaranalisis');

Route::any('validar','Controlador@validar');
Route::post('filtro','Controlador@filtraranalisis');

Route::get('verAnalisis', function () {
    return view('vista/VerAnalisis');
});








