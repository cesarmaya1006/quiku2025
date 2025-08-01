<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetController;



Route::controller(ExtranetController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');
    Route::get('/registro_ini', 'registro_ini')->name('extranet.registro_ini');
    Route::get('/solicitar_password', 'solicitar_password')->name('extranet.solicitar_password');
    Route::get('/registro_ini_guardar', 'registro_ini_guardar')->name('extranet.registro_ini_guardar');
});


//Route::get('/', function () {return view('welcome');});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
