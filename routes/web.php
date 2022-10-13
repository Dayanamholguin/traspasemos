<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\discapacidadController;
use App\Http\Controllers\estadoAprendizController;
use App\Http\Controllers\estadoFichaController;
use App\Http\Controllers\programaController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [LandingController::class, 'index']);
Route::get('/inicio', [LandingController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

//usuarios
Route::get('/usuario', [usuarioController::class, 'index']);
Route::get('/usuario/listar', [usuarioController::class, 'listar']);
Route::get('/usuario/crear', [usuarioController::class, 'crear']);
Route::post('/usuario/guardar', [usuarioController::class, 'guardar']);
Route::get('/usuario/editar/{id}', [usuarioController::class, 'editar']);
Route::post('/usuario/actualizar/{id}', [usuarioController::class, 'modificar']);
Route::get('/usuario/cambiar/estado/{id}/{estado}', [usuarioController::class, 'modificarEstado']);
Route::get('/usuario/verUsuario/{id}', [usuarioController::class, 'ver']);
//discapacidad
Route::get('/discapacidad', [discapacidadController::class, 'index']);
Route::get('/discapacidad/listar', [discapacidadController::class, 'listar']);
Route::get('/discapacidad/crear', [discapacidadController::class, 'crear']);
Route::post('/discapacidad/guardar', [discapacidadController::class, 'guardar']);
Route::get('/discapacidad/editar/{id}', [discapacidadController::class, 'editar']);
Route::post('/discapacidad/actualizar/{id}', [discapacidadController::class, 'modificar']);
Route::get('/discapacidad/cambiar/estado/{id}/{estado}', [discapacidadController::class, 'modificarEstado']);
Route::get('/discapacidad/ver/{id}', [discapacidadController::class, 'ver']);
//estadoAprendiz
Route::get('/estadoAprendiz', [estadoAprendizController::class, 'index']);
Route::get('/estadoAprendiz/listar', [estadoAprendizController::class, 'listar']);
Route::get('/estadoAprendiz/crear', [estadoAprendizController::class, 'crear']);
Route::post('/estadoAprendiz/guardar', [estadoAprendizController::class, 'guardar']);
Route::get('/estadoAprendiz/editar/{id}', [estadoAprendizController::class, 'editar']);
Route::post('/estadoAprendiz/actualizar/{id}', [estadoAprendizController::class, 'modificar']);
Route::get('/estadoAprendiz/cambiar/estado/{id}/{estado}', [estadoAprendizController::class, 'modificarEstado']);
//estadoFicha
Route::get('/estadoFicha', [estadoFichaController::class, 'index']);
Route::get('/estadoFicha/listar', [estadoFichaController::class, 'listar']);
Route::get('/estadoFicha/crear', [estadoFichaController::class, 'crear']);
Route::post('/estadoFicha/guardar', [estadoFichaController::class, 'guardar']);
Route::get('/estadoFicha/editar/{id}', [estadoFichaController::class, 'editar']);
Route::post('/estadoFicha/actualizar/{id}', [estadoFichaController::class, 'modificar']);
Route::get('/estadoFicha/cambiar/estado/{id}/{estado}', [estadoFichaController::class, 'modificarEstado']);
//programa
Route::get('/programa', [programaController::class, 'index']);
Route::get('/programa/listar', [programaController::class, 'listar']);
Route::get('/programa/crear', [programaController::class, 'crear']);
Route::post('/programa/guardar', [programaController::class, 'guardar']);
Route::get('/programa/editar/{id}', [programaController::class, 'editar']);
Route::post('/programa/actualizar/{id}', [programaController::class, 'modificar']);
Route::get('/programa/cambiar/estado/{id}/{estado}', [programaController::class, 'modificarEstado']);
Route::get('/programa/ver/{id}', [programaController::class, 'ver']);