<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('master', function () {
//     return view('master');
// });

//nombre que le asignas a la pag, nombre del blade.php
Route::view('ventas','ventas');
Route::view('productos','tablaProductos');

Route::apiResource('apiProducto','ProductoController');

