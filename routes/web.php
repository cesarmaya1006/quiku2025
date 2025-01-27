<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\IntranetPageController;

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
});
