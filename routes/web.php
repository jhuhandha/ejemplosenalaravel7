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

Route::get("/", "ProductoInsumoController@index");

Route::get("/producto/listar", "ProductoInsumoController@show");
Route::get("/producto/insumos", "ProductoInsumoController@index");
Route::post("/producto/guardar", "ProductoInsumoController@save");
