<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <- Agregado

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

Route::get('/', fn() => redirect('/admin'));
Route::get('/home', fn() => redirect('/admin'));

Auth::routes();

Route::middleware('auth')->group(function () {

    // Rutas para el panel de administración
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Rutas para configuraciones
    Route::prefix('admin/configuraciones')->name('admin.configuracion.')->group(function () {
        Route::get('/', [ConfiguracionController::class, 'index'])->name('index')->middleware('can:admin.configuracion.index');
        Route::get('/create', [ConfiguracionController::class, 'create'])->name('create')->middleware('can:admin.configuracion.create');
        Route::post('/create', [ConfiguracionController::class, 'store'])->name('store')->middleware('can:admin.configuracion.store');
        Route::get('/{id}', [ConfiguracionController::class, 'show'])->name('show')->middleware('can:admin.configuracion.show');
        Route::get('/{id}/edit', [ConfiguracionController::class, 'edit'])->name('edit')->middleware('can:admin.configuracion.edit');
        Route::put('/{id}', [ConfiguracionController::class, 'update'])->name('update')->middleware('can:admin.configuracion.update');
        Route::delete('/{id}', [ConfiguracionController::class, 'destroy'])->name('destroy')->middleware('can:admin.configuracion.destroy');
    });

    // Rutas para roles
    Route::prefix('admin/roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('can:admin.roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('can:admin.roles.create');
        Route::post('/create', [RoleController::class, 'store'])->name('store')->middleware('can:admin.roles.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('show')->middleware('can:admin.roles.show');
        Route::get('/{id}/asignar', [RoleController::class, 'asignar_roles'])->name('asignar_roles')->middleware('can:admin.roles.asignar_roles');
        Route::put('/asignar/{id}', [RoleController::class, 'update_asignar'])->name('update_asignar')->middleware('can:admin.roles.update_asignar');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('can:admin.roles.edit');
        Route::put('/{id}', [RoleController::class, 'update'])->name('update')->middleware('can:admin.roles.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy')->middleware('can:admin.roles.destroy');
    });

    // Rutas para usuarios
    Route::prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('index')->middleware('can:admin.usuarios.index');
        Route::get('/create', [UsuarioController::class, 'create'])->name('create')->middleware('can:admin.usuarios.create');
        Route::post('/create', [UsuarioController::class, 'store'])->name('store')->middleware('can:admin.usuarios.store');
        Route::get('/{id}', [UsuarioController::class, 'show'])->name('show')->middleware('can:admin.usuarios.show');
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('edit')->middleware('can:admin.usuarios.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('update')->middleware('can:admin.usuarios.update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy')->middleware('can:admin.usuarios.destroy');
    });

    // Rutas para clientes
    Route::prefix('admin/clientes')->name('admin.clientes.')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('index')->middleware('can:admin.clientes.index');
        Route::get('/create', [ClienteController::class, 'create'])->name('create')->middleware('can:admin.clientes.create');
        Route::post('/create', [ClienteController::class, 'store'])->name('store')->middleware('can:admin.clientes.store');
        Route::get('/{id}', [ClienteController::class, 'show'])->name('show')->middleware('can:admin.clientes.show');
        Route::get('/{id}/edit', [ClienteController::class, 'edit'])->name('edit')->middleware('can:admin.clientes.edit');
        Route::put('/{id}', [ClienteController::class, 'update'])->name('update')->middleware('can:admin.clientes.update');
        Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('destroy')->middleware('can:admin.clientes.destroy');
    });

    // Rutas para prestamos
    Route::prefix('admin/prestamos')->name('admin.prestamos.')->group(function () {
        Route::get('/', [PrestamoController::class, 'index'])->name('index')->middleware('can:admin.prestamos.index');
        Route::get('/create', [PrestamoController::class, 'create'])->name('create')->middleware('can:admin.prestamos.create');
        Route::get('/cliente/{id}', [PrestamoController::class, 'obtenerCliente'])->name('cliente.obtenerCliente')->middleware('can:admin.prestamos.cliente.obtenerCliente');
        Route::post('/create', [PrestamoController::class, 'store'])->name('store')->middleware('can:admin.prestamos.store');
        Route::get('/{id}', [PrestamoController::class, 'show'])->name('show')->middleware('can:admin.prestamos.show');
        Route::get('/contratos/{id}', [PrestamoController::class, 'contratos'])->name('contratos')->middleware('can:admin.prestamos.contratos');
        Route::get('/{id}/edit', [PrestamoController::class, 'edit'])->name('edit')->middleware('can:admin.prestamos.edit');
        Route::put('/{id}', [PrestamoController::class, 'update'])->name('update')->middleware('can:admin.prestamos.update');
        Route::delete('/{id}', [PrestamoController::class, 'destroy'])->name('destroy')->middleware('can:admin.prestamos.destroy');
    });

    // Rutas para pagos
    Route::prefix('admin/pagos')->name('admin.pagos.')->group(function () {
        Route::get('/', [PagoController::class, 'index'])->name('index')->middleware('can:admin.pagos.index');
        Route::get('/prestamos/cliente/{id}', [PagoController::class, 'cargar_prestamo_cliente'])->name('cargar_prestamo_cliente')->middleware('can:admin.pagos.cargar_prestamo_cliente');
        Route::get('/prestamos/create/{id}', [PagoController::class, 'create'])->name('create')->middleware('can:admin.pagos.create');
        Route::post('/create/{id}', [PagoController::class, 'store'])->name('store')->middleware('can:admin.pagos.store');
        Route::get('/comprobantedepago/{id}', [PagoController::class, 'comprobantedepago'])->name('comprobantedepago')->middleware('can:admin.pagos.comprobantedepago');
        Route::get('/{id}', [PagoController::class, 'show'])->name('show')->middleware('can:admin.pagos.show');
        Route::post('/{id}', [PagoController::class, 'destroy'])->name('destroy')->middleware('can:admin.pagos.destroy');
    });

    // Rutas para notificaciones
    Route::prefix('admin/notificaciones')->name('admin.notificaciones.')->group(function () {
        Route::get('/', [NotificacionController::class, 'index'])->name('index')->middleware('can:admin.notificaciones.index');
        Route::get('/notificar/{id}', [NotificacionController::class, 'notificar'])->name('notificar')->middleware('can:admin.notificaciones.notificar');
    });

    // Rutas para backups
    Route::prefix('admin/backups')->name('admin.backups.')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('index')->middleware('can:admin.backups.index');
        Route::get('/create', [BackupController::class, 'create'])->name('create')->middleware('can:admin.backups.create');
        Route::get('/descargar/{nombreArchivo}', [BackupController::class, 'descargar'])->name('descargar')->middleware('can:admin.backups.descargar');
    });
});
