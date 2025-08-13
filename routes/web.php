<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetController;
use App\Http\Controllers\Intranet\Admin\IntranetPageController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Middleware\Administrador;
use App\Http\Middleware\AdminSistema;

Route::controller(ExtranetController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');
    Route::get('/correo', 'correo')->name('extranet.correo');
    Route::get('/registro_ini', 'registro_ini')->name('extranet.registro_ini');
    Route::get('/solicitar_password', 'solicitar_password')->name('extranet.solicitar_password');
    Route::get('/registro_ini_guardar', 'registro_ini_guardar')->name('extranet.registro_ini_guardar');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', [IntranetPageController::class, 'dashboard'])->name('dashboard');
    //===================================================================================================
    Route::prefix('configuracion_sis')->middleware(Administrador::class)->group(function () {
        // ----------------------------------------------------------------------------------------
        Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('admin.usuario.index');
            Route::get('crear', 'create')->name('admin.usuario.create');
            Route::get('editar/{id}', 'edit')->name('admin.usuario.edit');
            Route::post('guardar', 'store')->name('admin.usuario.store');
            Route::put('actualizar/{id}', 'update')->name('admin.usuario.update');
            Route::get('eliminar/{id}', 'destroy')->name('admin.usuario.destroy');
        });
        // ----------------------------------------------------------------------------------------
    });
    //===================================================================================================
});

//Route::get('/', function () {return view('welcome');});

/*Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});*/
