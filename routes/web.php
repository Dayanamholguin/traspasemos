<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\discapacidadController;
use App\Http\Controllers\estadoAprendizController;
use App\Http\Controllers\estadoFichaController;
use App\Http\Controllers\programaController;
use App\Http\Controllers\neeController;
use App\Http\Controllers\institucionController;
use App\Http\Controllers\datosAcademicosController;
use App\Http\Controllers\fichaController;
use App\Http\Controllers\profesionalController;

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
//nee
Route::get('/nee', [neeController::class, 'index']);
Route::get('/nee/listar', [neeController::class, 'listar']);
Route::get('/nee/crear', [neeController::class, 'crear']);
Route::post('/nee/guardar', [neeController::class, 'guardar']);
Route::get('/nee/editar/{id}', [neeController::class, 'editar']);
Route::post('/nee/actualizar/{id}', [neeController::class, 'modificar']);
Route::get('/nee/cambiar/estado/{id}/{estado}', [neeController::class, 'modificarEstado']);
Route::get('/nee/ver/{id}', [neeController::class, 'ver']);
//institucion
Route::get('/institucion', [institucionController::class, 'index']);
Route::get('/institucion/listar', [institucionController::class, 'listar']);
Route::get('/institucion/crear', [institucionController::class, 'crear']);
Route::post('/institucion/guardar', [institucionController::class, 'guardar']);
Route::get('/institucion/editar/{id}', [institucionController::class, 'editar']);
Route::post('/institucion/actualizar/{id}', [institucionController::class, 'modificar']);
Route::get('/institucion/cambiar/estado/{id}/{estado}', [institucionController::class, 'modificarEstado']);
Route::get('/institucion/ver/{id}', [institucionController::class, 'ver']);
//datosAcademicos
Route::get('/datosAcademico', [datosAcademicosController::class, 'index']);
Route::get('/datosAcademico/listar', [datosAcademicosController::class, 'listar']);
Route::get('/datosAcademico/crear', [datosAcademicosController::class, 'crear']);
Route::post('/datosAcademico/guardar', [datosAcademicosController::class, 'guardar']);
Route::get('/datosAcademico/editar/{id}', [datosAcademicosController::class, 'editar']);
Route::post('/datosAcademico/actualizar/{id}', [datosAcademicosController::class, 'modificar']);
Route::get('/datosAcademico/filtrar/{filtro}', [datosAcademicosController::class, 'filtrar']);
Route::get('/datosAcademico/cambiar/estado/{id}/{estado}', [datosAcademicosController::class, 'modificarEstado']);
//ficha
Route::get('/ficha', [fichaController::class, 'index']);
Route::get('/ficha/listar', [fichaController::class, 'listar']);
Route::get('/ficha/crear', [fichaController::class, 'crear']);
Route::post('/ficha/guardar', [fichaController::class, 'guardar']);
Route::get('/ficha/editar/{id}', [fichaController::class, 'editar']);
Route::post('/ficha/actualizar/{id}', [fichaController::class, 'modificar']);
Route::get('/ficha/cambiar/estado/{id}/{estado}', [fichaController::class, 'modificarEstado']);
Route::get('/ficha/ver/{id}', [fichaController::class, 'ver']);
//profesional
Route::get('/profesional', [profesionalController::class, 'index']);
Route::get('/profesional/listar', [profesionalController::class, 'listar']);
Route::get('/profesional/crear', [profesionalController::class, 'crear']);
Route::post('/profesional/guardar', [profesionalController::class, 'guardar']);
Route::get('/profesional/editar/{id}', [profesionalController::class, 'editar']);
Route::post('/profesional/actualizar/{id}', [profesionalController::class, 'modificar']);
Route::get('/profesional/cambiar/estado/{id}/{estado}', [profesionalController::class, 'modificarEstado']);
Route::get('/profesional/ver/{id}', [profesionalController::class, 'ver']);