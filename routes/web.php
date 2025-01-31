<?php

use App\Http\Controllers\ConfiguracionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return redirect('/admin');
// });

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para configuraciones
Route::get('/admin/configuraciones', [ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth');
Route::get('/admin/configuraciones/create', [ConfiguracionController::class, 'create'])->name('admin.configuracion.create')->middleware('auth');
Route::post('/admin/configuraciones/create', [ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth');
Route::get('/admin/configuraciones/{id}', [ConfiguracionController::class, 'show'])->name('admin.configuracion.show')->middleware('auth');
Route::get('/admin/configuraciones/{id}/edit', [ConfiguracionController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
Route::put('/admin/configuraciones/{id}', [ConfiguracionController::class, 'update'])->name('admin.configuracion.update')->middleware('auth');
Route::delete('/admin/configuraciones/{id}', [ConfiguracionController::class, 'destroy'])->name('admin.configuracion.destroy')->middleware('auth');
