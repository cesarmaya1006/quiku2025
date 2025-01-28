<?php

use App\Http\Controllers\Config\MenuController;
use App\Http\Controllers\Config\MenuRolController;
use App\Http\Controllers\Config\PermisoController;
use App\Http\Controllers\Config\PermisoRolController;
use App\Http\Controllers\Config\RolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\IntranetPageController;
use App\Http\Middleware\AdminSistema;

Route::controller(ExtranetPageController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');

    Route::get('/solicitar_password', [ExtranetPageController::class, 'solicitar_password'])->name('extranet.solicitar_password');
    Route::post('/cambiar_password', [ExtranetPageController::class, 'cambiar_password'])->name('extranet.cambiar_password');
    Route::get('/preguntas_frecuentes', [ExtranetPageController::class, 'preguntas_frecuentes'])->name('extranet.preguntas_frecuentes');
    Route::get('/index3', [ExtranetPageController::class, 'index_3'])->name('extranet.index_3');
    Route::get('/registro_ini', [ExtranetPageController::class, 'registro_ini'])->name('extranet.registro_ini');
    Route::post('/registro_ini-guardar', [ExtranetPageController::class, 'registro_ini_guardar'])->name('extranet.registro_ini-guardar');
    Route::get('/registro_ext/{id}/{cc}/{tipo}', [ExtranetPageController::class, 'registro_ext'])->name('extranet.registro_ext');
    Route::get('/registro_conf', [ExtranetPageController::class, 'registro_conf'])->name('extranet.registro_conf');
    Route::get('/parametros', [ExtranetPageController::class, 'parametros'])->name('extranet.parametros');
    Route::post('/parametros-guardar', [ExtranetPageController::class, 'parametros_guardar'])->name('extranet.parametros-guardar');
    Route::post('/registropj-guardar', [ExtranetPageController::class, 'registropj_guardar'])->name('extranet.registropj-guardar');
    Route::post('/registrorep-guardar', [ExtranetPageController::class, 'registrorep_guardar'])->name('extranet.registrorep-guardar');
    Route::post('/registropn-guardar', [ExtranetPageController::class, 'registropn_guardar'])->name('extranet.registropn-guardar');
    Route::get('/registro_pj', [ExtranetPageController::class, 'registro_pj'])->name('extranet.registro_pj');
    Route::get('/registro_rep/{id}', [ExtranetPageController::class, 'registro_rep'])->name('extranet.registro_rep');
    Route::get('/registro_pn', [ExtranetPageController::class, 'registro_pn'])->name('extranet.registro_pn');
    Route::get('/cargar_municipios', [ExtranetPageController::class, 'cargar_municipios'])->name('extranet.cargar_municipios');
    Route::get('/cargar_sedes', [ExtranetPageController::class, 'cargar_sedes'])->name('extranet.cargar_sedes');
    Route::post('/cargar_tipo_documentos', [ExtranetPageController::class, 'cargar_tipo_documentos'])->name('extranet.cargar_tipo_documentos');
    Route::get('/registro_final_pn', [ExtranetPageController::class, 'registro_final_pn'])->name('extranet.registro_final_pn');
    Route::get('/pruebamail', [ExtranetPageController::class, 'pruebamail'])->name('extranet.pruebamail');




    Route::get('/registro', 'registro')->name('extranet.registro');
    Route::get('/loginapp', 'loginapp')->name('extranet.loginapp');
    Route::post('/register', 'register')->name('extranet.store');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [IntranetPageController::class, 'dashboard'])->name('dashboard');
    Route::prefix('configuracion_sis')->middleware(AdminSistema::class)->group(function(){
        Route::controller(MenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(RolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(MenuRolController::class)->prefix('menu_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Permisos Roles
        Route::controller(PermisoController::class)->prefix('permiso_rutas')->group(function () {
            Route::get('', 'index')->name('permiso_rutas.index');
        });
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(PermisoRolController::class)->prefix('_permiso-rol')->group(function () {
            Route::get('', 'index')->name('permisos_rol.index');
            Route::post('guardar', 'store')->name('permisos_rol.store');
            Route::get('excepciones/{permission_id}/{role_id}', 'excepciones')->name('permisos_rol.excepciones');
            Route::post('guardar_excepciones', 'store_excepciones')->name('permisos_rol.store_excepciones');
        });
        // ----------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------
    });
});
